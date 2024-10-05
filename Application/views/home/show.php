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

<?php if (isset($data['projeto']) && !empty($data['projeto'])) { ?>
    <!-- Carrossel de fotos (se houver fotos) -->
    <?php 
    // Agrupar fotos únicas
    $fotos = [];
    foreach ($data['projeto'] as $item) {
        if (!empty($item['foto']) && !in_array($item['foto'], $fotos)) {
            $fotos[] = $item['foto'];
        }
    }

    if (!empty($fotos)) { ?>
        <div id="carousel-projeto" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($fotos as $index => $foto) { ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <img src="/fotos/<?= htmlspecialchars($foto) ?>" class="d-block w-100" alt="Foto do projeto">
                    </div>
                <?php } ?>
            </div>
            <!-- Controles do carrossel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-projeto" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel-projeto" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
        </div>
    <?php } ?>
    
    <!-- Informações do Projeto (fora do card) -->
    <div class="project-details mb-4">
        <h2><?= htmlspecialchars($data['projeto'][0]['projeto_nome']) ?></h2>
        <p><strong>Descrição:</strong> <?= htmlspecialchars($data['projeto'][0]['descricao']) ?></p>
        <p><strong>Equipe:</strong> <?= htmlspecialchars($data['projeto'][0]['equipe_nome']) ?></p>

        <!-- Lista de Integrantes -->
        <p><strong>Integrantes:</strong></p>
        <ul>
            <?php 
            // Agrupar os integrantes únicos
            $integrantes = [];
            foreach ($data['projeto'] as $item) {
                if (!in_array($item['usuario_nome'], $integrantes)) {
                    $integrantes[] = $item['usuario_nome'];
                }
            }
            // Exibir os integrantes
            foreach ($integrantes as $integrante) { ?>
                <li><?= htmlspecialchars($integrante) ?></li>
            <?php } ?>
        </ul>
    </div>

    <!-- Botão de votação -->
    <?php if (isset($_COOKIE['usuario_id'])): ?>
        <div class="vote-section mb-4 border rounded p-3">
            <?php $voto = isset($data['votoExistente']['voto']) ? (int)$data['votoExistente']['voto'] : 0; ?>
            <form id="voteForm" action="/voto/create/<?= htmlspecialchars($data['projeto'][0]['projeto_id']) ?>" method="POST">
                <div class="star-rating"> Votar: 
                    <!-- Ícones de estrelas -->
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="fa fa-star <?= ($i <= $voto) ? 'checked' : '' ?>" data-value="<?= $i ?>"></i>
                    <?php endfor; ?>
                </div>
                <!-- Input oculto para enviar o valor da estrela -->
                <input id="voto" name="voto" type="hidden" value="<?= isset($voto) ? htmlspecialchars($voto) : '' ?>" required>
                <input id="id_usuario" name="id_usuario" type="hidden" value="<?= $_COOKIE['usuario_id'] ?>">
                <input id="id_projeto" name="id_projeto" type="hidden" value="<?= htmlspecialchars($data['projeto'][0]['projeto_id']) ?>">
            </form>
            <!-- Alerta de sucesso -->
            <div id="voto-alert" class="alert alert-success d-none mt-3 mb-0" role="alert">
                Seu voto foi registrado com sucesso!
            </div>
            <script>
                // Verifique se o voto já existe no PHP
                const votoExistente = <?= isset($voto) && $voto > 0 ? 'true' : 'false'; ?>;
                if (votoExistente) {
                    // Exibe o alerta de sucesso somente se o voto existir
                    const alert = document.getElementById('voto-alert');
                    alert.classList.remove('d-none');
                    // Esconde o alerta após 5 segundos
                    setTimeout(() => {
                        alert.classList.add('d-none');
                    }, 5000);
                }
                // Script para gerenciar o clique nas estrelas
                document.querySelectorAll('.star-rating .fa-star').forEach(star => {
                    star.addEventListener('click', function() {
                        const value = this.getAttribute('data-value');
                        // Remove a classe "checked" de todas as estrelas
                        document.querySelectorAll('.star-rating .fa-star').forEach(s => s.classList.remove('checked'));
                        // Adiciona a classe "checked" às estrelas até o valor selecionado
                        for (let i = 0; i < value; i++) {
                            document.querySelectorAll('.star-rating .fa-star')[i].classList.add('checked');
                        }
                        // Atualiza o valor do input oculto
                        document.getElementById('voto').value = value;
                        // Submete o formulário automaticamente após o clique na estrela
                        document.getElementById('voteForm').submit();
                    });
                });
            </script>
        </div>
    <?php else: ?>
        <div class="vote-section mb-4">
            <a href="/usuario/login" class="btn btn-primary">Login</a>
            <a href="/usuario/register" class="btn btn-secondary">Cadastre-se</a>
        </div>
    <?php endif; ?>




    <!-- Área de Comentários -->
    <div class="comments-section">
        <h3>Comentários</h3>
        
        <!-- Exibir comentários existentes com scroll -->
        <?php if (isset($data['comentarios']) && !empty($data['comentarios'])) { ?>
            <div class="list-group mb-4 overflow-auto" style="max-height: 300px;">
                <?php foreach ($data['comentarios'] as $comentario) { ?>
                    <li class="list-group-item">
                        <strong><?= htmlspecialchars($comentario['nome']) ?>:</strong>
                        <p><?= htmlspecialchars($comentario['comentario']) ?></p>
                    </li>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p class="text-muted">Nenhum comentário ainda. Seja o primeiro a comentar!</p>
        <?php } ?>
    </div>



        <!-- Formulário para adicionar novo comentário -->
        <?php if (isset($_COOKIE['usuario_id'])): ?>
            <form action="/comentario/create/<?= htmlspecialchars($data['projeto'][0]['projeto_id']) ?>" method="POST">
                <div class="mb-3">
                    <label for="comentario" class="form-label">Deixe seu comentário:</label>
                    <textarea class="form-control" id="comentario" name="comentario" rows="3" required></textarea>
                </div>
                <input type="hidden" name="id_usuario" value="<?= $_COOKIE['usuario_id'] ?>">
                <input type="hidden" name="id_projeto" value="<?= htmlspecialchars($data['projeto'][0]['projeto_id']) ?>">
                <button type="submit" class="btn btn-primary">Comentar</button>
            </form>
        <?php endif ?>
    </div>
<?php } else { ?>
    <div class="alert alert-warning">Projeto não encontrado ou nenhum dado disponível.</div>
<?php } ?>

<script>
    // Inicializar o carrossel automaticamente
    var carouselElement = document.querySelector('#carousel-projeto');
    if (carouselElement) {
        var carouselInstance = new bootstrap.Carousel(carouselElement, {
            interval: 3000, // Tempo de rotação automático (3 segundos)
            ride: 'carousel'
        });
    }
</script>
