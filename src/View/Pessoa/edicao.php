<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edição de Pessoa</title>
  <?php require_once VIEW_PATH . 'Components/imports.php' ?>
</head>

<style>
  .alerta{
    position:absolute;
    top: 89%;
    left: 81%;
  }
</style>

<body>
  <?php require_once VIEW_PATH . 'Components/menu.php' ?>
  <form id="edicao-pessoa" class="mt-4">
    <div class="container">
      <?php require_once VIEW_PATH . 'Components/breadcrumb.php' ?>
      <div class="card">
        <div class="card-header text-center">
          <h2 class="card-title">Edição de Pessoa #<?= $pessoa->getId()?></h2>
        </div>
        <div class="card-body text-end">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="nome" id="nome" value="<?= $pessoa->getNome()?>" placeholder="Nome" aria-label="Nome">
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="cpf" id="cpf" value="<?= $pessoa->getCpf()?>" placeholder="CPF" aria-label="CPF">
          </div>
          <div class="input-group mb-3">
            <button type="button" class="btn btn-success" onclick="Gravar()">Gravar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <div class="alerta"></div>
  <script>
    $(document).ready(function() {
      $('#cpf').mask('000.000.000-00');
    });

    async function Gravar() {

      let object = {};
      const formData = new FormData(document.getElementById("edicao-pessoa"));

      formData.forEach((element, key) => {
        object[key] = element;
      });

      const response = await fetch('/api/pessoas/<?= $pessoa->getId()?>', {
        method: 'PUT',
        body: JSON.stringify(object),
        headers:{
          'Content-Type': 'application/json'
        }
      }).then(async function (response){
        return await response.json();
      })
      if(response){
        appendAlert(response.message, response.status, ".alerta");
      }
    }
  </script>
</body>

</html>