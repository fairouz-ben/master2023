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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->unique();
            $table->string('name_fr')->unique();
            $table->string('code')->unique();
            $table->integer('speciality_max_choice')->default(1);
            $table->boolean('is_active')->default(true);
            $table->boolean('show_result')->default(false);

            $table->date('inscription_close_date')->nullable();
            $table->date('update_close_date')->nullable();
            $table->date('treatment_close_date')->nullable();
            $table->date('recoure_close_date')->nullable();
            
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
        Schema::dropIfExists('faculties');
    }
};
