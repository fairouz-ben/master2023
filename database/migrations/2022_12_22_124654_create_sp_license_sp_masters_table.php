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
        Schema::create('sp_license_sp_masters', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('License_specialty_id');
            $table->foreign('License_specialty_id')->references('id')->on('license_specialties');
            $table->unsignedBigInteger('speciality_id');
            $table->foreign('speciality_id')->references('id')->on('specialities');
            $table->unique(["License_specialty_id", "speciality_id"], 'L_specialty_M_speciality_unique');
      
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
        Schema::dropIfExists('sp_license_sp_masters');
    }
};
