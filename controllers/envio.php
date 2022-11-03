<?php

//Include, require, include_once, require_once
require_once("../functions/funcoes.php");

//isset verifica se algo foi configurado
if (isset($_POST["btnEnviar"])) {
    
    $nome = $_POST["txtNome"];
    
    echo $nome . " Cadastrado com sucesso!!";
    
    

// Declaração e atribuição de variáveis
$nome = $_POST["txtNome"];
$email = $_POST['txtEmail'];
$fone = $_POST['txtFone'];
$cpf = $_POST['txtCpf'];
$endereco = $_POST['txtEndereco'];
$bairro = $_POST['txtBairro'];
$cidade = $_POST['txtCidade'];
$uf = $_POST['txtUF'];
$cep = $_POST['txtCep'];

//Definir o conjunto de dados
$array = [" nome " => "{$nome}", " cep " => "{$cep}", " Endereço " => "{$endereco}", " Bairro " => "{$bairro}", " Cidade " => "{$cidade}", " UF " => "{$uf}", " Email " => "{$email}", " Telefone " => "{$fone}"];

array_push($_SESSION['lista'], $array);

$body = "===================================" . "<br>";
echo $body;
$body = "FALE CONOSCO - TESTE EXIBIÇÃO" . "<br>";
$body = $body . "===================================" . "<br>";
echo $body;
echo "Nome: " . $nome . "<br>";
echo "Email: " . $email . "<br>";

if (isset($_POST["txtNome"])) {
    $fone = $_POST['txtFone'];
    $cep = $_POST['txtCep'];
    echo "Telefone: " . $fone . "<br>";
    $body = "===================================" . "<br>";
    echo $body;

    //$num = 1;
    //$num /=2;
    //echo $num;

    //Função com return precisa de variável
    //$Variável = Função();
    $dia = dia_atual();
    echo $dia . "<br>";

    $hora = date('H:i:s');
    echo $hora . "<br>";

    if (($hora >= "00:00:00") && ($hora <= "11:59:59")) {
        echo "Bom dia !!";
    } else if (($hora >= "12:00:00") && ($hora <= "17:59:59")) {
        echo "Bom tarde !!";
    } else {
        echo "Boa Noite !!";
    }
}
}else if (isset($_POST["btnListar"])) {
    $exibirdados = listar();
   echo $exibirdados;
    
}


?>