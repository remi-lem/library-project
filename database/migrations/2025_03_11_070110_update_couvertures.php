<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::update("UPDATE Tome
            JOIN Editeur ON Tome.idEditeur = Editeur.id
            SET Tome.couverture = REPLACE(Editeur.imgPattern, '<IMG>', Tome.ISBN)
            WHERE Tome.ISBN > 999999999;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
