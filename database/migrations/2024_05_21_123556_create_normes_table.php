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
        Schema::create('normes', function (Blueprint $table) {
            $table->id();
            $table->string('Normes', 1251)->nullable();
            $table->unsignedInteger('etoile1')->nullable();
            $table->unsignedInteger('etoile2')->nullable();
            $table->unsignedInteger('etoile3')->nullable();
            $table->unsignedInteger('etoile4')->nullable();
            $table->unsignedInteger('etoile5')->nullable();
            $table->unsignedInteger('Luxe')->nullable();
            $table->unsignedBigInteger('ITEM')->nullable();
            $table->unsignedBigInteger('legende')->nullable();
            $table->unsignedBigInteger('TYPE')->nullable();
            $table->text('normes_arabe')->nullable();
            $table->string('Code_critère', 50);

            $table->foreign('ITEM')->references('id')->on('items');
            $table->foreign('legende')->references('id')->on('table_legende');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('normes');
    }
};
