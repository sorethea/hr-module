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
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->double("max_allocation_allowed")->default(0);
            $table->double("max_consecutive_allowed")->default(0);
            $table->double("applicable_after")->default(0);
            $table->boolean("carry_forward")->default(false);
            $table->boolean("without_pay")->default(false);
            $table->boolean("allow_encashment")->default(false);
            $table->boolean("earned_leave")->default(false);
            $table->boolean("compensatory")->default(false);
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
        Schema::dropIfExists('leave_types');
    }
};
