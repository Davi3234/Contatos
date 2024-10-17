<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php require_once VIEW_PATH.'Components/imports.php'?>
      <title>Consulta de Pessoas</title>
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
              <h2 class="card-title">Consulta de Pessoa</h2>
          </div>
          <div class="card-body">

            <div class="actions">
              <button id="btn-incluir" type="button" class="btn btn-primary" onclick="Incluir()">Incluir</button>
              <button id="btn-editar" type="button" class="btn btn-primary" onclick="Editar()" disabled>Editar</button>
              <button id="btn-excluir" type="button" class="btn btn-danger" onclick="Excluir()" disabled>Excluir</button>
            </div>
            
            <div class="input-group mb-3 mt-3">
              <input type="text" class="form-control" id="filtro" placeholder="Nome..." aria-label="Nome..." aria-describedby="basic-addon1">
              <button id="btn-pesquisar" type="button" class="btn btn-secondary" onclick="loadPessoas()">Pesquisar</button>
            </div>

            <table id="table-pessoa" class="table table-hover mt-3">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">CPF</th>
                  <th scope="col">Nome</th>
                </tr>
              </thead>
              <tbody id="body-pessoas"></tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="alerta"></div>

      <script type="text/template" id="row-template">
        <tr idpessoa="{{id}}">
          <td>{{id}}</td>
          <td>{{cpf}}</td>
          <td>{{nome}}</td>
        </tr>
      </script>

      <script>
        let idSelected = 0;

        async function loadPessoas(){

          $("#body-pessoas").html("");

          const response = await fetch('/api/pessoas?nome='+$("#filtro").val())
          .then(async function (response){
            return await response.json();
          });

          if(response.pessoas){

            response.pessoas.forEach(element => {
              content = document.getElementById('row-template').innerHTML.replaceAll('{{id}}', element.id);
              content = content.replaceAll('{{nome}}', element.nome);
              content = content.replaceAll('{{cpf}}', element.cpf);
              document.getElementById('body-pessoas').innerHTML += content;
            });
          }

          $("#table-pessoa tbody tr").on("click", selectRow);
        }

        function Incluir(){
          window.location='/view/pessoas/cadastro';
        }

        function Editar(){
          window.location="/view/pessoas/edicao?id="+idSelected;
        }

        async function Excluir(){

          const response = await fetch('/api/pessoas/'+idSelected, {
            method: 'DELETE',
          }).then(async function (response){
            return await response.json();
          });

          if(response){
            appendAlert(response.message, response.status, ".alerta");
          }

          $("#btn-editar").attr('disabled', 'disabled');
          $("#btn-excluir").attr('disabled', 'disabled');

          await loadPessoas();
        } 

        function selectRow(){
          $("#table-pessoa tbody tr").removeClass('table-active');
          $(this).addClass('table-active');
          idSelected = $(this).attr("idpessoa");
          $("#btn-editar").removeAttr('disabled', 'disabled');
          $("#btn-excluir").removeAttr('disabled', 'disabled');
        }
        
        $(async function() {
          await loadPessoas();
        });
      </script>
  </body>
</html>