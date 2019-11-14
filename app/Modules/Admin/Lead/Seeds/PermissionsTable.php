<?php
namespace App\Modules\Admin\Lead\Seeds;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PermissionsTable extends Seeder
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
                    'title' => 'DASHBOARD VIEW',
                    'alias' => 'DASHBOARD_VIEW',
                ],
                [
                    'title' => 'GATE VIEW',//2
                    'alias' => 'GATE_VIEW',//2
                ],
                [
                    'title' => 'HISTORY VIEW',//3
                    'alias' => 'HISTORY_VIEW',//3
                ],
                [
                    'title' => 'ADMIN VIEW',//4
                    'alias' => 'ADMIN_VIEW',//4
                ],
                [
                    'title' => 'LEADS CREATE',//5
                    'alias' => 'LEADS_CREATE',//5
                ],
                [
                    'title' => 'LEADS EDIT',//6
                    'alias' => 'LEADS_EDIT',//6
                ],
                [
                    'title' => 'TASKS CREATE',//7
                    'alias' => 'TASKS_CREATE',//7
                ],
                [
                    'title' => 'TASKS EDIT',//8
                    'alias' => 'TASKS_EDIT',//8
                ],
                [
                    'title' => 'TASKS VIEW',//9
                    'alias' => 'TASKS_VIEW',//9
                ],
                [
                    'title' => 'ANALITICS VIEW',//10
                    'alias' => 'ANALITICS_VIEW',//10
                ],
                [
                    'title' => 'CHANGE AUTHORS',//11
                    'alias' => 'CHANGE_AUTHORS',//11
                ]
            ]

        );
    }
}
