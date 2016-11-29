<?php

include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados
?>
<?php
	error_reporting(0);
	//recebe o id da nota
	$id_nota=$_REQUEST['id_nota'];
	$nota_edita=$_REQUEST['nota'];
	$titulo_edita=$_REQUEST['titulo'];
	
	$sql = mysql_query ("UPDATE notas_alunos SET nota = '$nota_edita', titulo = '$titulo_edita' WHERE id = '$id_nota'") or die(mysql_error());
	echo '<script>window.location.assign("../notas.php")</script>';

 ?>
