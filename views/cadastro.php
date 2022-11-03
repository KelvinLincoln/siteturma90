<?php
if (isset($_POST["btnEnviar"])) {
    
$nome = $_POST["txtNome"];

echo $nome . " Cadastrado com sucesso!!";
} elseif (isset($_POST['btnListar'])) {
    print_r($_POST);
}

?>