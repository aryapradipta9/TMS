<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dist_vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('origin');
            $table->unsignedInteger('dest');
            $table->unsignedInteger('distance');

            $table->foreign('origin')
                ->references('id')
                ->on('vendors')
                ->onDelete('cascade');
            $table->foreign('dest')
                ->references('id')
                ->on('customers')
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
        Schema::dropIfExists('dist_vendors');
    }
}
