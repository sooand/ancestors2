<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('relation_type_id')->constraint();
            $table->integer('from_person_id')->index()->unsigned();
            $table->foreign('from_person_id')->references('id')->on('people')->onDelete('no action');
            $table->integer('to_person_id')->index()->unsigned();
            $table->foreign('to_person_id')->references('id')->on('people')->onDelete('no action');
            $table->dateTime('valid_from')->nullable();
            $table->dateTime('valid_to')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people_relations');
    }
}
