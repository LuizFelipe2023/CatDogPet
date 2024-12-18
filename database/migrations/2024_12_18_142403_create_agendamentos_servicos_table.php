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
        Schema::create('agendamentos_servicos', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('agendamento_id'); 
            $table->unsignedBigInteger('servico_id'); 
            $table->integer('duracao'); 
            $table->timestamps(); 
            $table->foreign('agendamento_id')->references('id')->on('agendamentos')->onDelete('cascade');
            $table->foreign('servico_id')->references('id')->on('servicos')->onDelete('restrict'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos_servicos');
    }
};
