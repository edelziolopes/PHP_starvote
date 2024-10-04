<div class="container">
    <div class="row">

    <!--
        <div class="my-4">
            <?php if (isset($_COOKIE['usuario_id'])): ?>
                <?php
                    // Obtém o nome do usuário logado
                    $Usuarios = $this->model('Usuarios');
                    $usuarioLogado = $Usuarios::findById($_COOKIE['usuario_id']);
                ?>
                <span>Bem-vindo, <?= htmlspecialchars($usuarioLogado['nome']); ?>!</span>
                <a href="/usuario/logout" class="btn btn-danger">Sair</a>
            <?php else: ?>
                <a href="/usuario/login" class="btn btn-primary">Login</a>
                <a href="/usuario/register" class="btn btn-secondary">Cadastre-se</a>
            <?php endif; ?>
        </div>
    -->

        <div class="mb-2 d-flex justify-content-center flex-wrap">
        <?php foreach($data['equipes'] as $equipe): ?>
                <?php if ($equipe['categoria'] == 'Alunos'): ?>
                    <a href="/home/index/<?= $equipe['id'] ?>" class="m-1 btn btn-outline-primary <?= isset($data['equipeSelecionada']) && $data['equipeSelecionada'] == $equipe['id'] ? 'active' : '' ?>">
                        <?= $equipe['equipe'] ?>
                    </a>
                <?php endif; ?> 
            <?php endforeach; ?>
        </div>

        <?php 
        $projetos = [];
        // Agrupar os projetos com base no ID
        foreach ($data['projetos'] as $projeto) {
            $projetos[$projeto['projeto_id']]['projeto_nome'] = $projeto['projeto_nome'];
            $projetos[$projeto['projeto_id']]['descricao'] = $projeto['descricao'];
            $projetos[$projeto['projeto_id']]['equipe_nome'] = $projeto['equipe_nome'];
            $projetos[$projeto['projeto_id']]['usuarios'][] = $projeto['usuario_nome'];
            // Garantir que haja fotos antes de adicionar
            if (!empty($projeto['foto'])) {
                $projetos[$projeto['projeto_id']]['fotos'][] = $projeto['foto'];
            }
        }

        // Iterar sobre os projetos agrupados
        foreach ($projetos as $projeto_id => $projeto) { 
        ?>
        <div class="col-md-4">
            <div class="card">
                <?php if (!empty($projeto['fotos'])) { ?>
                    <!-- Carrossel de fotos -->
                    <div id="carousel-<?= $projeto_id ?>" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($projeto['fotos'] as $index => $foto) { ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <img src="/fotos/<?= $foto ?>" class="d-block w-100" alt="Foto do projeto">
                                </div>
                            <?php } ?>
                        </div>
                        <!-- Controles do carrossel -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?= $projeto_id ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?= $projeto_id ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Próximo</span>
                        </button>
                    </div>
                <?php } ?>
                <div class="card-body">
                    <h5 class="card-title"><?= $projeto['projeto_nome'] ?></h5>
                    <p class="card-text"><?= $projeto['descricao'] ?></p>
                    <p><strong>Equipe:</strong> <?= $projeto['equipe_nome'] ?></p>
                    <p><strong>Integrantes:</strong></p>
                    <ul>
                        <?php foreach (array_unique($projeto['usuarios']) as $usuario) { ?>
                            <li><?= $usuario ?></li>
                        <?php } ?>
                    </ul>
                    <p><a style="width: 100%;" class="btn btn-primary" href="/home/show/<?= $projeto_id ?>">Votar</a></p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
    var carousels = document.querySelectorAll('.carousel');
    carousels.forEach(function(carousel) {
        var carouselInstance = new bootstrap.Carousel(carousel, {
            interval: 3000, // Tempo de rotação automático (3 segundos)
            ride: 'carousel'
        });
    });
</script>
