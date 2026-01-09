@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Nova Venda</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('vendas.store') }}" method="POST">
                    @csrf

                    {{-- DADOS DA VENDA --}}
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="cliente_id" class="form-select" required>
                                    <option value="">Selecione o cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}"
                                            {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                <label><i class="bi bi-person me-1"></i>Cliente</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="date" name="data_venda" class="form-control"
                                    value="{{ old('data_venda', now()->toDateString()) }}" required>
                                <label><i class="bi bi-calendar me-1"></i>Data da Venda</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating">
                                <select name="forma_pagamento" class="form-select" required>
                                    <option value="pix" {{ old('forma_pagamento') == 'pix' ? 'selected' : '' }}>Pix
                                    </option>
                                    <option value="dinheiro" {{ old('forma_pagamento') == 'dinheiro' ? 'selected' : '' }}>
                                        Dinheiro</option>
                                    <option value="cartao" {{ old('forma_pagamento') == 'cartao' ? 'selected' : '' }}>Cartão
                                    </option>
                                </select>
                                <label><i class="bi bi-credit-card me-1"></i>Forma de Pagamento</label>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-floating">
                                <input type="number" step="0.01" name="desconto" class="form-control"
                                    value="{{ old('desconto', 0) }}" placeholder="0.00">
                                <label><i class="bi bi-dash-circle me-1"></i>Desconto</label>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-floating">
                                <input type="number" step="0.01" name="acrescimo" class="form-control"
                                    value="{{ old('acrescimo', 0) }}" placeholder="0.00">
                                <label><i class="bi bi-plus-circle me-1"></i>Acréscimo</label>
                            </div>
                        </div>

                        <div class="col-md-">
                            <div class="form-floating">Status</div>
                            <select name="status" class="form-select" required>
                                <option value="aberta" selected>Aberta</option>
                                <option value="paga">Paga</option>
                                <option value="cancelada">Cancelada</option>
                            </select>
                        </div>

                    </div>

                    {{-- ITENS DA VENDA --}}
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-cart me-2"></i>Itens da Venda</h5>
                        </div>
                        <div class="card-body">

                            <div id="itens-container"></div>

                            <button type="button" class="btn btn-outline-primary mb-3" onclick="adicionarItem()">
                                <i class="bi bi-plus-circle me-1"></i>Adicionar Produto
                            </button>

                            <template id="item-template">
                                <div class="row align-items-end mb-3 item-row border rounded p-3 bg-light">
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <select name="itens[INDEX][produto_id]" class="form-select produto-select"
                                                required>
                                                <option value="">Selecione um produto</option>
                                                @foreach ($produtos as $produto)
                                                    <option value="{{ $produto->id }}"
                                                        data-preco="{{ $produto->preco }}">
                                                        {{ $produto->nome }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label>Produto</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="number" name="itens[INDEX][quantidade]" class="form-control"
                                                min="1" value="1" required>
                                            <label>Quantidade</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="number" step="0.01" name="itens[INDEX][valor_unitario]"
                                                class="form-control" min="0" required>
                                            <label>Valor Unitário</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-outline-danger w-100"
                                            onclick="removerItem(this)">
                                            <i class="bi bi-trash me-1"></i>Remover
                                        </button>
                                    </div>
                                </div>
                            </template>

                        </div>
                    </div>

                    {{-- OBSERVAÇÕES --}}
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="form-floating">
                                <textarea name="observacoes" class="form-control" rows="3" placeholder="Observações">{{ old('observacoes') }}</textarea>
                                <label><i class="bi bi-sticky me-1"></i>Observações</label>
                            </div>
                        </div>
                    </div>

                    {{-- AÇÕES --}}
                    <div class="text-end">
                        <a href="{{ route('vendas.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left me-1"></i>Voltar
                        </a>
                        <button class="btn btn-success">
                            <i class="bi bi-check-circle me-1"></i>Salvar Venda
                        </button>
                    </div>
                </form>

            </div>
        </div>

        {{-- JS --}}
        <script>
            let itemIndex = 0;

            function adicionarItem() {
                const template = document.getElementById('item-template');
                const container = document.getElementById('itens-container');

                const clone = template.content.cloneNode(true);
                const html = clone.firstElementChild.outerHTML.replace(/INDEX/g, itemIndex);

                container.insertAdjacentHTML('beforeend', html);

                const row = container.lastElementChild;
                const select = row.querySelector('.produto-select');
                const valorInput = row.querySelector('input[name*="valor_unitario"]');

                select.addEventListener('change', function() {
                    const option = this.options[this.selectedIndex];
                    const preco = option.getAttribute('data-preco');

                    if (preco) {
                        valorInput.value = preco;
                    }
                });

                itemIndex++;
            }

            function removerItem(button) {
                button.closest('.item-row').remove();
            }

            document.addEventListener('DOMContentLoaded', function() {
                adicionarItem();
            });

        </script>
    @endsection
