<?php
	include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados

?>
<?php
	//Faz com que todo acento vá para o banco de dados
	mysql_set_charset('utf8');
	
    $ID = $_COOKIE['ID'];
    $FOTO = $_COOKIE['FOTO'];
    $NOME = $_COOKIE['NOME'];
	
	$id = $_POST['id_adicionado'];
	
	//==================================================
	//variaveis para notificações
	$mensagem = ''.$NOME.' te removeu da lista de contatos dele.';
	date_default_timezone_set('America/Sao_Paulo');
	$hora = date("H:m");
	
	/*
	echo "Mensagem: ".$mensagem."<br />";
	echo "Hora: ".$hora."<br />";
	echo "Foto: ".$foto."<br />";
	echo "id: ".$id."<br />";
	echo "ID : ".$ID."<br />";
	echo "NOME: ".$NOME."<br />";
	*/
	//==================================================
	
	$consultaUsuario = mysql_query("DELETE FROM contatos WHERE id_membro = '$ID' AND id_adicionado = '$id'");

	$strSQL = "INSERT INTO notificacoes(id_destino, id_remetente, nome_remetente, mensagem, foto, hora, notifica)
	VALUES('$id', '$ID', '$NOME', '$mensagem', '$FOTO', '$hora', '1')";
	
	mysql_query($strSQL) or die(mysql_error());

 ?>
