@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Editar Venda #{{ $venda->id }}</h4>
        </div>
        <div class="card-body">

            <form action="{{ route('vendas.update', $venda) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- DADOS DA VENDA --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select name="cliente_id" class="form-select" required>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" @selected($cliente->id == $venda->cliente_id)>
                                        {{ $cliente->nome }}
                                    </option>
                                @endforeach
                            </select>
                            <label><i class="bi bi-person me-1"></i>Cliente</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="date"
                                   name="data_venda"
                                   class="form-control"
                                   value="{{ old('data_venda', $venda->data_venda?->format('Y-m-d')) }}"
                                   required>
                            <label><i class="bi bi-calendar me-1"></i>Data da Venda</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <select name="forma_pagamento" class="form-select" required>
                                <option value="pix" @selected($venda->forma_pagamento == 'pix')>Pix</option>
                                <option value="dinheiro" @selected($venda->forma_pagamento == 'dinheiro')>Dinheiro</option>
                                <option value="cartao" @selected($venda->forma_pagamento == 'cartao')>Cartão</option>
                            </select>
                            <label><i class="bi bi-credit-card me-1"></i>Forma de Pagamento</label>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-floating">
                            <input type="number"
                                   step="0.01"
                                   name="desconto"
                                   class="form-control"
                                   value="{{ old('desconto', $venda->desconto ?? 0) }}">
                            <label><i class="bi bi-dash-circle me-1"></i>Desconto</label>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-floating">
                            <input type="number"
                                   step="0.01"
                                   name="acrescimo"
                                   class="form-control"
                                   value="{{ old('acrescimo', $venda->acrescimo ?? 0) }}">
                            <label><i class="bi bi-plus-circle me-1"></i>Acréscimo</label>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-floating">
                            <select name="status" class="form-select" required>
                                <option value="aberta" @selected($venda->status == 'aberta')>Aberta</option>
                                <option value="paga" @selected($venda->status == 'paga')>Paga</option>
                                <option value="cancelada" @selected($venda->status == 'cancelada')>Cancelada</option>
                            </select>
                            <label><i class="bi bi-flag me-1"></i>Status</label>
                        </div>
                    </div>
                </div>

                {{-- ITENS DA VENDA --}}
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-cart me-2"></i>Itens da Venda</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($venda->itens as $index => $item)
                            <div class="row g-3 mb-3 item-row border rounded p-3 bg-light">
                                <input type="hidden" name="itens[{{ $index }}][produto_id]" value="{{ $item->produto_id }}">

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" value="{{ $item->produto->nome }}" readonly>
                                        <label>Produto</label>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-floating">
                                        <input type="number" name="itens[{{ $index }}][quantidade]" class="form-control"
                                            value="{{ old('itens.' . $index . '.quantidade', $item->quantidade) }}" min="1" required>
                                        <label>Quantidade</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="number" step="0.01" name="itens[{{ $index }}][valor_unitario]"
                                            class="form-control" value="{{ old('itens.' . $index . '.valor_unitario', $item->valor_unitario) }}" min="0" required>
                                        <label>Valor Unitário</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <button type="button" class="btn btn-outline-danger w-100" onclick="removerItem(this)">
                                        <i class="bi bi-trash me-1"></i>Remover
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- OBSERVAÇÕES --}}
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-floating">
                            <textarea name="observacoes"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Observações">{{ old('observacoes', $venda->observacoes) }}</textarea>
                            <label><i class="bi bi-sticky me-1"></i>Observações</label>
                        </div>
                    </div>
                </div>

                {{-- AÇÕES --}}
                <div class="text-end">
                    <a href="{{ route('vendas.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left me-1"></i>Voltar
                    </a>
                    <button class="btn btn-warning text-dark">
                        <i class="bi bi-check-circle me-1"></i>Atualizar Venda
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function removerItem(button) {
            if (confirm('Deseja remover este item?')) {
                button.closest('.item-row').remove();
            }
        }
    </script>
@endsection
