<h2>Cadastro</h2>
<form action="/usuario/register" method="POST">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" required>
    </div>
    <div class="mb-3">
        <label for="id_equipe" class="form-label">Equipe</label>
        <select class="form-select" id="id_equipe" name="id_equipe" required>
            <option value="" disabled selected>Escolha uma equipe</option>
            <?php foreach ($data['equipes'] as $equipe) { ?>
                <option value="<?= $equipe['id'] ?>"><?= $equipe['equipe'] ?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
