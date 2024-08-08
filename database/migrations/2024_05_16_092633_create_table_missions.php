<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id('ID_Mission');
            $table->text('Description')->nullable();
            $table->string('Statut', 20)->default('En cours');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('missions');
    }

};
