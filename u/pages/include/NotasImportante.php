<?php

include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados
?>
<?php
	
	//recebe o id da nota
	$id_nota=$_REQUEST['id'];
	//Faz o update da importancia para 1
	$sql = "UPDATE notas_alunos SET importante = 1 where id = '$id_nota'";
	$consulta = mysql_query($sql);

	echo '<script>window.location.assign("../notas.php")</script>';
 ?>
