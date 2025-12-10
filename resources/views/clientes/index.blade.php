@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Lista de Clientes</h2>

        <div class="d-flex gap-2">
            <button id="btnTable" class="btn btn-outline-primary btn-sm">
                📋 Modo Tabela
            </button>

            <button id="btnCards" class="btn btn-primary btn-sm">
                🗂️ Modo Cards
            </button>

            <a href="{{ route('clientes.create') }}" class="btn btn-success px-4">
                + Novo Cliente
            </a>
        </div>
    </div>

    {{-- Mensagem de sucesso --}}
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <!-- ============== MODO TABELA ============== -->
    <div id="tableView">
        <div class="card shadow border-0 rounded-4">
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


    <!-- ============== MODO CARDS ============== -->
    <div id="cardsView" class="row g-4 d-none">

        @foreach ($clientes as $cliente)
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover">

                <div class="card-body">

                    <h5 class="fw-bold">{{ $cliente->name ?? $cliente->nome }}</h5>

                    <p class="text-muted small">
                        {{ $cliente->email }}
                    </p>

                    <div><strong>📍 Endereço:</strong> {{ $cliente->endereco }}</div>
                    <div><strong>🆔 CPF:</strong> {{ $cliente->cpf }}</div>
                    <div><strong>📞 Telefone:</strong> {{ $cliente->telefone }}</div>

                </div>

                <div class="card-footer bg-white border-0 d-flex gap-2">
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning w-50">
                        ✏️ Editar
                    </a>

                    <form action="{{ route('clientes.destroy', $cliente->id) }}"
                        method="POST" class="w-50">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger w-100"
                            onclick="return confirm('Deseja excluir?')">
                            🗑️ Excluir
                        </button>
                    </form>
                </div>

            </div>
        </div>
        @endforeach

    </div>

</div>


{{-- JS PARA TROCAR ENTRE TABELA E CARDS --}}
<script>
    document.getElementById('btnTable').addEventListener('click', () => {
        document.getElementById('tableView').classList.remove('d-none');
        document.getElementById('cardsView').classList.add('d-none');
    });

    document.getElementById('btnCards').addEventListener('click', () => {
        document.getElementById('cardsView').classList.remove('d-none');
        document.getElementById('tableView').classList.add('d-none');
    });
</script>

{{-- Estilo hover dos cards --}}
<style>
    .card-hover {
        transition: 0.2s ease-in-out;
    }

    .card-hover:hover {
        transform: translateY(-6px);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    }
</style>

@endsection