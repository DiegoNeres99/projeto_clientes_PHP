<h1>Novo Cliente</h1>

@if ($errors->any())
<ul style="color: red;">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="{{ old('nome') }}"><br><br>

        <label for="endereco">Endereço:</label><br>
        <input type="text" id="endereco" name="endereco" value="{{ old('endereco') }}"><br><br>

        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}"><br><br>

        <label for="telefone">Telefone:</label><br>
        <input type="text" id="telefone" name="telefone" value="{{ old('telefone') }}"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="{{ old('email') }}"><br><br>

        <button type="submit">Salvar</button>
    </form>