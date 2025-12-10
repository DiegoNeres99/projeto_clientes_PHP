<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 240px;
            background: #0d6efd;
            color: white;
            padding-top: 0;
            box-shadow: 3px 0 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            display: block;
            padding: 14px 20px;
            color: #e8e8e8;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .sidebar i {
            margin-right: 10px;
        }

        .content {
            margin-left: 240px;
            padding: 25px;
        }

        .navbar {
            margin-left: 240px;
            position: fixed;
            top: 0;
            width: calc(100% - 240px);
            z-index: 1000;
        }

        .content {
            margin-top: 80px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
        <span class="navbar-brand fw-bold">
            Sistema de Clientes
        </span>
    </nav>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <a href="#"><i class="bi bi-cart3"></i> Vendas</a>

        <!-- PRODUTOS (INDEX) -->
        <a href="{{ route('produtos.index') }}">
            <i class="bi bi-box-seam"></i> Produtos
        </a>

        <!-- CADASTRAR PRODUTO -->
        <a href="{{ route('produtos.create') }}">
            <i class="bi bi-plus-circle"></i> Cadastro de Produtos
        </a>

        <a href="#"><i class="bi bi-archive"></i> Estoque</a>
        <a href="#"><i class="bi bi-cash-coin"></i> Financeiro</a>

        <!-- CLIENTES -->
        <a href="{{ route('clientes.index') }}">
            <i class="bi bi-people"></i> Clientes
        </a>

    </div>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
