<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Loja</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding-top: 0;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .sidebar .logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar .logo h4 {
            margin: 0;
            font-weight: 700;
            color: #ecf0f1;
        }

        .sidebar a {
            display: block;
            padding: 15px 25px;
            color: #bdc3c7;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: #3498db;
            transform: translateX(5px);
        }

        .sidebar i {
            margin-right: 12px;
            width: 20px;
        }

        .content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }

        .navbar {
            margin-left: 260px;
            position: fixed;
            top: 0;
            width: calc(100% - 260px);
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar .navbar-brand {
            font-weight: 700;
            color: #2c3e50 !important;
            font-size: 1.5rem;
        }

        .content {
            margin-top: 90px;
        }

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            border: none;
            font-weight: 600;
        }

        .badge {
            border-radius: 20px;
            font-weight: 500;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .modal-content {
            border-radius: 15px;
            border: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
                margin-top: 0;
            }
            .navbar {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">
            <h4><i class="bi bi-shop"></i> Loja</h4>
        </div>

        <a href="{{ route('vendas.index') }}">
            <i class="bi bi-graph-up"></i> Dashboard
        </a>

        <a href="{{ route('vendas.create') }}">
            <i class="bi bi-plus-circle"></i> Nova Venda
        </a>

        <a href="{{ route('vendas.index') }}">
            <i class="bi bi-receipt"></i> Histórico de Vendas
        </a>

        <a href="{{ route('produtos.index') }}">
            <i class="bi bi-box-seam"></i> Produtos
        </a>

        <a href="{{ route('produtos.create') }}">
            <i class="bi bi-plus-circle"></i> Cadastrar Produto
        </a>

        <a href="{{ route('clientes.index') }}">
            <i class="bi bi-people"></i> Clientes
        </a>

        <a href="{{ route('clientes.create') }}">
            <i class="bi bi-person-plus"></i> Cadastrar Cliente
        </a>

        <a href="#">
            <i class="bi bi-cash-coin"></i> Financeiro
        </a>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light px-4">
        <span class="navbar-brand">
            <i class="bi bi-house-door"></i> Sistema de Loja
        </span>
    </nav>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                <strong>Erros encontrados:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
