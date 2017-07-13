<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert([
            'setting_host' => 'smtp.gmail.com',
            'setting_port' => '587',
            'setting_username' => 'tuhaidenchin@gmail.com',
            'setting_mail_send' => 'tuhaidenchin@gmail.com',
            'setting_password' => '2u41197ru119',
            'setting_reply_to' => 'thang@deha-soft.com',
            'setting_mail_per_day' => 90,
            'setting_time_interval' => 5,
            'setting_deleted' => 0,
            'setting_driver' => 'smtp',
            'setting_encryption' => 'tls',
            'setting_from_name' => 'Deha VietNam',
            'mail_sent' => 0,
        ]);
    }
}
