<?php
namespace App\Modules\Admin\Sources\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class SourceTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sources')->insert([
            ['title' => 'Instagram'],
            ['title' => 'Viber'],
            ['title' => 'Telegram'],
            ['title' => 'Message'],
            ['title' => 'Сайт'],
            ['title' => 'Звонок'],
            ['title' => 'Почта'],
            ['title' => 'OLX'],
        ]);
    }
}
