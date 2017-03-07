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
            $table->increments('id');
            $table->string('title')->unique()->comment('商品标题');
            $table->float('price')->default(0)->comment('单人购买价格');
            $table->integer('number')->default(0)->comment('库存数量');
            $table->json('img')->nullable()->comment('商品图片地址');
            $table->longText('description')->comment('商品详情');
            $table->softDeletes();
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
