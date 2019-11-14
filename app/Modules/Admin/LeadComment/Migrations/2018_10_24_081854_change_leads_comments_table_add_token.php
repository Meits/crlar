<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLeadsCommentsTableAddToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_comments', function (Blueprint $table) {
            //
            $table->integer('lead_id')->unsigned()->nullable();;
        });

        Schema::table('lead_comments', function (Blueprint $table) {
            //
            $table->foreign('lead_id')->references('id')->on('leads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_comments', function (Blueprint $table) {
            //
        });
    }
}
