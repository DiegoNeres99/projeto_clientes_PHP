<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }


    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'endereco' => 'required',
            'cpf' => 'required|unique:clientes',
            'telefone' => 'required',
            'email' => 'required|email|unique:clientes',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente criado com sucesso.');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $cliente = Cliente::findORFail($id);
        return view('clientes.edit', compact('cliente'));
    }


    public function update(Request $request, string $id)
{
    $cliente = Cliente::findOrFail($id);

    $request->validate([
        'nome' => 'required',
        'endereco' => 'required',
        'cpf' => 'required|unique:clientes,cpf,' . $cliente->id,
        'telefone' => 'required',
        'email' => 'required|email|unique:clientes,email,' . $cliente->id,
    ]);

    $cliente->update($request->all());

    return redirect()->route('clientes.index')
        ->with('success', 'Cliente atualizado com sucesso.');
}



    public function destroy(string $id)
    {
        Cliente::destroy($id);
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente deletado com sucesso.');
    }
}
