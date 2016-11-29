<?php

include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados

$ID = $_COOKIE['ID'];
//Faz a consulta no banco de dados procurando o usuário logado
$consultaUsuario = mysql_query("select * from dados_usuarios where ID = '$ID'");
//Pega o Pontos do usuário
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
	$msg = urlencode("Usuário excluido com sucesso!");
	echo '<script>window.location.assign("../arquivo.php")</script>';
	exit;
} else {
	$erro = urlencode("Não foi possivel excluir o contato!");
	echo '<script>window.location.assign("../arquivo.php")</script>';
	exit;
}
?>