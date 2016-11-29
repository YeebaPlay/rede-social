<?php

include "../../../Config/config_sistema.php";

$ID = $_COOKIE['ID'];

$idForum = $_REQUEST['idForum'];


$delete = "DELETE FROM tb_forum_interacoes WHERE id=$idForum AND col_id_usuario = $ID";
$query = mysql_query($delete);

echo 'deletado';
?>