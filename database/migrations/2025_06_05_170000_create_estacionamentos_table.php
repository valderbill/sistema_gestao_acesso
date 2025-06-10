<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('estacionamentos', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD:database/migrations/2025_06_05_170000_create_estacionamentos_table.php
            $table->string('nome_localizacao', 100);
=======
            $table->string('nome', 100);
            $table->integer('vagas_particulares')->default(0);
            $table->integer('vagas_oficiais')->default(0);
            $table->integer('vagas_motos')->default(0);
>>>>>>> 4718903 (10/06 correções):database/migrations/2025_06_05_171750_create_estacionamentos_table.php
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estacionamentos');
    }
};
