<?php
    require("./funcoes.php");
    $funcionarios = lerAquivo("./empresaX.json");

    if(isset($_GET["buscarFuncionario"]))
    {
        $funcionarios = buscarFuncionario($funcionarios, $_GET["buscarFuncionario"]);
    }

    $numeroTotalFuncionarios = contarFuncionariosTotal($funcionarios);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://kit.fontawesome.com/a757f2d5f7.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">

    <title>Busca de Funcionarios</title>
</head>
<body>
    <section>

        <h1>Funcionários da empresa X</h1>
        <h2>A empresa conta com <?= $numeroTotalFuncionarios?> funcionários</h2>

        <form>
            <input type="text" name="buscarFuncionario" placeholder="Buscar Funcionario" value="<?=isset($_GET["buscarFuncionario"]) ? $_GET["buscarFuncionario"] : ""?>">
            <button><i class="fas fa-search"></i></button>
        </form>
        
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>E-mail</th>
                <th>Sexo</th>
                <th>Endereço IP</th>
                <th>País</th>
                <th>Departamento</th>
            </tr>

            <?php
                foreach($funcionarios as $funcionario) :
            ?>
            <tr>
                <td><?= $funcionario->id?></td>
                <td><?= $funcionario->first_name?></td>
                <td><?= $funcionario->last_name?></td>
                <td><?= $funcionario->email?></td>
                <td><?= $funcionario->gender?></td>
                <td><?= $funcionario->ip_address?></td>
                <td><?= $funcionario->country?></td>
                <td><?= $funcionario->department?></td>

            </tr>    
            <?php
                endforeach;
            ?>

    </table>
    </section>
</body>
</html>

