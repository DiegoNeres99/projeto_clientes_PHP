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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();

            // Relacionamentos
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('restrict');

            // Dados da venda
            $table->dateTime('data_venda');
            $table->decimal('valor_total', 10, 2);
            $table->decimal('desconto', 10, 2)->default(0);
            $table->decimal('acrescimo', 10, 2)->default(0);
            // Pagamento
            $table->string('forma_pagamento'); // pix, cartão, dinheiro...
            $table->enum('status', ['aberta', 'paga', 'cancelada'])->default('aberta');
            // Fiscal (opcional)
            $table->string('numero_nota')->nullable();
            $table->string('chave_nfe')->nullable();
            // Extras
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
