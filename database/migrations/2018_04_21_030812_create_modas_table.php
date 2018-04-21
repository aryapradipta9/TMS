<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('vendor');
            $table->bigInteger('quantity')->unsigned();
            $table->bigInteger('tonase')->unsigned();
            $table->integer('duration')->unsigned();
            $table->date('startFrom');
            $table->date('endTo');
            $table->char('status');

            $table->foreign('vendor')
                ->references('nama')
                ->on('vendors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modas');
    }
}
