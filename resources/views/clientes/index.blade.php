<h1>Lista de Clientes</h1>

<a href="{{ route('clientes.create') }}">Novo Cliente</a>

@if (session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif

<table borde="1" cellpadding="10">
    <tr>
        <th>Nome</th>
        <th>Endereço</th>
        <th>CPF</th>
        <th>Telefone</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>

    @foreach ($clientes as $cliente)
    <tr>
        <td>{{ $cliente->nome }}</td>
        <td>{{ $cliente->endereco }}</td>
        <td>{{ $cliente->cpf }}</td>
        <td>{{ $cliente->telefone }}</td>
        <td>{{ $cliente->email }}</td>
        <td>
            <a href="{{ route('clientes.edit', $cliente->id) }}">Editar</a>
            <form action="{{ route('clientes.destroy', $cliente->id) }}"
                method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>