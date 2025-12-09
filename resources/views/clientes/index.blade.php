@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Lista de Clientes</h2>

        <a href="{{ route('clientes.create') }}" class="btn btn-primary px-4">
            + Novo Cliente
        </a>
    </div>

    {{-- Mensagem de sucesso --}}
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-0">

            <table class="table table-hover table-striped mb-0 align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->name ?? $cliente->nome }}</td>
                        <td>{{ $cliente->endereco }}</td>
                        <td>{{ $cliente->cpf }}</td>
                        <td>{{ $cliente->telefone }}</td>
                        <td>{{ $cliente->email }}</td>

                        <td class="text-center">

                            <a href="{{ route('clientes.edit', $cliente->id) }}"
                                class="btn btn-sm btn-warning text-dark me-2">
                                ✏️ Editar
                            </a>

                            <form action="{{ route('clientes.destroy', $cliente->id) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
                                    🗑️ Excluir
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection