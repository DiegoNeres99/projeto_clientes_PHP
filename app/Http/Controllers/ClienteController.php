<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Http\Request\ClienteRequest;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    //Criar um novo cliente
    public function create()
    {
        return view('clientes.create');
    }
    //Salvar um novo cliente
    public function store(ClienteRequest $request)
    {
        Cliente::create($request->validated());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente criado com sucesso.');
    }

    //Exibir um cliente específico
    public function show(string $id)
    {
        //
    }

    //Editar um cliente específico
    public function edit(string $id)
    {
        $cliente = Cliente::findORFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    //Atualizar um cliente específico
    public function update(ClienteRequest $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->update($request->validated());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente atualizado com sucesso.');
    }


    //Deletar um cliente específico
    public function destroy(string $id)
    {
        Cliente::destroy($id);
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente deletado com sucesso.');
    }
}
