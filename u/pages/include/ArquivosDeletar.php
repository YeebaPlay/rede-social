<?php
include "../../../validar_session.php"; //Ele inclui a session para que eu tenha acesso a pessoa logada

include "../../../Config/config_sistema.php"; // Inclui minha conex�o com o banco de dados

//Faz a consulta no banco de dados procurando o usu�rio logado
$consultaUsuario = mysql_query("select * from dados_usuarios where Login = '$login_usuario'");

//Pega o ID do usu�rio
while($linha = mysql_fetch_object($consultaUsuario)) 
	{
		$ID = $linha->ID;
		$Pontos = $linha->Pontos;
	}
	
	$Pontos = $Pontos - 1;
	mysql_query("UPDATE dados_usuarios SET Pontos='$Pontos' WHERE ID='$ID'");


// recebe os dados do formulario
$codigo = $_POST['codigo'];

// deleta o usuario
$consulta = mysql_query("delete from adicionar_arquivos where id_arquivo = '".$codigo."'");


// verifica se foi excluido o usuario
if($consulta) {
	$msg = urlencode("Usu�rio excluido com sucesso!");
	echo '<script>window.location.assign("http://yeeba.me/u/meusarquivos/")</script>';
	exit;
} else {
	$erro = urlencode("N�o foi possivel excluir o contato!");
	echo '<script>window.location.assign("http://yeeba.me/u/meusarquivos/")</script>';
	exit;
}
?>