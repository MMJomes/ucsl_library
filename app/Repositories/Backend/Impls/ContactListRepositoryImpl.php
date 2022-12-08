<?php

namespace App\Repositories\Backend\Impls;

use App\DataTables\MemberDataTable;
use App\Http\Requests\BookRequest;
use App\Http\Requests\MemberRequest;
use App\Models\Member;
use App\Models\Setting;
use App\Notifications\SendEmail;
use App\Repositories\Backend\Interf\ContactListRepository;
use DateTime;
use Illuminate\Support\Facades\Hash;

class ContactListRepositoryImpl implements ContactListRepository
{


    public function create(MemberRequest $request): Member
    {
        $setting_approve =  Setting::where('key', 'reg_approve')->first();
        $setting_sned_email =  Setting::where('key', 'sned_email')->first();
        $name = $request->name;
        $mobile = $request->mobile;
        $usernamed = preg_replace('/\s+/', '', $name);
        $usernamefirst = substr($usernamed, 0, 3);

        $usermobiles = preg_replace('/\s+/', '', $mobile);
        $usermobile = substr($usermobiles, -4);
        $userfullname = $usernamefirst . $usermobile;

        $dated = DateTime::createFromFormat('Y-m-d', $request->dob);
        $pwd =  $dated->format('dmY');
        //$userpassword = Hash::make($pwd);
        if ($setting_approve->value == ON) {
            $request->merge([
                'username' => $userfullname,
                'password' => $pwd,
                'status' => ON,
            ]);
        } else {
            $request->merge([
                'username' => $userfullname,
                'password' => $pwd,
            ]);
        }
        $yueembcontact = Member::create($request->all());
        if ($setting_sned_email->value == ON && $yueembcontact->email) {
            //ContactMailServiceJob::dispatch($request->username, $pwd);
            $yueembcontact->notify(new SendEmail($pwd, $userfullname));
        }
        return $yueembcontact;
    }
}
