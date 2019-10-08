<?php

use Illuminate\Database\Seeder;

class CreateRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                //1
                [
                    'title' => 'Administrator',
                    'alias' => 'administrator',
                ],
                //2
                [
                    'title' => 'Guest',
                    'alias' => 'guest',
                ]
            ]
        );
    }
}
