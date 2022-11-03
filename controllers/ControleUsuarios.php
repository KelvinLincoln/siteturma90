<?php
//Não apresentar tela com erros
//ini_set('display_errors','0');
require_once("../databases/BdTurmaConect.php");
require_once("../config/SimpleRest.php");

$page_key = "";

class UsuariosRestHandler extends SimpleRest{

    public function UsuariosIncluir(){

        if (isset($_POST["txtNome"])) {

            $nome = $_POST["txtNome"];
            $email = $_POST["txtEmail"];
            $fone = $_POST["txtFone"];
            $endereco = $_POST["txtEndereco"];
            $bairro = $_POST["txtBairro"];
            $cidade = $_POST["txtCidade"];
            $uf = $_POST["txtUF"];
            $cep = $_POST["txtCep"];

            //Informar a Stored Procedure e seus parâmetros
            $query = "CALL spIncluirUsuarios(:pnome,
                                            :pemail,
                                            :ptelefone,
                                            :pendereco,
                                            :pbairro,
                                            :pcidade,
                                            :puf,
                                            :pcep)";
            
            //Definir o conjunto de dados
            $array = array(
                ":pnome" => "{$nome}",
                ":pemail" => "{$email}",
                ":ptelefone" => "{$fone}",
                ":pendereco" => "{$endereco}",
                ":pbairro" => "{$bairro}",
                ":pcidade" => "{$cidade}",
                ":puf" => "{$uf}",
                ":pcep" => "{$cep}"
            );

            //Instanciar a classe BdTurmaConect
            $dbcontroller = new BdTurmaConect();
            //Chamar o método
            $rawData = $dbcontroller->executeProcedure($query, $array);

            //Verificar se o retorno está "vazio"
            if (empty($rawData)) {
                $statusCode = 404;
                $rawData = array('sucesso' => 0);
            } else {
                $statusCode = 200;
                $rawData = array('sucesso' => 1);
            }

            $requestContentType = $_POST['HTTP_ACCEPT'];
            //$requestContentType = 'application/json';

            $this->setHttpHeaders($requestContentType, $statusCode);
            $result["RetornoDados"] = $rawData;

            if (strpos($requestContentType, 'application/json') !== false) {
                $response = $this->encodejson($result);
                echo $response;
            }
        }
    }

    public function UsuariosConsultar(){

        if (isset($_POST["txtNome"])) {
            $nome = $_POST["txtNome"];


            //Informar a Stored Procedure e seus parâmetros
            $query = "CALL spConsultarUsuarios(:pnome)";
            
            //Definir o conjunto de dados
            $array = array(
                ":pnome" => "{$nome}",
            );

            //Instanciar a classe BdTurmaConect
            $dbcontroller = new BdTurmaConect();
            //Chamar o método
            $rawData = $dbcontroller->executeProcedure($query, $array);

            //Verificar se o retorno está "vazio"
            if (empty($rawData)) {
                $statusCode = 404;
                $rawData = array('sucesso' => 0);
            } else {
                $statusCode = 200;
    
            }

            $requestContentType = $_POST['HTTP_ACCEPT'];
            //$requestContentType = 'application/json';

            $this->setHttpHeaders($requestContentType, $statusCode);
            $result["RetornoDados"] = $rawData;

            if (strpos($requestContentType, 'application/json') !== false) {
                $response = $this->encodejson($result);
                echo $response;
            }
        }
    }

    public function UsuariosValidar() {

        if (isset($_POST["txtNomeUsuario"])) {
            $nome = $_POST["txtNomeUsuario"];
            $senha = $_POST["txtSenhaUsuario"];

            //Informar a Stored Procedure e seus parâmetros
            $query = "CALL spValidarUsuario(:pNomeUsuario,:pSenhaUsuario)";
            
            //Definir o conjunto de dados
            $array = array(":pNomeUsuario" => "{$nome}",":pSenhaUsuario" => "{$senha}");

            //Instanciar a classe BdTurmaConect
            $dbcontroller = new BdTurmaConect();
            //Chamar o método
            $rawData = $dbcontroller->executeProcedure($query, $array);

            //Verificar se o retorno está "vazio"
            if (empty($rawData)) {
                $statusCode = 404;
                $rawData = array('sucesso' => 0);
            } else {
                $statusCode = 200;
    
            }

            $requestContentType = $_POST['HTTP_ACCEPT'];
            //$requestContentType = 'application/json';

            $this->setHttpHeaders($requestContentType, $statusCode);
            $result["RetornoDados"] = $rawData;

            if (strpos($requestContentType, 'application/json') !== false) {
                $response = $this->encodejson($result);
                echo $response;
            }
        }
    }

    public function UsuariosDesconetar() {

        if (isset($_POST["txtnomecompleto"])) {
            $nome = $_POST["txtnomecompleto"];
            $email = $_POST["txtemailusuario"];

            //Informar as instruções TSQL
            $query = "UPDATE tbusuarios
                      SET logado=1
                      WHERE nomecompleto='{$nome}' and emailusuario='{$email}'";
            

            //Instanciar a classe BdTurmaConect
            $dbcontroller = new BdTurmaConect();
            //Chamar o método
            $rawData = $dbcontroller->executeQuerry($query);

            //Verificar se o retorno está "vazio"
            if (empty($rawData)) {
                $statusCode = 404;
                $rawData = array('sucesso' => 0);
            } else {
                $statusCode = 200;
    
            }

            $requestContentType = $_POST['HTTP_ACCEPT'];
            //$requestContentType = 'application/json';

            $this->setHttpHeaders($requestContentType, $statusCode);
            $result["RetornoDados"] = $rawData;

            if (strpos($requestContentType, 'application/json') !== false) {
                $response = $this->encodejson($result);
                echo $response;
            }
        }
    }

    public function encodejson($responseData)
    {
        $jsonResponse = json_encode($responseData, JSON_UNESCAPED_UNICODE);
        return $jsonResponse;
    }
}

if (isset($_GET["page_key"])) {
    $page_key = $_GET["page_key"];
} else {
    if (isset($_POST["page_key"])) {
        $page_key = $_POST["page_key"];
    }
}

switch ($page_key) {

    case "consultar":
        $Usuarios = new UsuariosRestHandler();
        $Usuarios->UsuariosConsultar();
        break;

    case "incluir":
        $Usuarios = new UsuariosRestHandler();
        $Usuarios->UsuariosIncluir();
        break;

    case "validar":
        $Usuarios = new UsuariosRestHandler();
        $Usuarios->UsuariosValidar();
        break;

        
    case "sair":
        $Usuarios = new UsuariosRestHandler();
        $Usuarios->UsuariosDesconetar();
        break;
}

?>