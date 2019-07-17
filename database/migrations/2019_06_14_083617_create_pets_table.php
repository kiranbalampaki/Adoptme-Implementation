<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type',['cat','dog']);
            $table->string('pet_photo');
            $table->string('name');
            $table->string('breed');
            $table->enum('gender',['m','f']);
            $table->enum('age',['young','adult','senior']);
            $table->enum('size',['small','medium','large','extra large']);
            $table->enum('color',['black','white','brown','grey','multicolor']);
            $table->boolean('is_vaccinated')->default(false);
            $table->boolean('is_dewormed')->default(false);
            $table->boolean('is_adopted')->nullable()->default(false);
            $table->mediumText('details');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}
