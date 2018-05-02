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
            $table->unsignedInteger('customer_id')->comment('고객테이블 ID');
            $table->unsignedInteger('user_id')->comment('회원 ID');
            $table->string('placeOfDelivery')->nullable()->comment('매출건명');
            $table->integer('price')->nullable()->comment('매출금액');
            $table->integer('collectPriceAll')->nullable()->comment('총 입금금액');
            $table->integer('noCollectPrice')->nullable()->comment('총 미수금액');
            $table->integer('collectPrice1')->nullable()->comment('입금금액1');
            $table->integer('collectPrice2')->nullable()->comment('입금금액2');
            $table->integer('collectPrice3')->nullable()->comment('입금금액3');
            $table->integer('collectPrice4')->nullable()->comment('입금금액4');
            $table->integer('collectPrice5')->nullable()->comment('입금금액5');
            $table->integer('collectPrice6')->nullable()->comment('입금금액6');
            $table->integer('collectPrice7')->nullable()->comment('입금금액7');
            $table->integer('collectPrice8')->nullable()->comment('입금금액8');
            $table->integer('collectPrice9')->nullable()->comment('입금금액9');
            $table->integer('collectPrice10')->nullable()->comment('입금금액10');
            $table->timestamp('sales_at')->nullable()->comment('매출발생일');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade');
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
