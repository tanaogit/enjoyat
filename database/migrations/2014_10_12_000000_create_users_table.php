<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('username', 15)->comment('ユーザー名');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 64)->comment('パスワード');
            $table->string('name', 60)->nullable()->comment('氏名');
            $table->string('icon')->default("storage/userimages/default.png")->comment('アイコン');
            $table->string('tel', 21)->nullable()->comment('電話番号');
            $table->string('zipcode', 10)->nullable()->comment('郵便番号');
            $table->string('prefecture', 65)->nullable()->comment('都道府県');
            $table->string('city', 65)->nullable()->comment('市区町村');
            $table->string('street_address', 65)->nullable()->comment('番地');
            $table->tinyInteger('gender')->unsigned()->nullable()->comment('性別 : 男性(1), 女性(2)');
            $table->date('birthday')->nullable()->comment('生年月日');
            $table->boolean('social_login')->default(0)->comment('ソーシャルログインアカウントか判定');
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
