<?php
namespace Modules\HR\Database\Migrations;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
