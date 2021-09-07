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

function registrarFuncionario ($arquivoJson, $idFuncionario, $firstName, $lastName, $email, $gender, $ipAddress, $country, $department)
{
    //pega o arquivo JSON e transforma em array
        $jsonArray = json_decode($arquivoJson);
    
    //adiciona na ultima posição do array o novo funcionário
        //$funcionario = 
        $jsonArray [0] =
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

        //$jsonArray[0]=$funcionario;

    //transforma o array em JSON
        //$funcionarioJson = json_encode($jsonArray);
        $jsonFinal = json_encode($jsonArray);

    //abre o arquivo JSON para edição
        $arquivoEditar = fopen($arquivoJson, "a");

    //escreve no arquivo json
        fwrite($arquivoEditar, $jsonFinal);

    //fecha o arquivo
        fclose($arquivoEditar);
}
