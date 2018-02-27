<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->index()->comment('카테고리 ID');
            $table->string('name')->comment('성명');
            $table->string('rank')->comment('직급');
            $table->string('company')->comment('회사명');
            $table->string('main_phone', 20)->nullable()->comment('대표전화');
            $table->string('phone_number', 20)->nullable()->comment('휴대폰');
            $table->string('fax_number', 20)->nullable()->comment('팩스');
            $table->string('zipcode', 10)->nullable()->comment('우편번호');
            $table->string('address1')->nullable()->comment('주소');
            $table->string('address2')->nullable()->comment('상세주소');
            $table->string('extra_info')->nullable()->comment('참고사항');
            $table->string('email')->comment('이메일 (로그인에 사용됨)');
            $table->text('memo')->comment('메모');
            $table->text('contents')->comment('요구사항');
            $table->string('picture','255');
            $table->text('attach_files')->comment('관련자료');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
