<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venda extends Model
{
    protected $casts = [
        'data_venda' => 'datetime',
        'valor_total' => 'decimal:2',
        'desconto' => 'decimal:2',
        'acrescimo' => 'decimal:2',
    ];

    protected $fillable = [
        'cliente_id',
        'data_venda',
        'valor_total',
        'desconto',
        'acrescimo',
        'forma_pagamento',
        'status',
        'numero_nota',
        'chave_nfe',
        'observacoes',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemVenda::class);
    }
}

