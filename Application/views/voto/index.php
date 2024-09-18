<h2>Votar em Projetos</h2>

<!-- Formulário para votação -->
<form action="/voto/create" method="POST">
    <div class="mb-3">
        <label for="id_usuario" class="form-label">Usuário</label>
        <select class="form-select" id="id_usuario" name="id_usuario" required>
            <option value="" disabled selected>Escolha um usuário</option>
            <?php foreach ($data['usuarios'] as $usuario) { ?>
                <option value="<?= $usuario['id'] ?>"><?= $usuario['nome'] ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="id_projeto" class="form-label">Projeto</label>
        <select class="form-select" id="id_projeto" name="id_projeto" required>
            <option value="" disabled selected>Escolha um projeto</option>
            <?php foreach ($data['projetos'] as $projeto) { ?>
                <option value="<?= $projeto['id'] ?>"><?= $projeto['projeto'] ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="voto" class="form-label">Voto (1-5)</label>
        <input type="number" class="form-control" id="voto" name="voto" min="1" max="5" required>
    </div>

    <button type="submit" class="btn btn-primary">Votar</button>
</form>

<hr>

<h3 class="mt-5">Lista de Votos</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Usuário</th>
      <th scope="col">Projeto</th>
      <th scope="col">Voto</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['votos'] as $voto) { ?>
    <tr>
      <td><?= $voto['id'] ?></td>
      <td><?= $voto['usuario'] ?></td>
      <td><?= $voto['projeto'] ?></td>
      <td><?= $voto['voto'] ?></td>
      <td>
        <a href="/voto/delete/<?= $voto['id'] ?>" class="btn btn-sm btn-danger">Excluir</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
