<?php

include "../../../Config/config_sistema.php";
$ID = $_COOKIE['ID'];
$idCurso = $_REQUEST['idPost'];

$sql = mysql_query ("SELECT id FROM tb_forum_interacoes WHERE col_id_usuario = $ID AND col_id_curso = $idCurso");
$contador = mysql_num_rows($sql);
if($contador > 0){ 
	exit;
}

if($idCurso != ""){
	// Adicionar forum no banco
	$insert = mysql_query ("INSERT INTO tb_forum_interacoes(col_id_usuario, col_id_curso)
			   			VALUES('$ID', '$idCurso')");
	
}

?>
