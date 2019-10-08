<?php

use Illuminate\Database\Seeder;

class CreateSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                //1
                [
                    'field' => 'system_email',
                    'value' => 'rani@ranimaree.com',
                    'title' => 'From Emai',
                    'type' => 'text',
                ],[
                    'field' => 'system_email_name',
                    'value' => '',
                    'title' => 'From Name',
                    'type' => 'text',
                ],[
                    'field' => 'system_host',
                    'value' => '',
                    'title' => 'SMTP Host',
                    'type' => 'text',
                ],[
                    'field' => 'system_email_port',
                    'value' => '',
                    'title' => 'SMTP Port',
                    'type' => 'text',
                ],[
                    'field' => 'system_email_username',
                    'value' => '',
                    'title' => 'SMTP Username',
                    'type' => 'text',
                ],[
                    'field' => 'system_email_password',
                    'value' => '',
                    'title' => 'SMTP Password',
                    'type' => 'text',
                ],[
                    'field' => 'system_email_encryption',
                    'value' => '',
                    'title' => 'System Email Enc',
                    'type' => 'text',
                ],
                [
                    'field' => 'contact_to',
                    'value' => '',
                    'title' => 'Contact form email recipient',
                    'type' => 'text',
                ],
                [
                    'field' => 'contact_subject',
                    'value' => '',
                    'title' => 'Contact form email subject',
                    'type' => 'text',
                ],
                [
                    'field' => 'system_photo',
                    'value' => 'TXmSeGefeV.png',
                    'title' => 'Administrator Photo',
                    'type' => 'file',
                ],
            ]
        );
    }
}
