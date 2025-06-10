<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->string('localizacao', 100)->nullable(false);
        });
    }

    public function down(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->dropColumn('localizacao');
        });
    }
};
