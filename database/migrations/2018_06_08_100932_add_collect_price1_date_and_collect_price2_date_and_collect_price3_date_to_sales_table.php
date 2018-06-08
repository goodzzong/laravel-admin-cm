<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollectPrice1DateAndCollectPrice2DateAndCollectPrice3DateToSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->timestamp('collectPrice3_date')->after('collectPrice10')->nullable()->comment('수금일(3차)');
            $table->timestamp('collectPrice2_date')->after('collectPrice10')->nullable()->comment('수금일(2차)');
            $table->timestamp('collectPrice1_date')->after('collectPrice10')->nullable()->comment('수금일(1차)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn(['collectPrice1_date', 'collectPrice2_date','collectPrice3_date']);
        });
    }
}
