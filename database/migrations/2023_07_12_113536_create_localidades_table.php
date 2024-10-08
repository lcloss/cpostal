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
        Schema::create('localidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distrito_id')->constrained()->onDelete('cascade');
            $table->foreignId('concelho_id')->constrained()->onDelete('cascade');
            $table->string('codigo_distrito', 2);
            $table->string('codigo_concelho', 2);
            $table->string('codigo', 25);
            $table->string('nome');
            $table->timestamps();
            $table->unique(['codigo_distrito', 'codigo_concelho', 'codigo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localidades');
    }
};
