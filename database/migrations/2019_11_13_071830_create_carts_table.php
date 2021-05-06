<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('brand');
            $table->string('color');
            $table->string('image');
            $table->integer('count')->unsigned()->default(1);
            $table->double('unitprice', 15, 3);
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('userip');
            $table->string('slug');
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
        Schema::dropIfExists('carts');
    }
}