<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->enum('level' ,['m1','m2'])->nullable();
            $table->string('title')->unique();
            $table->string('title_fr')->unique();
            $table->integer('number_available')->nullable();
            $table->string('related_to_license')->nullable();// value: null,all, id (int)

            $table->boolean('is_active')->default(true);
            
            $table->boolean('is_deleted')->default(false);
            
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
        Schema::dropIfExists('specialities');
    }
};
