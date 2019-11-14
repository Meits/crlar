<?php

namespace App\Modules\Admin\Lead\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTable extends Seeder
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

                //
                [
                    'title' => 'Manager',
                    'alias' => 'manager'
                ],
                //3
                [
                    'title' => 'Manager Admin',
                    'alias' => 'manager_admin',
                ]
            ]
        );
    }
}
