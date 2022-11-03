/** Função para criar um objeto XMLHTTPRequest
*/

function CriaRequest() {
	try{
		request = new XMLHttpRequest();        
	}
	catch (IEAtual){
		try{
			request = new ActiveXObject("Msxml2.XMLHTTP");       
		}
		catch(IEAntigo){
			try{
				request = new ActiveXObject("Microsoft.XMLHTTP");          
			}
			catch(falha){
				request = false;
			}
		}
	}
	
	if (!request){ 
		alert("Seu Navegador não suporta Ajax!");
	}
	else{
		return request;
	}
}

$(document).ready(function(){

 $('#btnListar').click(function (){

    //alert ("Teste do botão");
	//Chamar o método
	ContatosConsultar();

});

$('#btnEnviar').click(function (){

    //alert ("Teste do botão");
	//Chamar o método
	ContatosIncluir();


});

$('#btnCPF').click(function (){

    //alert ("Teste do botão");
	//Chamar o método
	TestaCPF();


});

});

function TestaCPF() {
    var Soma;
    var Resto;
    Soma = 0;

	var strCPF = $('input[id=txtCPF]').val();

  if (strCPF == "00000000000") return false;

  for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);

  alert ("Soma = " + Soma);
  
  Resto = (Soma * 10) % 11;

  alert ("Soma = " + Soma + "\n" + "Resto = " + Resto);
 

    if ((Resto == 10) || (Resto == 11))  Resto = 0;

    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

  Soma = 0;

    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);

    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;

    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;

    return true;
}


function ContatosConsultar() {
//alert ('Testando o método');

//Definir variavel e atribuir valor, fazendo uso da jquery
//jQuery é uma biblioteca de funções javaScript que interage com o HTML
var strnome = $('input[id=txtNome').val();

//Definir a URN
// Ver mais em https://woliveiras.com.br/posts/url-uri-qual-diferenca/
var urn = "../contatos/listar/";

//Instanciar o objeto XMLHTTP
var xmlreq = CriaRequest();

//Iniciar uma requisição
xmlreq.open('POST', urn, true);

//Cabeçalho de Envio
xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

//atribui uma função para ser executada  sempre que houver uma mudança de readyState
	//readyState retorna o status do documento, quando este é carregado.
	xmlreq.onreadystatechange = function () {
		
		//verifica se foi concluido com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {
			
			//verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				alert(xmlreq.responseText);
			}
		}
	};

	//envio dos parametros
	xmlreq.send("txtNome="+strnome+"&HTTP_ACCEPT=application/json");

}

function ContatosIncluir() {
	//alert ('Testando o método');
	
	//Definir variavel e atribuir valor, fazendo uso da jquery
	//jQuery é uma biblioteca de funções javaScript que interage com o HTML
	var strnome = $('input[id=txtNome').val();
	var strnascimento = $('input[id=txtNascimento').val();
	var strcpf = $('input[id=txtCpf').val();
	var strcep = $('input[id=txtCep').val();
	var strendereco = $('input[id=txtEndereco').val();
	var strbairro = $('input[id=txtBairro').val();
	var strcidade = $('input[id=txtCidade').val();
	var struf = $('input[id=txtUF').val();
	var stremail = $('input[id=txtEmail').val();
	var strfone = $('input[id=txtFone').val();

	
	//Definir a URN
	// Ver mais em https://woliveiras.com.br/posts/url-uri-qual-diferenca/
	var urn = "../contatos/incluir/";
	
	//Instanciar o objeto XMLHTTP
	var xmlreq = CriaRequest();
	
	//Iniciar uma requisição
	xmlreq.open('POST', urn, true);
	
	//Cabeçalho de Envio
	xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	//atribui uma função para ser executada  sempre que houver uma mudança de readyState
	//readyState retorna o status do documento, quando este é carregado.
	xmlreq.onreadystatechange = function () {
		
		//verifica se foi concluido com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {
			
			//verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				alert(xmlreq.responseText);
			}
		}
	};

	//envio dos parametros
	//Sinal de Adição (+) representa a concatenação (junção de conteúdo)
	xmlreq.send("txtNome="+strnome+
				"txtNascimento="+strnascimento+
				"txtCpf="+strcpf+
				"txtCep="+strcep+
				"txtEndereco="+strendereco+
				"txtBairro="+strbairro+
				"txtCidade="+strcidade+
				"txtUF="+struf+
				"txtEmail="+stremail+
				"txtFone="+strfone+
				"&HTTP_ACCEPT=application/json");
	
	}