<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Http\Request\ProdutoRequest;

class ProdutoController extends Controller
{

    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }


    public function create()
    {
        return view('produtos.create');
    }


    public function store(ProdutoRequest $request)
    {
        Produto::create($request->all());

        return redirect()->route('produtos.index')
            ->with('success', 'Produto criado com sucesso.');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $produto = Produto::findORFail($id);
        return view('produtos.edit', compact('produto'));
    }


    public function update(ProdutoRequest $request, string $id)
    {
        $produto = Produto::findOrFail($id);

        $produto->update($request->all());

        return redirect()->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso.');
    }


    public function destroy(string $id)
    {
        Produto::destroy($id);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto deletado com sucesso.');
    }
}
