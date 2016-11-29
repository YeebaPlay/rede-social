<?php

include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados

?>
<?php
	//Faz com que todo acento vá para o banco de dados
	mysql_set_charset('utf8');
	error_reporting(0);
	$ID = $_COOKIE['ID'];
	$idApostila=$_POST['idApostilaSelecionada'];
	
	
	$strSQL = "INSERT INTO tb_curtir_arquivo(col_id_usuario, col_id_apostila)
	VALUES('$ID', '$idApostila')";
	mysql_query($strSQL) or die(mysql_error());

	echo "1";

 ?>
