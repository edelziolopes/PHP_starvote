<h2>Cadastro de Projetos</h2>
<form action="/projeto/create" method="POST">
    <div class="mb-3">
        <label for="projeto" class="form-label"><i class="fas fa-folder"></i> Nome do Projeto</label>
        <input type="text" class="form-control" id="projeto" name="projeto" required>
    </div>
    <div class="mb-3">
        <label for="descricao" class="form-label"><i class="fas fa-info-circle"></i> Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
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
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
</form>

<hr>

<h3 class="mt-5">Lista de Projetos</h3>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Projeto</th>
        <th scope="col">Descrição</th>
        <th scope="col">Equipe</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['projetos'] as $projeto) { ?>
      <tr>
        <td><?= $projeto['id'] ?></td>
        <td><?= $projeto['projeto'] ?></td>
        <td><?= $projeto['descricao'] ?></td>
        <td><?= $projeto['equipe'] ?></td>
        <td>
          <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $projeto['id'] ?>" data-projeto="<?= $projeto['projeto'] ?>" data-descricao="<?= $projeto['descricao'] ?>" data-id_equipe="<?= $projeto['id_equipe'] ?>"><i class="fas fa-edit"></i> Editar</button>
          <a href="/projeto/delete/<?= $projeto['id'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Excluir</a>
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
        <h5 class="modal-title" id="editModalLabel">Editar Projeto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/projeto/edit" method="POST">
          <input type="hidden" id="edit-id" name="id">
          <div class="mb-3">
              <label for="edit-projeto" class="form-label">Nome do Projeto</label>
              <input type="text" class="form-control" id="edit-projeto" name="projeto" required>
          </div>
          <div class="mb-3">
              <label for="edit-descricao" class="form-label">Descrição</label>
              <textarea class="form-control" id="edit-descricao" name="descricao" rows="3" required></textarea>
          </div>
          <div class="mb-3">
              <label for="edit-id_equipe" class="form-label">Equipe</label>
              <select class="form-select" id="edit-id_equipe" name="id_equipe" required>
                  <?php foreach ($data['equipes'] as $equipe) { ?>
                    <option value="<?= $equipe['id'] ?>"><?= $equipe['equipe'].' - '.$equipe['categoria'] ?></option>
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
      var projeto = button.getAttribute('data-projeto')
      var descricao = button.getAttribute('data-descricao')
      var id_equipe = button.getAttribute('data-id_equipe')

      var modalIdInput = editModal.querySelector('#edit-id')
      var modalProjetoInput = editModal.querySelector('#edit-projeto')
      var modalDescricaoInput = editModal.querySelector('#edit-descricao')
      var modalEquipeSelect = editModal.querySelector('#edit-id_equipe')

      modalIdInput.value = id
      modalProjetoInput.value = projeto
      modalDescricaoInput.value = descricao
      modalEquipeSelect.value = id_equipe
    })

    $(document).ready(function(){
      $('.selectpicker').selectpicker();
    });
</script>
