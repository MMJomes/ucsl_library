<?php

namespace App\Imports;

use App\Jobs\ContactMailServiceJob;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ContactListImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $setting_approve =  Setting::where('key', 'reg_approve')->first();
        $setting_sned_email =  Setting::where('key', 'sned_email')->first();
        $dob =  $row['dob'];
        $start_times = ($dob - 25569) * 86400;
        $dob_date = gmdate("Y-m-d H:i:s", $start_times);

        $name = $row['name'];
        $mobile = $row['mobile'];
        $usernamed = preg_replace('/\s+/', '', $name);
        $usernamefirst = substr($usernamed, 0, 3);

        $usermobiles = preg_replace('/\s+/', '', $mobile);
        $usermobile = substr($usermobiles, -4);
        $userfullname = $usernamefirst . $usermobile;
        if ($setting_approve->value == ON) {
            $isactive = ON;
        } else {
            $isactive = OFF;
        }
        $pwd =  gmdate("dmY", $start_times);
        //$userpassword = Hash::make($pwd);
        $useremail = $row['email'];
        $yucontact = Member::create([
            'batch_no' => $row['batch_no'],
            'year' =>  $row['year'],
            'roll_no' => $row['roll_no'],
            'name' => $row['name'],
            'dob' => $dob_date,
            'qualification' => $row['qualification'],
            'occupation' => $row['occupation'],
            'departement' => $row['departement'],
            'office_phone' => $row['office_phone'],
            'office_address' => $row['office_address'],
            'home_phone' => $row['home_phone'],
            'resident' => $row['resident'],
            'mobile' => $row['mobile'],
            'email' => $useremail,
            'username' => $userfullname,
            'password' => $pwd,
            'status' => $isactive,
        ]);

        if ($setting_sned_email->value == ON && $useremail != null) {
            ContactMailServiceJob::dispatch($userfullname, $pwd, $yucontact->id);
        }
    }

    public function rules(): array
    {
        return [
            'batch_no' => 'required',
            'year' => 'required',
            'roll_no' => 'required',
            'name' => 'required',
            'dob' => 'required',
            'qualification' => 'required',
            'occupation' => 'required',
            'departement' => 'required',
            'office_phone' => 'required',
            'office_address' => 'required',
            'home_phone' => 'required',
            'resident' => 'required',
            'mobile' => 'required',
            'email' => 'required',
        ];
    }
}
