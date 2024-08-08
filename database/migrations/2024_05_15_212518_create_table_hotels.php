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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('Nom');
            $table->string('Adresse');
            $table->unsignedBigInteger('type');
            $table->enum('categorie', ['etoile1', 'etoile2' ,'etoile3','etoile4','etoile5','Luxe']);
            $table->foreign('type')->references('id')->on('type_etablissements');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_hotels');
    }
};
