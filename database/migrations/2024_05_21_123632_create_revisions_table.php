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
        Schema::create('revisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_Mission')->nullable();
            $table->unsignedBigInteger('ID_Auditeur')->nullable();
            $table->text('Commentaire')->nullable();
            $table->string('Statut', 50)->nullable();
            $table->timestamp('Date_Revision')->default(now());

            $table->foreign('ID_Mission')->references('ID_Mission')->on('missions');
            $table->foreign('ID_Auditeur')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revisions');
    }
};
