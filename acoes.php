<?php

require("./funcoes.php");

$funcionarios = lerAquivo("./empresaX.json");

if(isset($_GET["idFuncionarioEditar"])) 
{
    $funcionarioEditar = [
        "id" => $_GET["idFuncionarioEditar"],
        "first_name" => $_GET["first_name"],
        "last_name" => $_GET["last_name"],
        "email" => $_GET["email"],
        "gender" => $_GET["gender"],
        "ip_address" => $_GET["ip_address"],
        "country" => $_GET["country"],
        "department" => $_GET["department"]
    ];

    // print_r($funcionarioEditar);
}
if(isset($_GET["idFuncionario"])) 
{
    $funcionarioEditado = [
        "id" => $_GET["idFuncionario"],
        "first_name" => $_GET["first_name"],
        "last_name" => $_GET["last_name"],
        "email" => $_GET["email"],
        "gender" => $_GET["gender"],
        "ip_address" => $_GET["ip_address"],
        "country" => $_GET["country"],
        "department" => $_GET["departments"]
    ];
    
    print_r($funcionarioEditado) ;
    editarFuncionario("./empresaX.json", $funcionarios, $funcionarioEditado);
    header("location: index.php");
}

else
{
    //echo "socorro deus";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a757f2d5f7.js" crossorigin="anonymous"></script>
    <script src="./scripts.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Editar Funcionario</title>
</head>
<body>
    <section>
        <div class="conteiner-form-edicao-funcionario">
            <form>
                <h3>Editar Funcionario</h3>
                <div class="conteiner-id">
                    <label for="id" class="titulo-form">ID</label>
                    <input id="id" type="number" name="idFuncionario" value=<?=$funcionarioEditar["id"]?> readonly>
                </div>
                <div class="conteiner-name">
                    <label class="titulo-form">Name:</label>
                    <input type="text" name="first_name" placeholder="first name" value=<?=$funcionarioEditar["first_name"]?> required>
                    <input type="text" name="last_name" placeholder="second name" value=<?=$funcionarioEditar["last_name"]?> required>
                </div>
                <div class="conteiner-email">
                    <label class="titulo-form">Email</label>
                    <input name="email" type="text" value=<?=$funcionarioEditar["email"]?> required>
                </div>
                <div class="conteiner-gender">
                    <label class="titulo-form">Gender</label><br>
                    <input type="radio" name="gender" id="female" value="Female" <?= $funcionarioEditar["gender"] == "Female" ? "checked" : "" ?> required>
                    <label for="female">Female</label><br>
                    <input type="radio" name="gender" id="male" value="Female" <?= $funcionarioEditar["gender"] == "Male" ? "checked" : "" ?> required>
                    <label for="male">Male</label><br>
                    <input type="radio" name="gender" id="other" value="Other" <?= $funcionarioEditar["gender"] == "Other" ? "checked" : "" ?> required>
                    <label for="other">Other</label><br>
                </div>
                <div class="conteiner-ip-adress">
                    <label class="titulo-form">IP Adress</label>
                    <input type="text" name="ip_address" maxlength="8" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value=<?=$funcionarioEditar["ip_address"]?> required></input>
                </div>
                <div class="conteiner-country">
                    <label class="titulo-form">Country</label>
                    <input type="text" name="country" value=<?=$funcionarioEditar["country"]?> required>

                </div>
                <div class="conteiner-department">
                    <label class="titulo-form">department</label>
                    <select name="departments">
                        <option selected value="<?=$funcionarioEditar["department"]?>"><?=$funcionarioEditar["department"]?></option>
                        <?= $funcionarioEditar["department"] == "Marketing" ? "" : "<option value='Marketing'>Marketing</option>" ?>
                        <?= $funcionarioEditar["department"] == "Engineering" ? "" : "<option value='Engineering'>Engineering</option>" ?>
                        <?= $funcionarioEditar["department"] == "Human Resources" ? "" : "<option value='Human Resources'>Human Resources</option>" ?>
                        <?= $funcionarioEditar["department"] == "Research and Development" ? "" : "<option value='Research and Development'>Research and Development</option>" ?>
                        <?= $funcionarioEditar["department"] == "Support" ? "" : "<option value='Support'>Support</option>" ?>
                        <?= $funcionarioEditar["department"] == "Accounting" ? "" : "<option value='Accounting'>Accounting</option>" ?>
                        <?= $funcionarioEditar["department"] == "Training" ? "" : "<option value='Training'>Training</option>" ?>
                        <?= $funcionarioEditar["department"] == "Legal" ? "" : "<option value='Legal'>Legal</option>" ?>

                        <

                    </select>
                </div>

                <button>Adicionar Funcionário!</button>
            </form>
        </div>
    </section>
</body>
</html>