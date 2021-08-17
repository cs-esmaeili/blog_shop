<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id('product_id');
            $table->timestamps();
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('category_id')->on('category');
            $table->string('name',255)->unique();
            $table->decimal('price',12,0);
            $table->decimal('sale_price',12,0);
            $table->enum('status',['available','unavailable' , 'invisibel']);
            $table->mediumInteger('stock');
            $table->mediumInteger('order_number');
            $table->foreignId('file_id');
            $table->foreign('file_id')->references('file_id')->on('file');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
