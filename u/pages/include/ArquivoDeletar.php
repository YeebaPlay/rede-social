<?php

include "../../../Config/config_sistema.php"; // Inclui minha conex�o com o banco de dados

$ID = $_COOKIE['ID'];
//Faz a consulta no banco de dados procurando o usu�rio logado
$consultaUsuario = mysql_query("select * from dados_usuarios where ID = '$ID'");
//Pega o Pontos do usu�rio
while($linha = mysql_fetch_object($consultaUsuario)) 
{
	$Pontos = $linha->Pontos;
}

$Pontos = $Pontos - 1;
mysql_query("UPDATE dados_usuarios SET Pontos='$Pontos' WHERE ID='$ID'");


// recebe os dados do formulario
$codigo = $_POST['codigo'];

// deleta o usuario
$consulta = mysql_query("DELETE FROM adicionar_arquivos WHERE id_arquivo = '".$codigo."'");


// verifica se foi excluido o usuario
if($consulta) {
	$msg = urlencode("Usu�rio excluido com sucesso!");
	echo '<script>window.location.assign("../arquivo.php")</script>';
	exit;
} else {
	$erro = urlencode("N�o foi possivel excluir o contato!");
	echo '<script>window.location.assign("../arquivo.php")</script>';
	exit;
}
?>