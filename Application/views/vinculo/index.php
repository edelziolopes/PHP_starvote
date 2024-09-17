<h2>Vincular Usuários a Projetos</h2>
<form action="/vinculo/create" method="POST">
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
    <button type="submit" class="btn btn-primary">Vincular</button>
</form>

<hr>

<h3 class="mt-5">Lista de Vínculos</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Usuário</th>
      <th scope="col">Projeto</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['vinculos'] as $vinculo) { ?>
    <tr>
      <td><?= $vinculo['id'] ?></td>
      <td><?= $vinculo['usuario'] ?></td>
      <td><?= $vinculo['projeto'] ?></td>
      <td>
        <a href="/vinculo/delete/<?= $vinculo['id'] ?>" class="btn btn-sm btn-danger">Excluir</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
