<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('avatar');
            $table->unsignedInteger('article_count')->default(0);
            $table->smallInteger('is_active')->default(0);
            $table->string('register_platform',20)->default('local');
            $table->unsignedInteger('platform_id')->index()->nullable();
            $table->unsignedInteger('follower_count')->default(0); //粉丝数
            $table->unsignedInteger('followed_count')->default(0); //关注数
            $table->json('settings')->nullable();
            $table->string('api_token',64);
            $table->string('confirm_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
