<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Contato</title>
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

  <form id="cadastro-contato" class="mt-4">

    <div class="container">
      <?php require_once VIEW_PATH . 'Components/breadcrumb.php' ?>

      <div class="card">

        <div class="card-header text-center">
          <h2 class="card-title">Cadastro de Contato</h2>
        </div>
        <div class="card-body text-end">

          <div class="input-group mb-3">
            <select class="form-select" id="id_pessoa" name="id_pessoa">
              <option value="">Selecione uma pessoa</option>
            </select>
          </div>

          <div class="input-group mb-3">
            <select class="form-select" id="tipo" name="tipo">
              <option value="">Selecione uma tipo</option>
              <option value="EM">Email</option>
              <option value="TE">Telefone</option>
            </select>
          </div>

          <div class="input-group mb-3">
            <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição" aria-label="Descrição">
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

    $(async function() {
      $("#tipo").on('change', changeMask);
      await carregaPessoas();
    });

    async function carregaPessoas(){

      const response = await fetch('/api/pessoas')
      .then(async function (response){
        return await response.json();
      });

      response.pessoas.forEach(element => {
        $("#id_pessoa").append(`<option value="`+element.id+`">`+element.nome+`</option>`);
      });

    }

    async function Gravar() {

      let object = {};
      const formData = new FormData(document.getElementById("cadastro-contato"));

      formData.forEach((element, key) => {
        object[key] = element;
      });

      const response = await fetch('/api/contatos', {
        method: 'POST',
        body: JSON.stringify(object),
      }).then(async function (response){
        return await response.json();
      })
      if(response){
        appendAlert(response.message, response.status, ".alerta");
      }
    }

    function changeMask(){
      if($("#cadastro-contato #tipo").val() == 'TE'){
        $("#cadastro-contato #descricao").mask("(99) 99999-9999");
      }
      else{
        $("#cadastro-contato #descricao").unmask();
      }
    }

  </script>
</body>

</html>