<?php

include "../../../Config/config_sistema.php";

$id_destino = $_REQUEST['id'];

// faz consulta para atualizar os dados
$sql = "UPDATE notificacoes SET notifica = 0 where id_destino = '$id_destino'";
$consulta = mysql_query($sql);

// verifica se foi atualizado os dados
if($consulta) {
	echo "Limpinho";
	//echo '<script>window.location.assign("http://yeeba.me/u/eu/")</script>';
	exit;
} else {
	echo "Vish, parece que algo deu errado.";
		  //echo '<script>window.location.assign("http://yeeba.me/u/eu/")</script>';
	exit;
}
?>