<h2>Perfil do Usuário</h2>
<form action="/usuario/profile" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nome" class="form-label"><i class="fas fa-user"></i> Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($_COOKIE['usuario_nome']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($_COOKIE['usuario_email']) ?>" required>
    </div>
    <!--
    <div class="mb-3">
        <label for="senha" class="form-label"><i class="fas fa-lock"></i> Senha (preencha para alterar)</label>
        <input type="password" class="form-control" id="senha" name="senha">
    </div>
    -->
    <div class="mb-3">
        <label for="edit-id_equipe" class="form-label">Equipe</label>
        <select class="form-select" id="edit-id_equipe" name="id_equipe" required>
            <?php foreach ($data['equipes'] as $equipe) { ?>
                <option value="<?= $equipe['id'] ?>"><?= $equipe['equipe'].' - '.$equipe['categoria'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="retrato" class="form-label"><i class="fas fa-image"></i> Foto de perfil</label>
        <input type="file" class="form-control" id="retrato" name="retrato" accept="image/jpeg">
        <?php if(!empty($_COOKIE['usuario_retrato'])): ?>
            <div>
                <img style="margin-top:20px;" src="/retratos/<?= htmlspecialchars($_COOKIE['usuario_retrato']) ?>" alt="Retrato" class="rounded-circle" width="100" height="100">
            </div>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Atualizar Perfil</button>
    <button type="reset" class="btn btn-danger"><i class="fas fa-cancel"></i> Resetar Senha</button>
</form>
