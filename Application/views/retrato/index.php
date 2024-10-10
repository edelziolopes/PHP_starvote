<h2>Cadastro de retratos</h2>
<form action="/retrato/create" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="id_usuario" class="form-label"><i class="fas fa-user"></i>  Usuario</label>
        <select class="selectpicker form-control" data-live-search="true" id="id_usuario" name="id_usuario" required>
            <option value="" disabled selected>Escolha uma equipe</option>
            <?php foreach ($data['usuarios'] as $usuario) { ?>
              <option value="<?= $usuario['id'] ?>" data-subtext="<?= $usuario['equipe'] ?>"><?= $usuario['nome'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="retrato" class="form-label"><i class="fas fa-image"></i> retrato (JPG)</label>
        <input type="file" class="form-control" id="retrato" name="retrato" accept=".jpg" required>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>  Enviar retrato</button>
</form>

<hr>

<h3 class="mt-5">Lista de retratos</h3>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col"><i class="fas fa-id-badge"></i> ID</th>
        <th scope="col"><i class="fas fa-user"></i> Nome</th>
        <th scope="col"><i class="fas fa-image"></i> retrato</th>
        <th scope="col"><i class="fas fa-cog"></i> Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['retratos'] as $retrato) { ?>
      <tr>
        <td><?= $retrato['id'] ?></td>
        <td><?= $retrato['nome'] ?></td>
        <td><img src="/retratos/<?= $retrato['retrato'] ?>" alt="retrato" style="width: 100px;"></td>
        <td>
          <a href="/retrato/delete/<?= $retrato['id'] ?>" class="btn btn-sm btn-danger">Excluir</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
