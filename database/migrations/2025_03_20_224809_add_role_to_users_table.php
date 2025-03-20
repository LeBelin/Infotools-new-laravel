<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['Responsable', 'Commercial'])->default('Commercial');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Vérifiez si la colonne existe avant de la supprimer
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
