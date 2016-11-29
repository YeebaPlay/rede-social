<center>
<div class="espaco">
<div>
	<img class="img_home" width="600" src="u/imagens/yeebameindex.png"/>      
</div><br />
<table valign="bottom" class="buscadorhome">
	<tr>
		<form action="paginas/busca/busca.php" method="GET">
			<td width="35%">
				<input class="cadastroformindex" type="text" name="busca" placeholder=" Procurar por arquivos" size="30" maxlength="30" required busca=busca />
			</td>
		<td><input class="botao_busca_index" type="submit" value="Buscar"></td>
		</form>
	</tr>
</table>
</center>
</div>
<br/>
<script language="JavaScript" >

function enviardados(){
 
	if(document.dados.senha.value != document.dados.rep_senha.value)
	{
		alert( "As senhas digitadas não são iguais" );
		document.dados.senha.focus();
		return false;
	}
	 
	return true;
}
 
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script type="text/javascript">

$(function(){
//Função que ao clicar no botão, irá fazer.
$("#cadastrar").click(function(){
//Pegando os valores que foram digitados no formulário e colocando nas variáveis nome e email.
var login = $("#login_do_usuario").val();
var senha = $("#senha").val();
var rep_senha = $("#rep_senha").val();
var nome = $("#nome").val();
var email = $("#email").val();
//Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
$.post("cadastra_usuario.php", { login:login, senha:senha, rep_senha:rep_senha, nome:nome, email:email }, function(get_retorno) {
	//Aqui coloca o valor que retono na função get_retorno dentro da div retorno, e mostra a div com efeito em slow.
	if(get_retorno == "Cadastrado com sucesso!")
	{
		window.location.assign("http://yeeba.me/u");
	}else{
		$("#retorno").show("slow").text(get_retorno);
	}
});
});
});


$(function(){
	//Função que ao clicar no botão, irá fazer.
	$("#mostrar_cadastro").click(function(){
	//Aparecer o campo de texto
	$("#formulario_de_cadastro").show("slow");
	$("#mostrar_cadastro").hide("fast");

	});
});

</script>

<div id="formularioEmail">
<center>
<div id="carregando_form" style="text-align:center; display:none;"><img src="loading_ajax.gif" width="100" /></div>

<?php
if($_COOKIE['login_usuario'] == "" and $_COOKIE['senha_usuario'] == "") {
	//Tratamento de erro
	if(isset($_GET['e'])){
		if($_GET['e'] == '_erro'){
			echo'<div id="retorno" style="font-family:Calibri, Verdana; font-size: 15px; border: 2px solid #000000; background: #B20000; text-align: center; padding: 10px 10px 10px 10px; color: #FFFFFF;">Seu e-mail j&aacute; est&aacute; cadastrado, mas n&atilde;o pelo Facebook.</div>';
		}else if($_GET['e'] == '_errof'){
			echo'<div id="retorno" style="font-family:Calibri, Verdana; font-size: 15px; border: 2px solid #000000; background: #B20000; text-align: center; padding: 10px 10px 10px 10px; color: #FFFFFF;">Erro de conex&atilde;o com Facebook.</div>';
		}else if($_GET['e'] == '_errol'){
			echo'<div id="retorno" style="font-family:Calibri, Verdana; font-size: 15px; border: 2px solid #000000; background: #B20000; text-align: center; padding: 10px 10px 10px 10px; color: #FFFFFF;">Login incorreto.</div>';
		}
		
	}
}
?>
</center>
</div>
</div><br><br>
<center><a class="" href="https://www.facebook.com/dialog/oauth?client_id=373538102706671&redirect_uri=http://yeeba.me/cadastra_usuario.php&scope=email,user_website,user_location"><div class="button_cadastrar_facebook" ><img src="imagens/face.png" width="30" valign="middle">&nbsp;&nbsp;&nbsp;Cadastrar com o Facebook</div></a></center>

