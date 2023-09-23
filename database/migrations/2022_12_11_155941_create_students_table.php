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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('nom_ar');
            $table->string('nom_fr');
            $table->string('prenom_ar');
            $table->string('prenom_fr');
            $table->date('date_nais');
            //$table->string('email')->unique();
           // $table->timestamp('email_verified_at')->nullable();
            //$table->string('password');
            $table->string('phone')->nullable();
            $table->string('mat_bac');
            $table->unsignedInteger('year_bac');
            $table->string('speciality_bac')->nullable();
            $table->string('code')->unique();
            $table->string('city_bac')->nullable();
            //$table->unsignedFloat('note_bac') ;
            $table->string('univ_origine');
            
            $table->string('licence_type');//LMD or classique  
            $table->string('licence');// specialite du licence exp: droit publique or privé

            $table->unsignedBigInteger('faculty_id');
            $table->foreign('faculty_id')->references('id')->on('faculties');

            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
  
            $table->string('file_path'); 

            $table->unsignedFloat('S1') ;
            $table->unsignedFloat('S2') ;
            $table->unsignedFloat('S3') ;
            $table->unsignedFloat('S4') ;
            $table->unsignedFloat('S5')->nullable()->default(0)  ;
            $table->unsignedFloat('S6')->nullable() ->default(0) ;
            $table->unsignedInteger('annee_doublon')->default(0) ;
            $table->unsignedInteger('nb_dette')->default(0) ;
            $table->unsignedInteger('nb_rattrapage')->default(0);
            $table->unsignedFloat('moy_classement')->default(0) ;

            $table->unsignedInteger('special_1') ;
            $table->unsignedInteger('special_2')->nullable() ;
            $table->unsignedInteger('special_3')->nullable() ;
            $table->unsignedInteger('special_4')->nullable() ;
            $table->string('oriented_to_speciality')->nullable(); 
            $table->mediumText('motif')->nullable();
            $table->enum('etat' ,['Accepté','Refusé','Non traité'])->default('Non traité');
            $table->boolean('is_deleted')->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->unique(["nom_fr", "prenom_fr","date_nais"], 'fr_nom_prenom_date_unique');
            $table->unique(["nom_ar", "prenom_ar","date_nais"], 'ar_nom_prenom_date_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
