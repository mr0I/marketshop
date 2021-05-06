<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('offer_id')->unsigned();
            $table->double('sum', 15, 3);
            $table->double('sumprice', 15, 3);
            $table->double('sendprice', 10, 3);
            $table->double('discount', 5, 3);
            $table->double('tax', 15, 3);
            $table->double('total', 15, 3);
            $table->string('description', 300)->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('userIp');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}