<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToVeiculosTable extends Migration
{
    public function up()
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }
}
