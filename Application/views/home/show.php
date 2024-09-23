<h1>Detalhes do Projeto</h1>

<div class="container">
    <div class="row">
        <?php if (!empty($data['projeto'])) { 
            $projeto = $data['projeto'][0]; // Acesse o primeiro resultado, se múltiplos registros forem retornados
        ?>
            <div class="col-md-12">
                <h3><?= htmlspecialchars($projeto['projeto_nome']); ?></h3>
                <p><?= htmlspecialchars($projeto['descricao']); ?></p>
                <p><strong>Equipe:</strong> <?= htmlspecialchars($projeto['equipe_nome']); ?></p>
                <p><strong>Integrantes:</strong></p>
                <ul>
                    <?php foreach ($data['projeto'] as $p) { ?>
                        <li><?= htmlspecialchars($p['usuario_nome']); ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } else { ?>
            <p>Projeto não encontrado.</p>
        <?php } ?>
    </div>
</div>
