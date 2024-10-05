<h2>Vincular Projeto a Usuários</h2>

<form action="/vinculo/index/" method="POST">
    <div class="mb-3">
        <label for="id_projeto" class="form-label"><i class="fas fa-folder"></i>  Projeto</label>
        <select class="selectpicker form-control" data-live-search="true" id="id_projeto" name="id_projeto" required onchange="this.form.submit()">
            <option value="" disabled selected>Escolha uma equipe</option>
            <?php foreach ($data['projetos'] as $projeto) { ?>
              <option value="<?= $projeto['id'] ?>" data-subtext="<?= $projeto['equipe'] ?>" <?= isset($_POST['id_projeto']) && $_POST['id_projeto'] == $projeto['id'] ? 'selected' : '' ?>>
                    <?= $projeto['projeto'] ?>
              </option>
            <?php } ?>
        </select>
    </div>
</form>

<?php if (!empty($data['usuarios'])) { ?>
    <form action="/vinculo/create" method="POST">
      <div class="mb-3">
          <label for="id_usuario" class="form-label"><i class="fas fa-user"></i>  Usuário</label>
          <select class="selectpicker form-control" data-live-search="true" id="id_usuario" name="id_usuario" required>
              <option value="" disabled selected>Escolha um usuário</option>
              <?php foreach ($data['usuarios'] as $usuario) { ?>
                <option value="<?= $usuario['id'] ?>" data-subtext="<?= $usuario['equipe'] ?>"><?= $usuario['nome'] ?></option>
              <?php } ?>
          </select>
      </div>
      <input type="hidden" name="id_projeto" value="<?= $_POST['id_projeto'] ?? '' ?>">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Vincular</button>
    </form>
<?php } ?>

<hr>

<h3 class="mt-5">Lista de Vínculos</h3>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col"><i class="fas fa-id-badge"></i> ID</th>
        <th scope="col"><i class="fas fa-user"></i> Usuário</th>
        <th scope="col"><i class="fas fa-folder"></i> Projeto</th>
        <th scope="col"><i class="fas fa-cog"></i> Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['vinculos'] as $vinculo) { ?>
      <tr>
        <td><?= $vinculo['id'] ?></td>
        <td><?= $vinculo['usuario'] ?></td>
        <td><?= $vinculo['projeto'] ?></td>
        <td>
          <a href="/vinculo/delete/<?= $vinculo['id'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Excluir</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script>
    $(document).ready(function(){
      $('.selectpicker').selectpicker();
    });
</script>