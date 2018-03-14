<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id')->index()->comment('고객테이블 ID');
            $table->string('placeOfDelivery')->nullable()->comment('납품장소');
            $table->integer('price')->nullable()->comment('매출금액');
            $table->timestamp('sales_at')->nullable()->comment('매출발생일');
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
        Schema::dropIfExists('sales');
    }
}
