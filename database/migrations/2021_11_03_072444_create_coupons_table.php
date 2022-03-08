<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('クーポン名');
            $table->text('description')->comment('クーポン詳細');
            $table->string('code', 50)->nullable()->comment('クーポン番号');
            $table->date('start')->nullable()->comment('利用開始日');
            $table->date('end')->nullable()->comment('利用終了日');
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
        Schema::dropIfExists('coupons');
    }
}
