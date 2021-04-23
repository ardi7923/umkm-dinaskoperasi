<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldDiscountOrderListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_lists', function (Blueprint $table) {
            $table->double('discount')->default(0)->after('price');
            $table->double('sub_total')->default(0)->after('ammount');
            $table->double('total_discount')->default(0)->after('sub_total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_lists', function (Blueprint $table) {
            $table->dropColumn('discount');
            $table->dropColumn('sub_total');
            $table->dropColumn('total_discount');
        });
    }
}
