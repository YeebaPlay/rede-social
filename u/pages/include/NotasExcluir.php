<?php

include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados
?>
<?php
	error_reporting(0);
	//recebe o id da nota
	$id_nota=$_REQUEST['id'];
	// deleta o nota
	$consulta = mysql_query("delete from notas_alunos where id = '".$id_nota."'");
	echo '<script>window.location.assign("../notas.php")</script>';
 ?>
