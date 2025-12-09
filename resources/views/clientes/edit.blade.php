@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-warning text-dark text-center rounded-top">
                    <h3 class="m-2">Editar Cliente</h3>
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

                    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control"
                                value="{{ old('nome', $cliente->nome) }}" placeholder="Digite o nome completo">
                        </div>

                        <div class="mb-3">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" id="endereco" name="endereco" class="form-control"
                                value="{{ old('endereco', $cliente->endereco) }}" placeholder="Rua, número, bairro...">
                        </div>

                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" id="cpf" name="cpf" class="form-control"
                                value="{{ old('cpf', $cliente->cpf) }}" placeholder="000.000.000-00">
                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" id="telefone" name="telefone" class="form-control"
                                value="{{ old('telefone', $cliente->telefone) }}" placeholder="(00) 00000-0000">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email', $cliente->email) }}" placeholder="exemplo@dominio.com">
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                            <button type="submit" class="btn btn-warning px-4 text-dark fw-bold">
                                Atualizar
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
