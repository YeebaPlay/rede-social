<?php
include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados

?>
<?php
	$ID = $_COOKIE['ID'];
    $FOTO = $_COOKIE['FOTO'];
    $NOME = $_COOKIE['NOME'];

	$nome =$_POST['nome'];
	$id =$_POST['id_adicionado'];
	$foto =$_POST['foto'];
	$curso =$_POST['curso'];
	
	//==================================================
	//variaveis para notificações
	$mensagem = ''.$NOME.' te adicionou a lista de contatos dele.';
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
	
	$strSQL = "INSERT INTO notificacoes(id_destino, id_remetente, nome_remetente, mensagem, foto, hora, notifica)
	VALUES('$id', '$ID', '$NOME', '$mensagem', '$FOTO', '$hora', '1')";
	mysql_query($strSQL) or die(mysql_error());
	//==================================================
	
	$insert = "INSERT INTO contatos(nome_membro, nome_adicionado, id_membro, id_adicionado, foto, curso)
	VALUES('$NOME', '$nome', '$ID', '$id', '$foto', '$curso')";
	$query = mysql_query($insert);
	
 ?>
