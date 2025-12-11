<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('removal_requests', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj', 14);
            $table->string('nome');
            $table->string('email');
            $table->string('vinculo');
            $table->text('motivo');
            $table->boolean('aceite_lgpd');
            $table->boolean('confirmacao_responsavel');
            $table->boolean('entende_prazo_buscas');
            $table->uuid('token');
            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('removal_requests');
    }
};
