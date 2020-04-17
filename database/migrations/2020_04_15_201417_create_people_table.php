<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gender_id')->constrained();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->dateTime('birth_date')->nullable();
            $table->dateTime('death_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function(Blueprint $table) {
            $table->foreignId('person_id')->index()->nullable();
        });

        Schema::table('name_history', function(Blueprint $table) {
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
        });

        Schema::table('address_history', function(Blueprint $table) {
            $table->foreignId('person_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
