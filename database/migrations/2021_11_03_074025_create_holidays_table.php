<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->boolean("sunday")->default(0);
            $table->boolean("monday")->default(0);
            $table->boolean("tuesday")->default(0);
            $table->boolean("wednesday")->default(0);
            $table->boolean("thursday")->default(0);
            $table->boolean("friday")->default(0);
            $table->boolean("saturday")->default(0);
            $table->foreignId('store_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('holidays');
    }
}
