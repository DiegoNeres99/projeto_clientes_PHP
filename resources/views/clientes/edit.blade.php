<h1>Editar Cliente</h1>

@if ($errors->any())
<ul style="color: red;">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif

<form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" value="{{ old('nome', $cliente->nome) }}"><br><br>

    <label for="endereco">Endereço:</label><br>
    <input type="text" id="endereco" name="endereco" value="{{ old('endereco', $cliente->endereco) }}"><br><br>

    <label for="cpf">CPF:</label><br>
    <input type="text" id="cpf" name="cpf" value="{{ old('cpf', $cliente->cpf) }}"><br><br>

    <label for="telefone">Telefone:</label><br>
    <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $cliente->telefone) }}"><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="{{ old('email', $cliente->email) }}"><br><br>

    <button type="submit">Atualizar</button>
</form>