<?php
require("./funcoes.php");
$funcionarios = lerAquivo("./empresaX.json");

if (isset($_GET["buscarFuncionario"]) && $_GET["buscarFuncionario"] != "") {
    $funcionarios = buscarFuncionario($funcionarios, $_GET["buscarFuncionario"]);
}


if (isset($_POST["idFuncionario"])) 
{
    $id = $_POST["idFuncionario"];
    $primeiroNome = $_POST["primeiroNomeFuncionario"];
    $segundoNome = $_POST["ultimoNomeFuncionario"];
    $email = $_POST["emailFuncionario"];
    $genero = $_POST["gender"];
    $enderecoIp = $_POST["ipAddressFuncionario"];
    $pais = $_POST["countryFuncionario"];
    $departamento = $_POST["departments"];
    
    registrarFuncionario($funcionarios,$id, $primeiroNome,$segundoNome,$email,$genero,$enderecoIp,$pais,$departamento);
}

if(isset($_GET["idFuncionarioApagar"])) 
{
    $idFuncionarioApagar = $_GET["idFuncionarioApagar"];
    apagarFuncionario("./empresaX.json", $funcionarios, $idFuncionarioApagar );
    header("location: index.php");

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
    <script src="./scripts.js"></script>

    <link rel="stylesheet" href="style.css">

    <title>Busca de Funcionarios</title>
</head>

<body>
    <section>

        <h1>Funcionários da empresa X</h1>
        <h2>A empresa conta com <?= $numeroTotalFuncionarios ?> funcionários</h2>

        <form>
            <input type="text" name="buscarFuncionario" placeholder="Buscar Funcionario" value="<?= isset($_GET["buscarFuncionario"]) ? $_GET["buscarFuncionario"] : "" ?>">
            <button><i class="fas fa-search"></i></button>
        </form>
        <button onclick="showFormAddFuncionario()"><i class="fas fa-plus"></i></button>

        <table>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>E-mail</th>
                <th>Sexo</th>
                <th>Endereço IP</th>
                <th>País</th>
                <th>Departamento</th>
                <th>Ações</th>
            </tr>

            <?php
            foreach ($funcionarios as $funcionario) :
            ?>
                <tr>
                    <td><?= $funcionario->id ?></td>
                    <td><?= $funcionario->first_name ?></td>
                    <td><?= $funcionario->last_name ?></td>
                    <td><?= $funcionario->email ?></td>
                    <td><?= $funcionario->gender ?></td>
                    <td><?= $funcionario->ip_address ?></td>
                    <td><?= $funcionario->country ?></td>
                    <td><?= $funcionario->department ?></td>
                    <td>
                        <form>
                            <input type="hidden" name="idFuncionarioApagar" value=<?= $funcionario->id ?>>
                            <button><i class="far fa-trash-alt"></i></button> 
                        </form>
                        <form action="./acoes.php">
                            <input type="hidden" name="idFuncionarioEditar" value="<?= $funcionario->id ?>">
                            <input type="hidden" name="first_name" value="<?= $funcionario->first_name ?>">
                            <input type="hidden" name="last_name" value="<?= $funcionario->last_name ?>">
                            <input type="hidden" name="email" value="<?= $funcionario->email ?>">
                            <input type="hidden" name="gender" value="<?= $funcionario->gender ?>">
                            <input type="hidden" name="ip_address" value="<?= $funcionario->ip_address ?>">
                            <input type="hidden" name="country" value="<?= $funcionario->country ?>">
                            <input type="hidden" name="department" value="<?= $funcionario->department ?>">
                            <button><i class="far fa-edit"></i></button>
                        </form>
                         
                    </td>

                </tr>
            <?php
            endforeach;
            ?>

        </table>
        <div class="conteiner-form-adicao-funcionario">
            <form method="POST">
                <h3>Adicionar Funcionario</h3>
                <div class="conteiner-id">
                    <label for="id" class="titulo-form">ID</label>
                    <input id="id" type="number" name="idFuncionario" required>
                </div>
                <div class="conteiner-name">
                    <label class="titulo-form">Name:</label>
                    <input type="text" name="primeiroNomeFuncionario" placeholder="first name" required>
                    <input type="text" name="ultimoNomeFuncionario" placeholder="second name" required>
                </div>
                <div class="conteiner-email">
                    <label class="titulo-form">Email</label>
                    <input name="emailFuncionario" type="text" required>
                </div>
                <div class="conteiner-gender">
                    <label class="titulo-form">Gender</label><br>
                    <input type="radio" name="gender" id="female" value="Female" required>
                    <label for="female">Female</label><br>
                    <input type="radio" name="gender" id="male" value="Female" required>
                    <label for="male">Male</label><br>
                    <input type="radio" name="gender" id="other" value="Other"required>
                    <label for="other">Other</label><br>
                </div>
                <div class="conteiner-ip-adress">
                    <label class="titulo-form">IP Adress</label>
                    <input type="text" name="ipAddressFuncionario" maxlength="8" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required></input>
                </div>
                <div class="conteiner-country">
                    <label class="titulo-form">Country</label>
                    <input type="text" name="countryFuncionario" required>

                </div>
                <div class="conteiner-department">
                    <label class="titulo-form">department</label>
                    <select name="departments">
                        <option selected disabled value=" ">Selecione</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Human Resources">Human Resources</option>
                        <option value="Research and Development">Research and Development</option>
                        <option value="Support">Support</option>
                        <option value="Accounting">Accounting</option>
                        <option value="Training">Training</option>
                        <option value="Legal">Legal</option>

                    </select>
                </div>

                <button>Adicionar Funcionário!</button>
            </form>
        </div>
    </section>

</body>

</html>