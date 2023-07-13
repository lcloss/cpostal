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
        Schema::create('concelhos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distrito_id')->constrained()->onDelete('cascade');
            $table->string('codigo_distrito', 2);
            $table->string('codigo', 2);
            $table->string('nome');
            $table->timestamps();
            $table->unique(['codigo_distrito', 'codigo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concelhos');
    }
};
