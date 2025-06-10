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
        Schema::create('perfil_permissoes', function (Blueprint $table) {
            // Não é necessário id, porque a chave primária será composta
            $table->unsignedBigInteger('perfil_id');
            $table->unsignedBigInteger('permissao_id');

            // Chave primária composta
            $table->primary(['perfil_id', 'permissao_id']);

            // Foreign keys
<<<<<<< HEAD
            $table->foreign('perfil_id')->references('id')->on('perfis')->onDelete('cascade');  // Corrigido para 'perfis'
=======
            $table->foreign('perfil_id')->references('id')->on('perfis')->onDelete('cascade');
>>>>>>> 4718903 (10/06 correções)
            $table->foreign('permissao_id')->references('id')->on('permissoes')->onDelete('cascade');

            // Timestamps opcionais para registro de quando foi criado/atualizado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_permissoes');
    }
};
