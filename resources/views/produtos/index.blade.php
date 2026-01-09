@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Lista de Produtos</h2>

            <div class="d-flex gap-2">
                <button id="btnTable" class="btn btn-outline-primary btn-sm">
                    📋 Modo Tabela
                </button>

                <button id="btnCards" class="btn btn-primary btn-sm">
                    🗂️ Modo Cards
                </button>

                <a href="{{ route('produtos.create') }}" class="btn btn-success px-4">
                    + Novo Produto
                </a>
            </div>
        </div>

        {{-- Sucesso --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        <!-- ============== MODO TABELA ============== -->
        <div id="tableView">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-0">

                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Estoque</th>
                                <th>Categoria</th>
                                <th>Material</th>
                                <th>Tipo</th>
                                <th>Status</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($produtos as $produto)
                                <tr>
                                    <td>{{ $produto->nome }}</td>

                                    <td>{{ Str::limit($produto->descricao, 40) }}</td>

                                    <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>

                                    <td>{{ $produto->estoque }}</td>

                                    <td>{{ $produto->categoria }}</td>

                                    <td>{{ $produto->material }}</td>

                                    <td>{{ $produto->tipo }}</td>

                                    <td>
                                        @if ($produto->status == 'ativo')
                                            <span class="badge bg-success">Ativo</span>
                                        @else
                                            <span class="badge bg-danger">Inativo</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('produtos.edit', $produto->id) }}"
                                            class="btn btn-sm btn-warning me-1">
                                            ✏️
                                        </a>

                                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Tem certeza?')">🗑️</button>
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

            @foreach ($produtos as $produto)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 h-100 card-hover">

                        <div class="card-body">

                            <h5 class="fw-bold">{{ $produto->nome }}</h5>

                            <p class="text-muted small">
                                {{ Str::limit($produto->descricao, 80) }}
                            </p>

                            <div class="mb-2"><strong>Preço:</strong>
                                R$ {{ number_format($produto->preco, 2, ',', '.') }}
                            </div>

                            <div><strong>Estoque:</strong> {{ $produto->estoque }}</div>

                            <div><strong>Categoria:</strong> {{ $produto->categoria }}</div>

                            <div><strong>Material:</strong> {{ $produto->material }}</div>

                            <div><strong>Tipo:</strong> {{ $produto->tipo }}</div>

                            <div class="mt-2">
                                @if ($produto->status == 'ativo')
                                    <span class="badge bg-success">Ativo</span>
                                @else
                                    <span class="badge bg-danger">Inativo</span>
                                @endif
                            </div>

                        </div>

                        <div class="card-footer bg-white border-0 d-flex gap-2">
                            <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning w-50">
                                ✏️ Editar
                            </a>

                            <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="w-50">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger w-100" onclick="return confirm('Deseja excluir?')">
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

    {{-- Estilo hover para os cards --}}
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
