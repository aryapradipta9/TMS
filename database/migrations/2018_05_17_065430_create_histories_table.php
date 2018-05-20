<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orderNumber');
            $table->unsignedInteger('totalJarak');
            $table->unsignedInteger('totalBerat');
            $table->date('deliveryDate');
            $table->string('keterangan');
            $table->unsignedInteger('truck');
            $table->unsignedInteger('groupId');

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
        Schema::dropIfExists('histories');
    }
}
