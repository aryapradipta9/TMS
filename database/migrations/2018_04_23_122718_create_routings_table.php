<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orderNumber');
            $table->unsignedInteger('truck');

            $table->foreign('orderNumber')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
            $table->foreign('truck')
                ->references('id')
                ->on('modas')
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
        Schema::dropIfExists('routings');
    }
}
