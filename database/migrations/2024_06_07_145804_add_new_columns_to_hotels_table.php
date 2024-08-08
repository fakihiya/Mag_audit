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
        Schema::table('hotels', function (Blueprint $table) {
       
            $table->string('Nom_de_responsable');
            $table->string('tele_de_responsable')->after('Nom_de_responsable');
            $table->string('tele_hotel')->after('tele_de_responsable');
            $table->string('siteweb')->after('tele_hotel');
            $table->string('email_hotel')->after('siteweb');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('Nom_de_responsable');
            $table->dropColumn('tele_de_responsable');
            $table->dropColumn('tele_hotel');
            $table->dropColumn('siteweb');
            $table->dropColumn('email_hotel');
        });
    }
};
