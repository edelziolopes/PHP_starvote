<h2>Perfil do Usuário</h2>
<form action="/usuario/profile" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nome" class="form-label"><i class="fas fa-user"></i> Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?= $data['nome'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $data['email'] ?>" required>
    </div>
    <!--
    <div class="mb-3">
        <label for="senha" class="form-label"><i class="fas fa-lock"></i> Senha (preencha para alterar)</label>
        <input type="password" class="form-control" id="senha" name="senha">
    </div>
    -->
    <div class="mb-3">
        <label for="id_equipe" class="form-label"><i class="fas fa-users"></i> Equipe</label>
        <select class="form-select" id="id_equipe" name="id_equipe" required>
            <option value="" disabled>Escolha uma equipe</option>
            <?php foreach ($data['equipes'] as $equipe) { ?>
                <option value="<?= $equipe['id'] ?>" <?= $data['id_equipe'] == $equipe['id'] ? 'selected' : '' ?>>
                    <?= $equipe['equipe'].' - '.$equipe['categoria'] ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="retrato" class="form-label"><i class="fas fa-image"></i> Foto de perfil</label>
        <input type="file" class="form-control" id="retrato" name="retrato" accept="image/jpeg">
        <?php if (!empty($data['retrato'])) { ?>
            <div>
                <img style="margin-top:20px;" src="/retratos/<?= $data['retrato'] ?>" alt="Retrato" class="rounded-circle" width="100" height="100">
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Atualizar Perfil</button>
    <button type="reset" class="btn btn-danger"><i class="fas fa-cancel"></i> Resetar Senha</button>
</form>
