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
        Schema::create('leave_periods', function (Blueprint $table) {
            $table->id();
            $table->date('from_date');
            $table->date('to_date');
            $table->foreignId("company_id");
            $table->foreignId('holiday_id')->nullable();
            $table->boolean("active")->default(false);
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
        Schema::dropIfExists('leave_periods');
    }
};
