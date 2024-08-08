<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('Sexe')->nullable();
            $table->integer('Age')->nullable();
            $table->string('Profession')->nullable();
            $table->enum('EnCouple', ['En couple', 'Seul']);
            $table->string('TypeVisite')->nullable();
            $table->string('CanalReservation')->nullable();
            $table->integer('Chambre')->nullable();
            $table->timestamp('ReservationEffectuee')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'Sexe',
                'Age',
                'Profession',
                'EnCouple',
                'Visite',
                'Chambre',
                'ReservationEffectuee',
                'CanalReservation'
            ]);
        });
    }
};