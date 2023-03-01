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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId("company_id")->nullable();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("gender");
            $table->string("employment_type")->nullable();
            $table->boolean('is_system_user')->default(false);
            $table->foreignId("user_id")->nullable();
            $table->date("date_of_birth");
            $table->date("date_of_joining");
            $table->text("properties")->nullable();
            $table->boolean("active")->default(true);
            $table->timestamps();
        });

        Schema::create('employee_contact_details', function (Blueprint $table){
            $table->id();
            $table->foreignId('employee_id');
            $table->string('mobile_number');
            $table->string('personal_email')->nullable();
            $table->string('company_email')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('current_address')->nullable();
            $table->text("properties")->nullable();
            $table->boolean("is_default")->default(false);
            $table->boolean("active")->default(true);
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
        Schema::dropIfExists('employees');
        Schema::dropIfExists('employee_contact_details');
    }
};
