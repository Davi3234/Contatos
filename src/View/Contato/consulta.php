<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php require_once VIEW_PATH.'Components/imports.php'?>
      <title>Consulta de Contatos</title>
  </head>
  <style>
    .row-header{
      background-color: rgba(241,241,241);
      border-radius: 4px;
    }
    .alerta{
      position:absolute;
      top: 89%;
      left: 81%;
    }
  </style>
  <body>
      <?php require_once VIEW_PATH.'Components/menu.php'?>

      <div class="container mt-4">
        <?php require_once VIEW_PATH.'Components/breadcrumb.php'?>
        <div class="card">
          <div class="card-header text-center">
              <h2 class="card-title">Consulta de Contato</h2>
          </div>
          <div class="card-body">

            <div class="actions">
              <button id="btn-incluir" type="button" class="btn btn-primary" onclick="Incluir()">Incluir</button>
              <button id="btn-editar" type="button" class="btn btn-primary" onclick="Editar()" disabled>Editar</button>
              <button id="btn-excluir" type="button" class="btn btn-danger" onclick="Excluir()" disabled>Excluir</button>
            </div>
            
            <div class="input-group mb-3 mt-3">
              <input type="text" class="form-control" id="filtro" placeholder="Descrição..." aria-label="Descrição..." aria-describedby="basic-addon1">
              <button id="btn-pesquisar" type="button" class="btn btn-secondary" onclick="loadContatos()">Pesquisar</button>
            </div>

            <table id="table-contato" class="table table-hover mt-3">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Descrição</th>
                  <th scope="col">Pessoa</th>
                </tr>
              </thead>
              <tbody id="body-contatos"></tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="alerta"></div>

      <script type="text/template" id="row-template">
        <tr idcontato="{{id}}">
          <td>{{id}}</td>
          <td>{{tipo}}</td>
          <td>{{descricao}}</td>
          <td>{{pessoa}}</td>
        </tr>
      </script>

      <script>
        let idSelected = 0;

        async function loadContatos(){

          $("#body-contatos").html("");

          const response = await fetch('/api/contatos?descricao='+$("#filtro").val())
          .then(async function (response){
            return await response.json();
          });

          if(response.contatos){

            response.contatos.forEach(element => {
              content = document.getElementById('row-template').innerHTML.replaceAll('{{id}}', element.id);
              content = content.replaceAll('{{tipo}}', element.tipo);
              content = content.replaceAll('{{descricao}}', element.descricao);
              content = content.replaceAll('{{pessoa}}', element.pessoa);
              document.getElementById('body-contatos').innerHTML += content;
            });
          }

          $("#table-contato tbody tr").on("click", selectRow);
        }

        function Incluir(){
          window.location='/view/contatos/cadastro';
        }

        function Editar(){
          window.location="/view/contatos/edicao?id="+idSelected;
        }

        async function Excluir(){

          const response = await fetch('/api/contatos/'+idSelected, {
            method: 'DELETE',
          }).then(async function (response){
            return await response.json();
          });

          if(response){
            appendAlert(response.message, response.status, ".alerta");
          }

          $("#btn-editar").attr('disabled', 'disabled');
          $("#btn-excluir").attr('disabled', 'disabled');

          await loadContatos();
        } 

        function selectRow(){
          $("#table-contato tbody tr").removeClass('table-active');
          $(this).addClass('table-active');
          idSelected = $(this).attr("idcontato");
          $("#btn-editar").removeAttr('disabled', 'disabled');
          $("#btn-excluir").removeAttr('disabled', 'disabled');
        }
        
        $(async function() {
          await loadContatos();
        });
      </script>
  </body>
</html>