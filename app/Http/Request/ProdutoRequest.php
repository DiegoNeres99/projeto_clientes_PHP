<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Pega o ID do produto na rota (para update)
        $id = $this->route('produto');

        return [
            'nome'      => 'required|min:3',
            'descricao' => 'nullable|string',
            'preco'     => 'required|numeric|min:0',
            'estoque'   => 'nullable|integer|min:0',
            'categoria' => 'nullable|string',
            'tipo'      => 'nullable|string',
            'material'  => 'nullable|string',            
            'status' => 'required|in:ativo,inativo',

        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome do produto é obrigatório.',
            'nome.min'      => 'O nome deve ter pelo menos 3 caracteres.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.numeric'  => 'O preço deve ser um número.',
            'preco.min'      => 'O preço não pode ser negativo.',
            'estoque.integer' => 'O estoque deve ser um número inteiro.',
            'estoque.min'     => 'O estoque não pode ser negativo.',            
            'status.boolean' => 'O status deve ser verdadeiro ou falso.',
        ];
    }
}
