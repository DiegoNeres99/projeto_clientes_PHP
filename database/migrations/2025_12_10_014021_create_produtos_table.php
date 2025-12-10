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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->decimal('preco', 10, 2);
            $table->integer('estoque');
            $table->enum('categoria', ['masculino', 'feminino', 'infantil'])->nullable();
            $table->string('tipo')->nullable();
            $table->string('material')->nullable();
            $table->string('imagem')->nullable();
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
