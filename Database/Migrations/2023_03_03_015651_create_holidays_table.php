<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
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
            $table->string("name");
            $table->double("total_holidays")->default(0);
            $table->date("from_date")->nullable();
            $table->date("to_date")->nullable();
            $table->longText("properties")->nullable();
            $table->timestamps();
        });
        Schema::create('holiday_dates', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignId("holiday_id");
            $table->date("holiday_date");
            $table->boolean("half_day")->default(false);
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
        Schema::dropIfExists('holiday_dates');
    }
};
