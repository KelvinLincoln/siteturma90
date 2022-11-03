<?php

//Iniciar uma Session
session_start();

//Se a session não existir, será criada
if (empty($_SESSION['lista'])) {
    $_SESSION['lista'] = [];
}

function dia_atual()
{ {
        date_default_timezone_set('America/Sao_Paulo');
        //$fuso = date_default_timezone_get();
        //echo $fuso;

        $hoje = getdate();
        //return $hoje;

        switch ($hoje["wday"]) {
            case 0:
                return "Domingo";
                break;
            case 1:
                return "Segunda";
                break;
            case 2:
                return "Terça";
                break;
            case 3:
                return "Quarta";
                break;
            case 4:
                return "Quinta";
                break;
            case 5:
                return "Sexta";
                break;
            case 6:
                return "Sabado";
                break;
            default:
                return "Valor Inválido";
                break;
        }
    }
}

function listar()
{
    echo "Espelho de Array - Apresentação didática <br>";
    echo "======================================" . "<br>";
    print_r($_SESSION['lista']);

    $qtderegistros = count($_SESSION['lista']);
    echo "Quantidade de Registros no Array = " . $qtderegistros;
    echo "<br><br>";

    echo "Tabela com dados <br>";
    echo "=====================================" . "<br>";
    echo "<br>";

    $tabela = "<table border='1'>
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Cep</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Uf</th>
                    <th>Email</th>
                    <th>Telefone</th>
                </tr>
                </thead>
                <tbody>";
    
    $retorno = $tabela;

    foreach ($_SESSION['lista'] as $linhadoarray){
        $retorno .= "<tr>";
        foreach ($linhadoarray as $coluna=>$conteudodacoluna){
            $retorno .="<td>" .$conteudodacoluna . "</td>";
        }
        $retorno .= "</tr>";
    }
    $retorno .= "</tbody></table>";
    return $retorno;
}

?>
