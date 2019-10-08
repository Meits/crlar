<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeScriptsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scripts', function (Blueprint $table) {
            //
            $table->dropColumn('name');
        });

        Schema::table('scripts', function (Blueprint $table) {
            //
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scripts', function (Blueprint $table) {
            //
        });
    }
}
