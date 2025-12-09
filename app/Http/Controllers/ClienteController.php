<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Http\Requests\ClienteRequest;

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

    public function store(ClienteRequest $request)
    {
        Cliente::create($request->validated());

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


    public function update(ClienteRequest $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->update($request->validated());

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
