<?php
require '../Application/autoload.php';
use Application\core\App;
use Application\core\Controller;
$request_uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
if (strpos($request_uri, '/grafico/data') !== false) {
    $app = new App();
    exit;
} else {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@1.8.0"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout com Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <?php
                if (isset($_COOKIE['usuario_equipe_id'])) { $equipe_id = $_COOKIE['usuario_equipe_id'];
                if ($equipe_id == 1):?>
                    <li class="nav-item"><a class="nav-link" href="/categoria">Categorias</a></li>
                    <li class="nav-item"><a class="nav-link" href="/equipe">Equipes</a></li>
                    <li class="nav-item"><a class="nav-link" href="/usuario">Usuários</a></li>
                    <li class="nav-item"><a class="nav-link" href="/projeto">Projetos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/foto">Fotos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/vinculo">Vinculos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/voto">Votos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/grafico">Gráfico</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/vinculo">Resultados</a></li>
                <?php endif; } ?>
                <?php if (!isset($_COOKIE['usuario_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="/usuario/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/usuario/register">Cadastre-se</a></li>
                <?php endif; ?>
            </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="content">
            <?php
            $app = new App();
            ?>
        </div>
    </div>

    <footer class="text-center py-3">
        <div class="container">
            <span>&copy; 2024 starvote.com.br</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
<?php } ?>
