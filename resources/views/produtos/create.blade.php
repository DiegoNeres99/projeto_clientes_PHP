@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top">
                    <h3 class="m-2">Novo Produto</h3>
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

                    <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control"
                                value="{{ old('nome') }}" placeholder="Ex: Pijama Azul Conforto">
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea id="descricao" name="descricao" class="form-control" rows="3"
                                placeholder="Detalhes do produto...">{{ old('descricao') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="preco" class="form-label">Preço</label>
                            <input type="number" step="0.01" id="preco" name="preco"
                                class="form-control" value="{{ old('preco') }}" placeholder="0.00">
                        </div>

                        <div class="mb-3">
                            <label for="estoque" class="form-label">Estoque</label>
                            <input type="number" id="estoque" name="estoque" class="form-control"
                                value="{{ old('estoque') }}">
                        </div>

                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select id="categoria" name="categoria" class="form-control">
                                <option value="">Selecione...</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                                <option value="infantil">Infantil</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <input type="text" id="tipo" name="tipo" class="form-control"
                                value="{{ old('tipo') }}" placeholder="Ex: Curto, longo...">
                        </div>

                        <div class="mb-3">
                            <label for="material" class="form-label">Material</label>
                            <input type="text" id="material" name="material" class="form-control"
                                value="{{ old('material') }}" placeholder="Ex: Algodão, cetim...">
                        </div>                        

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('produtos.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-4">Salvar</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
