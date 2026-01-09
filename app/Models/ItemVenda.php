<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemVenda extends Model
{
    protected $table = 'itens_vendas';

    protected $fillable = [
        'venda_id',
        'produto_id',
        'quantidade',
        'valor_unitario',
        'subtotal',
    ];

    protected $casts = [
        'valor_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /* ================= RELACIONAMENTOS ================= */

    public function venda(): BelongsTo
    {
        return $this->belongsTo(Venda::class);
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }
}
