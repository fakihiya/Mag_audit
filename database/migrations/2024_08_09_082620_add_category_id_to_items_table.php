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
        Schema::table('items', function (Blueprint $table) {

            $table->unsignedBigInteger('categories_item_id')->after('libelle')->default(1);

            $table->foreign('categories_item_id')->references('id')->on('categories_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {

            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
