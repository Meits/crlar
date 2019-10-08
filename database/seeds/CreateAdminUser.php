<?php

use Illuminate\Database\Seeder;

class CreateAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'admin',
            'lastname' => 'admin',
            'phone' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'status' => 1,
        ]);
    }
}
