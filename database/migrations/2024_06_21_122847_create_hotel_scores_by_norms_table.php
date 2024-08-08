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
        Schema::create('hotel_scores_by_norms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedBigInteger('norm_id');
            $table->unsignedBigInteger('id_item');
            $table->decimal('score', 5, 2)->nullable();
            $table->text('remarques')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('verifie');
            $table->unsignedBigInteger('mission')->nullable();

            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->foreign('norm_id')->references('id')->on('normes')->onDelete('cascade');
            $table->foreign('id_item')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('mission')->references('ID_Mission')->on('missions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_scores_by_norms');
    }
};
