<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique()->comment('拼团标题');
            $table->float('pt_price')->comment('拼团价格');
            $table->text('img_index')->nullable()->comment('拼团主图');
            $table->tinyInteger('pt_number')->default(2)->comment('成团人数');
            $table->tinyInteger('weight')->default(0)->comment('权重');
            $table->date('over_time')->comment('结束时间');
            $table->enum('status',['1', '0'])->default(1)->comment('是否上架');
            $table->integer('product_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('activities');
    }
}
