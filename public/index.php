<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout com Bootstrap</title>
    <!-- Link do CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="/">Logo</a>
            <!-- Botão de menu para dispositivos móveis -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menus centralizados -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/categoria">Categoria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/equipe">Equipe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/usuario">Usuário</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/projeto">Projeto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/foto">Foto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vinculo">Vinculo</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="container my-5">
        <div class="content">
          <?php
            require '../Application/autoload.php';
            use Application\core\App;
            use Application\core\Controller;
            $app = new App();
          ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3">
        <div class="container">
            <span>&copy; 2024 numerar.com.br</span>
        </div>
    </footer>

    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>