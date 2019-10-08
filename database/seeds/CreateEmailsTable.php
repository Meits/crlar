<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateEmailsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emails')->insert([
            'title' => 'Confirm registration',
            'template' => '----',
            'type' => 1,
        ]);

        DB::table('emails')->insert([
            'title' => 'Reset Password',
            'template' => '----',
            'type' => 2,
        ]);
    }
}
