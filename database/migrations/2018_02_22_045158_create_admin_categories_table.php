<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->index()->comment('카테고리 쓰레드 부모');
            $table->integer('order');
            $table->string('title', '50');
            $table->timestamps();

            //$table->foreign('parent_id')->references('id')->on('admin_categories');
        });
    }
    /**php artisan admin:make UserController --model=App\\User
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_categories');
    }
}
