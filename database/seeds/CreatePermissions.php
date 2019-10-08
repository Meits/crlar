<?php

use Illuminate\Database\Seeder;

class CreatePermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(
            [
                [
                    'alias' => 'SUPER_ADMINISTRATOR',
                    'title' => 'Super Administrator Access',
                ],
                [
                    'alias' => 'ADMINISTRATOR_ACCESS',
                    'title' => 'Administrator Access',
                ],
                [
                    'alias' => 'SETTINGS_ACCESS',
                    'title' => 'Settings Access',
                ],
                [
                    'alias' => 'USERS_ACCESS',
                    'title' => 'Users Access',
                ],
                [
                    'alias' => 'BLOG_ACCESS',
                    'title' => 'Blog Access',
                ],
                [
                    'alias' => 'FAQ_ACCESS',
                    'title' => 'Faq Access',
                ],
                [
                    'alias' => 'ROLES_ACCESS',
                    'title' => 'Roles Access',
                ]

            ]
        );
    }
}
