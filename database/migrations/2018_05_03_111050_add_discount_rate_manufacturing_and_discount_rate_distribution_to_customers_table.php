<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscountRateManufacturingAndDiscountRateDistributionToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->float('discountRateDistribution')->nullable()->atfer('attach_files')->comment('유통할인율');
            $table->float('discountRateManufacturing')->nullable()->after('attach_files')->comment('제조할인율');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['discountRateManufacturing', 'discountRateDistribution']);
        });
    }
}
