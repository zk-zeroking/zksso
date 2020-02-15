<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThirdAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('third_account', function (Blueprint $table) {
            $table->integer('user_id')->comment('用户id');
            $table->string('platform')->comment('第三方平台');
            $table->string('third_open_id')->comment('第三方开放平台开放id');
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
        Schema::dropIfExists('third_account');
    }
}
