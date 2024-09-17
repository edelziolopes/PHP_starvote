<h2>Cadastro de Equipes</h2>
<form action="/equipe/create" method="POST">
    <div class="mb-3">
        <label for="equipe" class="form-label">Equipe</label>
        <input type="text" class="form-control" id="equipe" name="equipe" required>
    </div>
    <div class="mb-3">
        <label for="id_categoria" class="form-label">Categoria</label>
        <select class="form-select" id="id_categoria" name="id_categoria" required>
            <option value="" disabled selected>Escolha uma categoria</option>
            <?php foreach ($data['categorias'] as $categoria) { ?>
                <option value="<?= $categoria['id'] ?>"><?= $categoria['categoria'] ?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<hr>

<h3 class="mt-5">Lista de Equipes</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Equipe</th>
      <th scope="col">Categoria</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['equipes'] as $equipe) { ?>
    <tr>
      <td><?= $equipe['id'] ?></td>
      <td><?= $equipe['equipe'] ?></td>
      <td><?= $equipe['categoria'] ?></td>
      <td>
        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $equipe['id'] ?>" data-equipe="<?= $equipe['equipe'] ?>" data-id_categoria="<?= $equipe['id_categoria'] ?>">Editar</button>
        <a href="/equipe/delete/<?= $equipe['id'] ?>" class="btn btn-sm btn-danger">Excluir</a>
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
        <h5 class="modal-title" id="editModalLabel">Editar Equipe</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/equipe/edit" method="POST">
          <input type="hidden" id="edit-id" name="id">
          <div class="mb-3">
              <label for="edit-equipe" class="form-label">Equipe</label>
              <input type="text" class="form-control" id="edit-equipe" name="equipe" required>
          </div>
          <div class="mb-3">
              <label for="edit-id_categoria" class="form-label">Categoria</label>
              <select class="form-select" id="edit-id_categoria" name="id_categoria" required>
                  <?php foreach ($data['categorias'] as $categoria) { ?>
                      <option value="<?= $categoria['id'] ?>"><?= $categoria['categoria'] ?></option>
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
      var equipe = button.getAttribute('data-equipe')
      var id_categoria = button.getAttribute('data-id_categoria')

      var modalIdInput = editModal.querySelector('#edit-id')
      var modalEquipeInput = editModal.querySelector('#edit-equipe')
      var modalCategoriaSelect = editModal.querySelector('#edit-id_categoria')

      modalIdInput.value = id
      modalEquipeInput.value = equipe
      modalCategoriaSelect.value = id_categoria
    })
</script>
