@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-warning text-dark text-center rounded-top">
                    <h3 class="m-2">Editar Produto</h3>
                </div>

                <div class="card-body p-4">

                    {{-- Exibe erros --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h5 class="alert-heading">Erros encontrados:</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control"
                                value="{{ old('nome', $produto->nome) }}">
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea id="descricao" name="descricao" class="form-control" rows="3">{{ old('descricao', $produto->descricao) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="preco" class="form-label">Preço</label>
                            <input type="number" step="0.01" id="preco" name="preco" class="form-control"
                                value="{{ old('preco', $produto->preco) }}">
                        </div>

                        <div class="mb-3">
                            <label for="estoque" class="form-label">Estoque</label>
                            <input type="number" id="estoque" name="estoque" class="form-control"
                                value="{{ old('estoque', $produto->estoque) }}">
                        </div>

                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select id="categoria" name="categoria" class="form-control">
                                <option value="masculino" {{ $produto->categoria == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="feminino" {{ $produto->categoria == 'feminino' ? 'selected' : '' }}>Feminino</option>
                                <option value="infantil" {{ $produto->categoria == 'infantil' ? 'selected' : '' }}>Infantil</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <input type="text" id="tipo" name="tipo" class="form-control"
                                value="{{ old('tipo', $produto->tipo) }}">
                        </div>

                        <div class="mb-3">
                            <label for="material" class="form-label">Material</label>
                            <input type="text" id="material" name="material" class="form-control"
                                value="{{ old('material', $produto->material) }}">
                        </div>                     
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="ativo" {{ $produto->status == 'ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="inativo" {{ $produto->status == 'inativo' ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('produtos.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                            <button type="submit" class="btn btn-warning px-4 text-dark fw-bold">Atualizar</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
