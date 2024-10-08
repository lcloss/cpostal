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
        Schema::create('codigo_postals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distrito_id')->constrained()->onDelete('cascade');
            $table->foreignId('concelho_id')->constrained()->onDelete('cascade');
            $table->foreignId('localidade_id')->constrained()->onDelete('cascade');
            $table->string('codigo_distrito', 2);
            $table->string('codigo_concelho', 2);
            $table->string('codigo_localidade', 4);
            $table->string('logradouro')->nullable();
            $table->string('local')->nullable();
            $table->string('troco')->nullable();
            $table->string('porta')->nullable();
            $table->string('cliente')->nullable();
            $table->string('cpost_4', 4);
            $table->string('cpost_3', 3);
            $table->string('descritivo_postal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigo_postals');
    }
};
