<h2>Votar em Projetos</h2>

<!-- Formulário para votação -->
<form action="/voto/create" method="POST">
    <div class="mb-3">
        <label for="id_usuario" class="form-label"><i class="fas fa-user"></i>  Usuário</label>
        <select class="selectpicker form-control" data-live-search="true" id="id_usuario" name="id_usuario" required>
            <option value="" disabled selected>Escolha um usuário</option>
            <?php foreach ($data['usuarios'] as $usuario) { ?>
              <option value="<?= $usuario['id'] ?>" data-subtext="<?= $usuario['equipe'] ?>"><?= $usuario['nome'] ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="id_projeto" class="form-label"><i class="fas fa-folder"></i>  Projeto</label>
        <select class="selectpicker form-control" data-live-search="true" id="id_projeto" name="id_projeto" required>
            <option value="" disabled selected>Escolha uma equipe</option>
            <?php foreach ($data['projetos'] as $projeto) { ?>
              <option value="<?= $projeto['id'] ?>" data-subtext="<?= $projeto['equipe'] ?>"><?= $projeto['projeto'] ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="voto" class="form-label"><i class="fas fa-check-circle"></i>  Voto (1-5)</label>
        <input type="number" class="form-control" id="voto" name="voto" min="1" max="5" required>
    </div>

    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>  Votar</button>
</form>

<hr>

<h3 class="mt-5">Lista de Votos</h3>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col"><i class="fas fa-id-badge"></i> ID</th>
        <th scope="col"><i class="fas fa-user"></i> Usuário</th>
        <th scope="col"><i class="fas fa-folder"></i> Projeto</th>
        <th scope="col"><i class="fas fa-users"></i> Equipe</th>
        <th scope="col"><i class="fas fa-check-circle"></i> Voto</th>
        <th scope="col"><i class="fas fa-cog"></i> Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['votos'] as $voto) { ?>
      <tr>
        <td><?= $voto['id'] ?></td>
        <td><?= $voto['usuario'] ?></td>
        <td><?= $voto['projeto'] ?></td>
        <td><?= $voto['equipe'] ?></td>
        <td><?= $voto['voto'] ?></td>
        <td>
          <a href="/voto/delete/<?= $voto['id'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Excluir</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<hr>

<h3 class="mt-5">Soma dos Votos</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Projeto</th>
      <th scope="col">Soma de Votos</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['soma_votos'] as $voto) { ?>
    <tr>
      <td><?= $voto['projeto_id'] ?></td>
      <td><?= $voto['projeto'] ?></td>
      <td><?php echo isset($voto['soma_votos']) ? $voto['soma_votos'] : 0;?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<script>
    $(document).ready(function(){
      $('.selectpicker').selectpicker();
    });
</script>
