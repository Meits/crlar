<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('page_id')->unsigned();
            $table->integer('field_id')->unsigned();
            $table->text('value')->nullable();
            $table->string('alias');
            $table->string('title');
            $table->string('additional')->nullable();

            $table->timestamps();
        });
        Schema::table('datas', function (Blueprint $table) {
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
        Schema::table('datas', function (Blueprint $table) {
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datas');
    }
}
