<h2>Cadastro</h2>
<form action="/usuario/register" method="POST">
    <div class="mb-3">
        <label for="nome" class="form-label"><i class="fas fa-user"></i> Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="senha" class="form-label"><i class="fas fa-lock"></i> Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" required>
    </div>
    <div class="mb-3">
        <label for="id_equipe" class="form-label"><i class="fas fa-users"></i> Equipe</label>
        <select class="selectpicker form-control" data-live-search="true" id="id_equipe" name="id_equipe" required>
            <option value="" disabled selected>Escolha uma equipe</option>
            <?php foreach ($data['equipes'] as $equipe) { ?>
              <option value="<?= $equipe['id'] ?>" data-subtext="<?= $equipe['categoria'] ?>"><?= $equipe['equipe'] ?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cadastrar</button>
</form>

<script>
$(document).ready(function(){
      $('.selectpicker').selectpicker();
    });
</script>