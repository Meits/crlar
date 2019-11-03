<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_contents', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();
            $table->text('text')->nullable();

            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');

            $table->integer('faq_id')->unsigned();
            $table->foreign('faq_id')->references('id')->on('faqs')->onDelete('cascade');


            $table->timestamps();
        });

        Schema::table('faqs', function (Blueprint $table) {
            //
            //$table->dropColumn('title');
            //$table->dropColumn('text');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_contents');
    }
}
