<?php
	include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados

	$ID = $_COOKIE['ID'];

	// recebe os dados do formulario
	$codigo = $_POST['codigo'];
	$tipo = $_POST['tipo'];

	//Se for igual a 1 remetente, se for igual a 0 destinatario
	if($tipo == 1){
		$consulta = mysql_query("UPDATE tb_mensagem_nome SET col_mensagem_apagada_remetente = 1 WHERE id = '".$codigo."'");
	}else {
		$consulta = mysql_query("UPDATE tb_mensagem_nome SET col_mensagem_apagada_destino = 1 WHERE id = '".$codigo."'");
	}


	// verifica se foi excluido o usuario
	if($consulta) {
		echo '<script>window.location.assign("../mensagem.php")</script>';
		exit;
	} else {
		echo '<script>window.location.assign("../mensagem.php")</script>';
		exit;
	}
?>