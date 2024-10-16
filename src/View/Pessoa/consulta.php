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
  </style>
  <body>
      <?php require_once VIEW_PATH.'Components/menu.php'?>
      <div class="container" style="margin-top: 60px">
        <div class="card">
          <div class="card-header text-center">
              <h2 class="card-title">Consulta de Pessoa</h2>
          </div>
          <div class="card-body">
            <button type="button" class="btn btn-primary" onclick="Incluir()">Incluir</button>
            <button type="button" class="btn btn-primary" onclick="Editar()">Editar</button>
            <button type="button" class="btn btn-danger" onclick="Excluir()">Excluir</button>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col">CPF</th>
                </tr>
              </thead>
              <tbody id="body-pessoas">
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <script type="text/template" id="row-template">
        <tr>
          <td>{{id}}</td>
          <td>{{cpf}}</td>
          <td>{{nome}}</td>
        </tr>
      </script>

      <script>
        async function loadPessoas(){
          const response = await fetch('/api/pessoas')
          .then(async function (response){
            return await response.json();
          });

          response.pessoas.forEach(element => {
            content = document.getElementById('row-template').innerHTML.replaceAll('{{id}}', element.id);
            content = content.replaceAll('{{nome}}', element.nome);
            content = content.replaceAll('{{cpf}}', element.cpf);
            document.getElementById('body-pessoas').innerHTML += content;
          });
        }
        function Incluir(){
          window.location='/view/pessoas/cadastro';
        }
        function Editar(){
          window.location='/view/pessoas/edicao';
        }
        function Excluir(){

        } 
        window.onload = function (e){
          loadPessoas();
        };
      </script>
  </body>
</html>