<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 100);
            $table->string('brand', 100)->nullable();
            $table->integer('code')->unsigned();
            $table->bigInteger('price');
            $table->bigInteger('offprice')->nullable()->default(0);
            $table->longText('description');
            $table->integer('category_id');
            $table->boolean('availablity')->nullable()->default(false);
            $table->boolean('specialOffer')->nullable()->default(false);
            $table->integer('sellCount')->unsigned()->nullable()->default(0);
            $table->float('vote')->unsigned()->default(0);
            $table->string('indexImage');
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
        Schema::dropIfExists('products');
    }
}
