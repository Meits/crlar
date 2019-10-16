<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddLanguages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert(
            [
                //1
                [
                    'name' => 'Украинский',
                    'code' => 'ua',
                ],
                [
                    'name' => 'Русский',
                    'code' => 'ru',
                ],
            ]
        );
    }
}
