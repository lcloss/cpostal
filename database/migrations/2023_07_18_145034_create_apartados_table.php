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
        Schema::create('apartados', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('denominacao');
            $table->string('apa_inicio')->nullable();
            $table->string('apa_final')->nullable();
            $table->boolean('e_bloco')->default(true);
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
        Schema::dropIfExists('apartados');
    }
};
