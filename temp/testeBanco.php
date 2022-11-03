<?php

//A "!" inverte o if e else (verdadeiro e falso) passa a se tornar (falso e verdadeiro)
// "!" = Diferente

$host = "localhost"; //indica o nome do servidor MySQL , pode ser pelo IP
$user = "root";
$password = "";
$database = "bdturma90"; 

/*
$link = mysqli_connect($host,$user,$password,$database);
if (!$link) {
 echo "Erro: Não foi possível connectar ao MySQL." . PHP_EOL ;
 echo "Número do erro: " . mysqli_connect_errno() . PHP_EOL;
 echo "Possível erro : " . mysqli_connect_error() . PHP_EOL;
 exit;
}
echo "Sucesso: A conexão com o MySQL foi estabelecida! " . PHP_EOL;
echo "Informação de seu host: " . mysqli_get_host_info($link) . PHP_EOL;
mysqli_close($link);

*/


function connectDB() {
    $GLOBALS['conexao'] = mysqli_connect($GLOBALS['host'],
    $GLOBALS['user'], 
    $GLOBALS['password'], 
    $GLOBALS['database']);
    
     if(!$GLOBALS['conexao']){
     printf("Falha de Conexão: %s\n", mysqli_connect_error());
     exit();
    }
    else{
        echo "Conexão realizada com sucesso" . "<br>";
    }
    }
    connectDB();
    print_r($conexao);
    echo "<br>";

?>