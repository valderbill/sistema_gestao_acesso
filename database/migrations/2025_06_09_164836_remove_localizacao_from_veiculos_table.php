<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLocalizacaoFromVeiculosTable extends Migration
{
    public function up()
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->dropColumn('localizacao');
        });
    }

    public function down()
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->string('localizacao', 100)->nullable(false);
        });
    }
}