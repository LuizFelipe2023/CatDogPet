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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string("nome",500);
            $table->string("raca",255);
            $table->string("porte", 255);
            $table->decimal("peso",10,2);
            $table->decimal("altura",10,2);
            $table->unsignedBigInteger("tutor_id");
            $table->foreign("tutor_id")->references("id")->on("tutores")->onDelete("restrict")->onUpdate("cascade");
            $table->string("foto_perfil")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
