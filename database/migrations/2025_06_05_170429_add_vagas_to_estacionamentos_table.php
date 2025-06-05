<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('estacionamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_localizacao', 100);
            $table->integer('vagas_particulares')->default(0);
            $table->integer('vagas_oficiais')->default(0);
            $table->integer('vagas_motos')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estacionamentos');
    }
};
