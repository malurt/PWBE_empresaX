<?php
function lerAquivo($nomeArquivo)
{
    //aqui só transdformamos em String
    $arquivo = file_get_contents($nomeArquivo);

    //aqui a String se torna Array
    $jsonArray = json_decode($arquivo);

    //devolve o array pra quem chamou
    return $jsonArray;
}

function contarFuncionariosTotal($listaFuncionarios)
{
    $numeroTotalFuncionarios = 0;
    foreach($listaFuncionarios as $funcionario) //procura na lista toda
    {
        $numeroTotalFuncionarios++;
    }
    return $numeroTotalFuncionarios;
}

// busca aluno e devolve a lista com os alunos
function buscarFuncionario($listaFuncionarios, $palavraChavePesquisa)
{
    $funcionariosFiltro = [];

    foreach($listaFuncionarios as $funcionario) //procura na lista toda
    {
        if(mb_strpos(strtoupper($funcionario->first_name), strtoupper($palavraChavePesquisa)) !== false)//se achar
        {
            $funcionariosFiltro [] = $funcionario;// guarda o nome na lista de encontrados
        }
        elseif(mb_strpos(strtoupper($funcionario->last_name), strtoupper($palavraChavePesquisa)) !== false)
        {
            $funcionariosFiltro [] = $funcionario;
        }
        elseif(mb_strpos(strtoupper($funcionario->department), strtoupper($palavraChavePesquisa)) !== false)
        {
            $funcionariosFiltro [] = $funcionario;
        }
        elseif(mb_strpos(strtoupper($funcionario->country), strtoupper($palavraChavePesquisa)) !== false)
        {
            $funcionariosFiltro [] = $funcionario;
        }
    }

    return $funcionariosFiltro;//ao fim da pesquisa, retorna todos os alunos encontrados
}

function registrarFuncionario ($arquivoArray, $idFuncionario, $firstName, $lastName, $email, $gender, $ipAddress, $country, $department)
{    
    //adiciona na ultima posição do array o novo funcionário
    $arquivoArray [] =
    [
        "id" => $idFuncionario,
        "first_name" => $firstName,
        "last_name" => $lastName,
        "email" => $email,
        "gender" => $gender,
        "ip_address" => $ipAddress,
        "country" => $country,
        "department" => $department
    ];

    //transforma o array em JSON
        $jsonFinal = json_encode($arquivoArray);

    //envia o conteúdo para o arquivo
        file_put_contents("empresaX.json", $jsonFinal);

}


function apagarFuncionario($nomeArquivo, &$arrayFuncionarios, $idFuncionario)
{
    foreach($arrayFuncionarios as $chave => $funcionario)
    {
        if($funcionario->id == $idFuncionario)
        {
            unset($arrayFuncionarios[$chave]);

            $json = json_encode($arrayFuncionarios);

            file_put_contents($nomeArquivo, $json);
        }
    }
}

function editarFuncionario($nomeArquivo, &$arrayFuncionarios, $funcionarioEditado)
{
    foreach($arrayFuncionarios as $chave => $funcionario)
    {
        if($funcionario->id == $funcionarioEditado["id"])
        {
            $arrayFuncionarios[$chave] = $funcionarioEditado;

            $json = json_encode($arrayFuncionarios);

            file_put_contents($nomeArquivo, $json);
        }
    }
}