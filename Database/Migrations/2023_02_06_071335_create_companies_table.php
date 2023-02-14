<?php
namespace Modules\HR\Database\Migrations;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("abbr")->unique();
            $table->string("domain")->nullable();
            $table->boolean("is_group")->default(false);
            $table->text("description")->nullable();
            $table->foreignId("parent_id")->nullable();
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
        Schema::dropIfExists('companies');
    }
};
