<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edição de Pessoa</title>
  <?php require_once VIEW_PATH . 'Components/imports.php' ?>
</head>

<body>
  <?php require_once VIEW_PATH . 'Components/menu.php' ?>
  <form id="edicao-pessoa" class="mt-4">
    <div class="container">
      <?php require_once VIEW_PATH . 'Components/breadcrumb.php' ?>
      <div class="card">
        <div class="card-header text-center">
          <h2 class="card-title">Visualização de Pessoa #<?= $pessoa->getId()?></h2>
        </div>
        <div class="card-body text-end">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="nome" id="nome" value="<?= $pessoa->getNome()?>" placeholder="Nome" aria-label="Nome" disabled>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="cpf" id="cpf" value="<?= $pessoa->getCpf()?>" placeholder="CPF" aria-label="CPF" disabled>
          </div>
        </div>
      </div>
    </div>
  </form>
  <script>
    $(document).ready(function() {
      $('#cpf').mask('000.000.000-00');
    });
  </script>
</body>

</html>