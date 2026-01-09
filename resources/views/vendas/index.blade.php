@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Vendas</h2>

            <div class="d-flex gap-2">
                <button id="btnTable" class="btn btn-outline-primary btn-sm">
                    📋 Modo Tabela
                </button>

                <button id="btnCards" class="btn btn-primary btn-sm">
                    🗂️ Modo Cards
                </button>

                <a href="{{ route('vendas.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Nova Venda
                </a>
            </div>
        </div>

        {{-- Mensagem de sucesso --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        <!-- ================= MODO TABELA ================= -->
        <div id="tableView">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-0">

                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th>Itens</th>
                                <th>Produtos</th>
                                <th>Desconto</th>
                                <th>Acréscimo</th>
                                <th>Total</th>
                                <th class="text-center" width="160">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($vendas as $venda)
                                @php
                                    $statusClass = match ($venda->status) {
                                        'aberta' => 'secondary',
                                        'paga' => 'success',
                                        'cancelada' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp

                                <tr>
                                    <td>{{ $venda->id }}</td>
                                    <td>{{ $venda->cliente->nome ?? 'Cliente removido' }}</td>
                                    <td>{{ optional($venda->data_venda)->format('d/m/Y') }}</td>

                                    <td>
                                        <span class="badge bg-{{ $statusClass }}">
                                            {{ ucfirst($venda->status) }}
                                        </span>
                                    </td>

                                    <td>{{ $venda->itens->count() }}</td>

                                    <td>{{ $venda->itens->sum('quantidade') }}</td>

                                    <td class="text-danger">
                                        - R$ {{ number_format($venda->desconto ?? 0, 2, ',', '.') }}
                                    </td>

                                    <td class="text-success">
                                        + R$ {{ number_format($venda->acrescimo ?? 0, 2, ',', '.') }}
                                    </td>

                                    <td class="fw-bold">
                                        R$ {{ number_format($venda->valor_total, 2, ',', '.') }}
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Deseja excluir esta venda?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4 text-muted">
                                        Nenhuma venda cadastrada
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


        <!-- ================= MODO CARDS ================= -->
        <div id="cardsView" class="row g-4 d-none">

            @foreach ($vendas as $venda)
                @php
                    $statusClass = match ($venda->status) {
                        'aberta' => 'secondary',
                        'paga' => 'success',
                        'cancelada' => 'danger',
                        default => 'secondary',
                    };
                @endphp

                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 h-100 card-hover">

                        <div class="card-body">

                            <h5 class="fw-bold">
                                {{ $venda->cliente->nome ?? 'Cliente removido' }}
                            </h5>

                            <p class="text-muted small mb-2">
                                Venda #{{ $venda->id }} •
                                {{ optional($venda->data_venda)->format('d/m/Y') }}
                            </p>

                            <div class="mb-2">
                                <strong>Status:</strong>
                                <span class="badge bg-{{ $statusClass }}">
                                    {{ ucfirst($venda->status) }}
                                </span>
                            </div>

                            <div class="mb-2">
                                <strong>Itens diferentes:</strong>
                                {{ $venda->itens->count() }}
                            </div>

                            <div class="mb-2">
                                <strong>Total de produtos:</strong>
                                {{ $venda->itens->sum('quantidade') }}
                            </div>

                            <div class="mb-2 text-danger">
                                <strong>Desconto:</strong>
                                - R$ {{ number_format($venda->desconto ?? 0, 2, ',', '.') }}
                            </div>

                            <div class="mb-2 text-success">
                                <strong>Acréscimo:</strong>
                                + R$ {{ number_format($venda->acrescimo ?? 0, 2, ',', '.') }}
                            </div>

                            <hr>

                            <div class="mb-2 fw-bold fs-5">
                                Total:
                                R$ {{ number_format($venda->valor_total, 2, ',', '.') }}
                            </div>

                        </div>

                        <div class="card-footer bg-white border-0 d-flex gap-2">
                            <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-warning w-50">
                                ✏️ Editar
                            </a>

                            <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" class="w-50">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger w-100" onclick="return confirm('Deseja excluir esta venda?')">
                                    🗑️ Excluir
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>

        {{-- Paginação --}}
        <div class="mt-3">
            {{ $vendas->links() }}
        </div>

    </div>


    {{-- JS troca tabela/cards --}}
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
