<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('estacionamentos', function (Blueprint $table) {
            $table->renameColumn('nome', 'localizacao');
        });
    }

    public function down(): void
    {
        Schema::table('estacionamentos', function (Blueprint $table) {
            $table->renameColumn('localizacao', 'nome');
        });
    }
};
