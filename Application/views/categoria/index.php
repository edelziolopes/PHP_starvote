<h2>Cadastro de Categorias</h2>
<form action="/categoria/create" method="POST">
    <div class="mb-3">
        <label for="categoria" class="form-label"><i class="fas fa-tag"></i> Categoria</label>
        <input type="text" class="form-control" id="categoria" name="categoria" required>
    </div>
    <div class="mb-3">
        <label for="peso" class="form-label"><i class="fas fa-weight-hanging"></i> Peso</label>
        <input type="number" class="form-control" id="peso" name="peso" required>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
</form>

<hr>

<h3 class="mt-5">Lista de Categorias</h3>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col"><i class="fas fa-id-badge"></i> ID</th>
        <th scope="col"><i class="fas fa-tag"></i> Categoria</th>
        <th scope="col"><i class="fas fa-weight-hanging"></i> Peso</th>
        <th scope="col"><i class="fas fa-cog"></i> Ações</th>
      </tr> 
    </thead>
    <tbody>
      <?php foreach ($data['categorias'] as $categoria) { ?>
      <tr>
        <td><?= $categoria['id'] ?></td>
        <td><?= $categoria['categoria'] ?></td>
        <td><?= $categoria['peso'] ?></td>
        <td>
          <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $categoria['id'] ?>" data-categoria="<?= $categoria['categoria'] ?>" data-peso="<?= $categoria['peso'] ?>"><i class="fas fa-edit"></i> Editar</button>
          <a href="/categoria/delete/<?= $categoria['id'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Excluir</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/categoria/edit" method="POST">
          <input type="hidden" id="edit-id" name="id">
          <div class="mb-3">
              <label for="edit-categoria" class="form-label">Categoria</label>
              <input type="text" class="form-control" id="edit-categoria" name="categoria" required>
          </div>
          <div class="mb-3">
              <label for="edit-peso" class="form-label">Peso</label>
              <input type="number" class="form-control" id="edit-peso" name="peso" required>
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
      var categoria = button.getAttribute('data-categoria')
      var peso = button.getAttribute('data-peso')

      var modalIdInput = editModal.querySelector('#edit-id')
      var modalCategoriaInput = editModal.querySelector('#edit-categoria')
      var modalPesoInput = editModal.querySelector('#edit-peso')

      modalIdInput.value = id
      modalCategoriaInput.value = categoria
      modalPesoInput.value = peso
    })
</script>
