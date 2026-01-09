<?php

namespace App\Http\Controllers;

use App\Http\Request\VendaRequest;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    /**
     * Listar vendas
     */
    public function index()
    {
        $vendas = Venda::with(['cliente', 'itens'])
            ->orderByDesc('data_venda')
            ->paginate(10);

        return view('vendas.index', compact('vendas'));
    }


    /**
     * Formulário de criação
     */
    public function create()
    {
        return view('vendas.create', [
            'clientes' => Cliente::all(),
            'produtos' => Produto::all(),
        ]);
    }

    /**
     * Salvar venda
     */
    public function store(VendaRequest $request)
    {
        DB::transaction(function () use ($request) {

            $venda = Venda::create([
                'cliente_id'      => $request->cliente_id,
                'data_venda'      => $request->data_venda,
                'forma_pagamento' => $request->forma_pagamento,
                'desconto'        => $request->desconto ?? 0,
                'acrescimo'       => $request->acrescimo ?? 0,
                'status'          => 'aberta',
                'valor_total'     => 0,
                'observacoes'     => $request->observacoes,
            ]);

            $valorTotal = 0;

            foreach ($request->itens as $item) {
                $subtotal = $item['quantidade'] * $item['valor_unitario'];

                $venda->itens()->create([
                    'produto_id'     => $item['produto_id'],
                    'quantidade'     => $item['quantidade'],
                    'valor_unitario' => $item['valor_unitario'],
                    'subtotal'       => $subtotal,
                ]);

                $valorTotal += $subtotal;
            }

            $valorTotal = $valorTotal - $venda->desconto + $venda->acrescimo;

            $venda->update([
                'valor_total' => $valorTotal
            ]);
        });

        return redirect()
            ->route('vendas.index')
            ->with('success', 'Venda criada com sucesso!');
    }

    /**
     * Visualizar venda
     */
    public function show($id)
    {
        $venda = Venda::with(['cliente', 'itens.produto'])
            ->findOrFail($id);

        return view('vendas.show', compact('venda'));
    }

    /**
     * Formulário de edição
     */
    public function edit($id)
    {
        $venda = Venda::with('itens.produto')->findOrFail($id);

        return view('vendas.edit', [
            'venda'    => $venda,
            'clientes' => Cliente::all(),
            'produtos' => Produto::all(),
        ]);
    }

    /**
     * Atualizar venda
     */
    public function update(VendaRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {

            $venda = Venda::with('itens')->findOrFail($id);

            $venda->update([
                'cliente_id'      => $request->cliente_id,
                'forma_pagamento' => $request->forma_pagamento,
                'desconto'        => $request->desconto ?? 0,
                'acrescimo'       => $request->acrescimo ?? 0,
                'observacoes'     => $request->observacoes,
            ]);

            $venda->itens()->delete();

            $valorTotal = 0;

            foreach ($request->itens as $item) {
                $subtotal = $item['quantidade'] * $item['valor_unitario'];

                $venda->itens()->create([
                    'produto_id'     => $item['produto_id'],
                    'quantidade'     => $item['quantidade'],
                    'valor_unitario' => $item['valor_unitario'],
                    'subtotal'       => $subtotal,
                ]);

                $valorTotal += $subtotal;
            }

            $valorTotal = $valorTotal - $venda->desconto + $venda->acrescimo;

            $venda->update([
                'valor_total' => $valorTotal
            ]);
        });

        return redirect()
            ->route('vendas.index')
            ->with('success', 'Venda atualizada com sucesso!');
    }

    /**
     * Excluir venda
     */
    public function destroy($id)
    {
        Venda::findOrFail($id)->delete();

        return redirect()
            ->route('vendas.index')
            ->with('success', 'Venda excluída com sucesso!');
    }
}
