<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->engine = "InnoDB";
            $table->id();
            $table->bigInteger('umkm_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->double('umkm_price');
            $table->double('price');
            $table->string('image');
            $table->boolean('published')->default(0);
            $table->boolean('verified')->default(0);
            $table->timestamps();

            $table->foreign('umkm_id')->references('id')->on('umkms')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('restrict')
                ->onUpdate('cascade');
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
