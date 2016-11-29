<?php
	 //Ele inclui a session para que eu tenha acesso a pessoa logada
	include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados
?>

<?php
	$ID = $_COOKIE['ID'];
	$idPost = $_REQUEST['id_post'];
	$consulta = mysql_query("delete from tb_post where id = '".$idPost."' AND col_id_membro = '".$ID."'");
	echo '<script>window.location.assign("../meusposts.php")</script>';
?>