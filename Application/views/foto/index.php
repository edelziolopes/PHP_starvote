<h2>Cadastro de Fotos</h2>
<form action="/foto/create" method="POST" enctype="multipart/form-data">
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
        <label for="foto" class="form-label"><i class="fas fa-image"></i> Foto (JPG)</label>
        <input type="file" class="form-control" id="foto" name="foto" accept=".jpg" required>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>  Enviar Foto</button>
</form>

<hr>

<h3 class="mt-5">Lista de Fotos</h3>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col"><i class="fas fa-id-badge"></i> ID</th>
        <th scope="col"><i class="fas fa-folder"></i> Projeto</th>
        <th scope="col"><i class="fas fa-image"></i> Foto</th>
        <th scope="col"><i class="fas fa-cog"></i> Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['fotos'] as $foto) { ?>
      <tr>
        <td><?= $foto['id'] ?></td>
        <td><?= $foto['projeto'] ?></td>
        <td><img src="/fotos/<?= $foto['foto'] ?>" alt="Foto" style="width: 100px;"></td>
        <td>
          <a href="/foto/delete/<?= $foto['id'] ?>" class="btn btn-sm btn-danger">Excluir</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
