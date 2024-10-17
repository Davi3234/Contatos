<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edição de Contato</title>
  <?php require_once VIEW_PATH . 'Components/imports.php' ?>
</head>

<body>
  <?php require_once VIEW_PATH . 'Components/menu.php' ?>
  <form id="visualizacao-contato" class="mt-4">

    <div class="container">

      <?php require_once VIEW_PATH . 'Components/breadcrumb.php' ?>

      <div class="card">

        <div class="card-header text-center">
          <h2 class="card-title">Visualização de Contato #<?= $contato->getId()?></h2>
        </div>
        <div class="card-body text-end">

          <div class="input-group mb-3">
            <select class="form-select" id="id_pessoa" name="id_pessoa" disabled>
              <option value="">Selecione uma pessoa</option>
            </select>
          </div>

          <div class="input-group mb-3">
            <select class="form-select" id="tipo" name="tipo" disabled>
              <option value="">Selecione uma tipo</option>
              <option value="EM" <?= $contato->getTipo() == 'EM' ? 'selected' : ''?>>Email</option>
              <option value="TE" <?= $contato->getTipo() == 'TE' ? 'selected' : ''?>>Telefone</option>
            </select>
          </div>

          <div class="input-group mb-3">
            <input type="text" class="form-control" name="descricao" id="descricao" value="<?= $contato->getDescricao()?>" placeholder="Descrição" aria-label="Descrição" disabled>
          </div>
          
        </div>
      </div>

    </div>

  </form>

  <script>

    $(async function() {
      await carregaPessoas();

      if($("#visualizacao-contato #tipo").val() == 'TE'){
        $("#visualizacao-contato #descricao").mask("(99) 99999-9999");
      }
      else{
        $("#visualizacao-contato #descricao").unmask();
      }
    });

    async function carregaPessoas(){

      const response = await fetch('/api/pessoas')
      .then(async function (response){
        return await response.json();
      });

      if(response.pessoas){
        response.pessoas.forEach(element => {
          $("#id_pessoa").append(`<option value="`+element.id+`" `+('<?= $contato->getPessoa()->getId()?>' == element.id ? `selected` : ``)+`>`+element.nome+`</option>`);
        });
      }

    }

  </script>
</body>

</html>