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
        Schema::create('historique_missions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_Mission');
            $table->dateTime('Date_Changement')->default(now());
            $table->string('Statut', 20);
            $table->text('Commentaire')->nullable();

            $table->foreign('ID_Mission')->references('ID_Mission')->on('missions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_missions');
    }
};
