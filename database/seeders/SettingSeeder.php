<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert(
            [
                [
                    'key' => 'reg_approve',
                    'value' => OFF,
                    'type' => 'chcekbox',
                ],
                [
                    'key' => 'sned_email',
                    'value' => OFF,
                    'type' => 'chcekbox',
                ],
                [
                    'key' => 'signup_email',
                    'value' => 'admin@gmail.com',
                    'type' => 'string',
                ],
                [
                    'key' => 'member_expire_notify_date',
                    'value' => '7',
                    'type' => 'integer',
                ],
                [
                    'key' => 'book_rent_duration',
                    'value' => '14',
                    'type' => 'integer',
                ],
                [
                    'key' => 'staff_book_rent_duration',
                    'value' => '30',
                    'type' => 'integer',
                ],
                [
                    'key' => 'sned_email_to_new_book',
                    'value' => OFF,
                    'type' => 'chcekbox',
                ],
                [
                    'key' => 'sned_email_to_user_account',
                    'value' => OFF,
                    'type' => 'chcekbox',
                ],
                [
                    'key' => 'sned_email_to_user_overred_time',
                    'value' => OFF,
                    'type' => 'chcekbox',
                ],
                [
                    'key' => 'send_mail_to_user_for_return',
                    'value' => '7',
                    'type' => 'integer',
                ],


                // [
                //     'title' => 'Register Approve',
                //     'desc' => 'Register member Lists are auto approve .',
                //     'key' => 'blog_feature',
                //     'value' => 0,
                //     'input_type' => 'checkbox',
                // ],
                // [
                //     'title' => 'Contact Feature',
                //     'desc' => 'Contact Feature Description',
                //     'key' => 'sned_email',
                //     'value' => 0,
                //     'input_type' => 'checkbox',
                // ],
                // [
                //     'title' => 'Frontend Site Name',
                //     'desc' => 'Frontend Site Description',
                //     'key' => 'signup_email',
                //     'value' => 'admin@gmail.com',
                //     'input_type' => 'text',
                // ],
            ],
        );
    }
}
