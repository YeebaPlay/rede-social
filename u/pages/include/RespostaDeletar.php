<?php
include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados

	$idPost = $_REQUEST['codigo'];
	$idPergunta = $_REQUEST['id_da_pergunta'];
	$consulta = mysql_query("delete from respostas where id = '".$idPost."' AND id_pergunta = '".$idPergunta."'");
	echo '<script>window.location.assign("../'.$idPergunta.'")</script>';
?>