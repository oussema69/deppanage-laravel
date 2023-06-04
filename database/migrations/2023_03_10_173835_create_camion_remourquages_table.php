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
        if (!Schema::hasTable('clients')) {
            Schema::create('clients', function (Blueprint $table) {
                $table->id();
                $table->string('nom');
                $table->string('prenom');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('matricule')->unique();
                $table->string('tel');
                $table->boolean('isValid')->default(false);
                $table->string('num_assurance');
                $table->timestamps();
            });
        }

        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('marque');
            $table->string('modele');
            $table->string('matricule')->unique();
            $table->integer('num_assurance');
            $table->date('date_payment_assurance');
            $table->date('date_fin');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->timestamps();
        });

        Schema::create('camion_remourquage', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('model');
            $table->string('etat');
            $table->timestamps();
        });


        Schema::create('camion_remourquage_car', function (Blueprint $table) {
            $table->unsignedBigInteger('camion_remourquage_id');
            $table->unsignedBigInteger('car_id');
            $table->dateTime('date');
            $table->foreign('camion_remourquage_id')->references('id')->on('camion_remourquage')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->timestamps();
        });


        Schema::create('chauffeurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('tel');
            $table->string('condition');
            $table->string('device_token')->nullable();
            $table->unsignedBigInteger('camion_remourquage_id')->unique();
            $table->foreign('camion_remourquage_id')->references('id')->on('camion_remourquage')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->integer('nbr_personne');
            $table->string('type_veh');
            $table->string('nom');
            $table->string('device_token');
            $table->date('date');
            $table->integer('tel');
            $table->double('longitude');
            $table->double('latitude');
            $table->boolean('isValid')->default(false);
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('car_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('car_id')->references('id')->on('cars')->nullable();
            $table->unsignedBigInteger('chauffeur_id')->nullable();
            $table->foreign('chauffeur_id')->references('id')->on('chauffeurs')->nullable();
            $table->timestamps();
        });
        Schema::create('administrateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password');
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
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
        });
        Schema::dropIfExists('clients');
        Schema::dropIfExists('cars');
        Schema::dropIfExists('camion_remourquage');
        Schema::dropIfExists('camion_remourquage_car');
        Schema::dropIfExists('chauffeurs');
        Schema::table('demandes', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['chauffeur_id']);
        });
        Schema::dropIfExists('demandes');
        Schema::table('demandes', function (Blueprint $table) {
            $table->dropColumn(['longitude', 'latitude', 'isValid']);
        });


    }

};



