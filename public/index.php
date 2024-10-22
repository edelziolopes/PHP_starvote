<?php
ob_start();
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
    <title>Starvote</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@1.8.0"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
    <link href="/assets/css/styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/"><img class="navbar-logo" src="/assets/img/logo.png" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- Alinhar itens à direita -->
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <?php
                    if (isset($_COOKIE['usuario_equipe_id'])) { 
                        $equipe_id = $_COOKIE['usuario_equipe_id'];
                        if ($equipe_id == 1): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="admDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cogs"></i> Adm
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="admDropdown">
                            <li><a class="dropdown-item" href="/categoria"><i class="fas fa-tags"></i> Categorias</a></li>
                            <li><a class="dropdown-item" href="/equipe"><i class="fas fa-users"></i> Equipes</a></li>
                            <li><a class="dropdown-item" href="/usuario"><i class="fas fa-user"></i> Usuários</a></li>
                            <li><a class="dropdown-item" href="/retrato"><i class="fas fa-image"></i> Retratos</a></li>
                            <li><a class="dropdown-item" href="/projeto"><i class="fas fa-folder"></i> Projetos</a></li>
                            <li><a class="dropdown-item" href="/foto"><i class="fas fa-image"></i> Fotos</a></li>
                            <li><a class="dropdown-item" href="/vinculo"><i class="fas fa-link"></i> Vínculos</a></li>
                            <li><a class="dropdown-item" href="/voto"><i class="fas fa-star"></i> Votos</a></li>
                            
                            <!-- Submenu para Gráfico -->
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="/grafico" id="graficoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-chart-bar"></i> Gráfico
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="graficoDropdown">
                                    <li><a class="dropdown-item" href="/grafico"><i class="fas fa-chart-line"></i> Gráfico</a></li>
                                    <li><a class="dropdown-item" href="/grafico/data"><i class="fas fa-database"></i> Dados</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="margin-top:-6px;" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- Exibe a foto do usuário e o nome -->
                            <?php if(!empty($_COOKIE['usuario_retrato'])): ?>
                                <img src="/retratos/<?= htmlspecialchars($_COOKIE['usuario_retrato']) ?>" alt="Foto do usuário" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; margin-right: 8px;">
                            <?php endif; ?>
                            <span><?= htmlspecialchars($_COOKIE['usuario_nome']) ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="/usuario/profile"><i class="fas fa-user"></i> Perfil</a></li>
                            <li><a class="dropdown-item" href="/usuario/logout"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/grafico"><i class="fas fa-chart-line"></i> Resultados</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- Exibe a foto do usuário e o nome -->
                                <?php if(!empty($_COOKIE['usuario_retrato'])): ?>
                                    <img src="/retratos/<?= htmlspecialchars($_COOKIE['usuario_retrato']) ?>" alt="Foto do usuário" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; margin-right: 8px;">
                                <?php endif; ?>
                                <span><?= htmlspecialchars($_COOKIE['usuario_nome']) ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="/usuario/profile"><i class="fas fa-user"></i> Perfil</a></li>
                                <li><a class="dropdown-item" href="/usuario/logout"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                            </ul>
                        </li>
                    <?php endif; } ?>
                    <?php if (!isset($_COOKIE['usuario_id'])): ?>
                        <li class="nav-item"><a class="nav-link" href="/usuario/login"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="/usuario/register"><i class="fas fa-user-plus"></i> Cadastre-se</a></li>
                        <li class="nav-item"><a class="nav-link" href="/grafico/"><i class="fas fa-chart-line"></i> Gráfico</a></li>
                        
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-3">
        <div class="content">
            <?php $app = new App(); ?>
        </div>
    </div>
    <footer class="text-center py-3">
        <div class="container">
            <span>&copy; 2024 starvote.com.br</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>
    <script src="assets/js/script.js    "></script>
</body>
</html>
<?php } ?>
