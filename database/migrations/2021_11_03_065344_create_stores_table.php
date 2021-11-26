<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('店舗名');
            $table->string('email')->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image')->default("storage/storeimages/default.png")->comment('店舗画像');
            $table->string('tel', 20)->nullable()->comment('電話番号');
            $table->text('introduction')->nullable()->comment('店舗紹介');
            $table->string('zipcode', 10)->nullable()->comment('郵便番号');
            $table->string('prefecture')->nullable()->comment('都道府県');
            $table->string('city')->nullable()->comment('市区町村');
            $table->string('street_address')->nullable()->comment('番地');
            $table->text('business_time')->nullable()->comment('営業時間');
            $table->foreignId('owner_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['name', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
