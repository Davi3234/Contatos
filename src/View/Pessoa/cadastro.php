<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa</title>
    <?php require_once VIEW.'Components/imports.php'?>
</head>
<body>
    <?php require_once VIEW.'Components/menu.php'?>
    <form id="cadastroPessoa">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF" aria-label="CPF" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" aria-label="Nome" aria-describedby="basic-addon1">
        </div>
        <button type="button" class="btn btn-success" onclick="Gravar()">Gravar</button>
    </form>
    <script>
        async function Gravar(){
            const response = await fetch('/api/pessoas', {
                method: 'POST',
                body: new FormData(document.getElementById("cadastroPessoa")),
            });

            console.log(response);
        }
    </script>
</body>
</html>