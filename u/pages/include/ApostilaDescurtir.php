<?php


include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados

?>
<?php
	//Faz com que todo acento vá para o banco de dados
	mysql_set_charset('utf8');
	error_reporting(0);
	$ID = $_COOKIE['ID'];
	$idApostila=$_POST['idApostilaSelecionada'];
	
	mysql_query("DELETE FROM tb_curtir_arquivo WHERE col_id_usuario = $ID AND col_id_apostila = $idApostila");

	echo "1";

 ?>
