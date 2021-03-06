<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_notices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('title', '190');
            $table->text('content');
            $table->string('attachFile', '255');
            $table->integer('rank');
            $table->enum('released', ['1', '2'])->defalut(1);
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
        Schema::dropIfExists('admin_notices');
    }
}
