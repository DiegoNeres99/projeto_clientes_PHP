@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">

            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0"><i class="bi bi-person-plus me-2"></i>Novo Cliente</h3>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('clientes.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" id="nome" name="nome" class="form-control"
                                        value="{{ old('nome') }}" placeholder="Nome completo" required>
                                    <label for="nome"><i class="bi bi-person me-1"></i>Nome Completo</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" id="endereco" name="endereco" class="form-control"
                                        value="{{ old('endereco') }}" placeholder="Endereço" required>
                                    <label for="endereco"><i class="bi bi-geo-alt me-1"></i>Endereço</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="cpf" name="cpf" class="form-control"
                                        value="{{ old('cpf') }}" placeholder="CPF" required>
                                    <label for="cpf"><i class="bi bi-credit-card me-1"></i>CPF</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="telefone" name="telefone" class="form-control"
                                        value="{{ old('telefone') }}" placeholder="Telefone" required>
                                    <label for="telefone"><i class="bi bi-telephone me-1"></i>Telefone</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ old('email') }}" placeholder="E-mail" required>
                                    <label for="email"><i class="bi bi-envelope me-1"></i>E-mail</label>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i>Salvar Cliente
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
