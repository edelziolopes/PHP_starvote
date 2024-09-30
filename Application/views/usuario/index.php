<h2>Cadastro de Usuários</h2>
<form action="/usuario/create" method="POST">
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
        <input type="senha" class="form-control" id="senha" name="senha" required>
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
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<hr>

<h3 class="mt-5">Lista de Usuários</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
      <th scope="col">Equipe</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['usuarios'] as $usuario) { ?>
    <tr>
      <td><?= $usuario['id'] ?></td>
      <td><?= $usuario['nome'] ?></td>
      <td><?= $usuario['email'] ?></td>
      <td><?= $usuario['equipe'] ?></td>
      <td>
        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $usuario['id'] ?>" data-nome="<?= $usuario['nome'] ?>" data-email="<?= $usuario['email'] ?>" data-id_equipe="<?= $usuario['id_equipe'] ?>">Editar</button>
        <a href="/usuario/delete/<?= $usuario['id'] ?>" class="btn btn-sm btn-danger">Excluir</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/usuario/edit" method="POST">
          <input type="hidden" id="edit-id" name="id">
          <div class="mb-3">
              <label for="edit-nome" class="form-label">Nome</label>
              <input type="text" class="form-control" id="edit-nome" name="nome" required>
          </div>
          <div class="mb-3">
              <label for="edit-email" class="form-label">Email</label>
              <input type="email" class="form-control" id="edit-email" name="email" required>
          </div>
          <div class="mb-3">
              <label for="edit-id_equipe" class="form-label">Equipe</label>
              <select class="form-select" id="edit-id_equipe" name="id_equipe" required>
                  <?php foreach ($data['equipes'] as $equipe) { ?>
                      <option value="<?= $equipe['id'] ?>"><?= $equipe['equipe'] ?></option>
                  <?php } ?>
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    var editModal = document.getElementById('editModal')
    editModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget
      var id = button.getAttribute('data-id')
      var nome = button.getAttribute('data-nome')
      var email = button.getAttribute('data-email')
      var id_equipe = button.getAttribute('data-id_equipe')

      var modalIdInput = editModal.querySelector('#edit-id')
      var modalNomeInput = editModal.querySelector('#edit-nome')
      var modalEmailInput = editModal.querySelector('#edit-email')
      var modalEquipeSelect = editModal.querySelector('#edit-id_equipe')

      modalIdInput.value = id
      modalNomeInput.value = nome
      modalEmailInput.value = email
      modalEquipeSelect.value = id_equipe
    })
</script>
