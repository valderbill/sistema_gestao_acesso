<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('estacionamentos', function (Blueprint $table) {
            $table->integer('vagas_particulares')->default(0);
            $table->integer('vagas_oficiais')->default(0);
            $table->integer('vagas_motos')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('estacionamentos', function (Blueprint $table) {
            $table->dropColumn(['vagas_particulares', 'vagas_oficiais', 'vagas_motos']);
        });
    }
};
