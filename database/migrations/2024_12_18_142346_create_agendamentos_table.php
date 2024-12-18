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
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->dateTime("inicio");
            $table->dateTime("fim");
            $table->unsignedBigInteger("pet_id");
            $table->unsignedBigInteger("tutor_id")->nullable();
            $table->string("status");
            $table->decimal("preco_final");
            $table->foreign("pet_id")->references("id")->on("pets")->onDelete("restrict");
            $table->foreign("tutor_id")->references("id")->on("tutores")->onUpdate("cascade")->onDelete("restrict");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
