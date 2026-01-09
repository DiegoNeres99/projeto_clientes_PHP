@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">

            <div class="card">
                <div class="card-header bg-warning text-dark text-center">
                    <h3 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Editar Produto</h3>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <input type="text" id="nome" name="nome" class="form-control"
                                        value="{{ old('nome', $produto->nome) }}" placeholder="Nome do produto" required>
                                    <label for="nome"><i class="bi bi-tag me-1"></i>Nome do Produto</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select id="categoria" name="categoria" class="form-select" required>
                                        <option value="masculino" {{ old('categoria', $produto->categoria) == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="feminino" {{ old('categoria', $produto->categoria) == 'feminino' ? 'selected' : '' }}>Feminino</option>
                                        <option value="infantil" {{ old('categoria', $produto->categoria) == 'infantil' ? 'selected' : '' }}>Infantil</option>
                                    </select>
                                    <label for="categoria"><i class="bi bi-tags me-1"></i>Categoria</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea id="descricao" name="descricao" class="form-control" rows="3"
                                        placeholder="Descrição">{{ old('descricao', $produto->descricao) }}</textarea>
                                    <label for="descricao"><i class="bi bi-file-text me-1"></i>Descrição</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="number" step="0.01" id="preco" name="preco" class="form-control"
                                        value="{{ old('preco', $produto->preco) }}" placeholder="0.00" required>
                                    <label for="preco"><i class="bi bi-cash me-1"></i>Preço (R$)</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="number" id="estoque" name="estoque" class="form-control"
                                        value="{{ old('estoque', $produto->estoque) }}" placeholder="0" required>
                                    <label for="estoque"><i class="bi bi-boxes me-1"></i>Estoque</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="text" id="tipo" name="tipo" class="form-control"
                                        value="{{ old('tipo', $produto->tipo) }}" placeholder="Tipo">
                                    <label for="tipo"><i class="bi bi-diagram-3 me-1"></i>Tipo</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="text" id="material" name="material" class="form-control"
                                        value="{{ old('material', $produto->material) }}" placeholder="Material">
                                    <label for="material"><i class="bi bi-scissors me-1"></i>Material</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select id="status" name="status" class="form-select" required>
                                        <option value="ativo" {{ old('status', $produto->status) == 'ativo' ? 'selected' : '' }}>Ativo</option>
                                        <option value="inativo" {{ old('status', $produto->status) == 'inativo' ? 'selected' : '' }}>Inativo</option>
                                    </select>
                                    <label for="status"><i class="bi bi-toggle-on me-1"></i>Status</label>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('produtos.index') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning text-dark">
                                <i class="bi bi-check-circle me-1"></i>Atualizar Produto
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
