<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class VendaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_id'                => 'required|exists:clientes,id',
            //'data_venda'                => 'required|date',
            'forma_pagamento'           => 'required|string|max:50',
            'desconto'                  => 'nullable|numeric|min:0',
            'acrescimo'                 => 'nullable|numeric|min:0',
            'observacoes'               => 'nullable|string',

            'itens'                     => 'required|array|min:1',
            'itens.*.produto_id'        => 'required|exists:produtos,id',
            'itens.*.quantidade'        => 'required|integer|min:1',
            'itens.*.valor_unitario'    => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'cliente_id.required' => 'O cliente é obrigatório.',
            'itens.required'      => 'A venda deve possuir ao menos um item.',
            'itens.min'           => 'A venda deve possuir ao menos um item.',
        ];
    }
}
