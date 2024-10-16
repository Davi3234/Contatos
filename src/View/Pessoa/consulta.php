<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once VIEW.'Components/imports.php'?>
    <title>Consulta de Pessoas</title>
</head>
<style>
  .row-header{
    background-color: rgba(241,241,241);
    border-radius: 4px;
  }
</style>
<body>
    <?php require_once VIEW.'Components/menu.php'?>
    <div class="container" style="margin-top: 60px">
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
      </table>
    </div>
    <script>
      function Incluir(){
        window.location='/view/pessoas/cadastro';
      }
      function Editar(){
        window.location='/view/pessoas/edicao';
      }
      function Excluir(){

      } 
    </script>
</body>
</html>