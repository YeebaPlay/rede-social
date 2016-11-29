<?php

include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados

?>
<?php
//Faz com que todo acento vá para o banco de dados
mysql_set_charset('utf8');
error_reporting(0);

	$ID = $_COOKIE['ID'];
	$NOME = $_COOKIE['NOME'];
	$email = $_COOKIE['EMAIL'];
	$FOTO = $_COOKIE['FOTO'];


	date_default_timezone_set('America/Sao_Paulo');
	$id_destino=$_POST['id_destino'];
	$email_mensagem = htmlspecialchars($_POST['email_mensagem']);
	$data = date("d/m/Y");
	$hora = date("H:i");
	
	//==================================================
	//procurar dados do usuario que receberá a mensagem
	$consultaUsuario = mysql_query("select * from dados_usuarios where Email = '$id_destino'");

	//Pega o ID do usuário
	while($linha = mysql_fetch_object($consultaUsuario)) 
		{
			$id_noti = $linha->ID;
			$nome_destinatario = $linha->Nome;
		}
	
	//variaveis para notificações
	$mensagem = ''.$email_nome_destino.' acabou de enviar uma mensagem para você.';
	date_default_timezone_set('America/Sao_Paulo');
	$hora = date("H:i");
	
	/*
	echo "Mensagem: ".$mensagem."<br />";
	echo "Hora: ".$hora."<br />";
	echo "Foto: ".$foto."<br />";
	echo "id: ".$id."<br />";
	echo "ID : ".$ID."<br />";
	echo "NOME: ".$NOME."<br />";
	*/
	
	$strSQL = "INSERT INTO notificacoes(id_destino, id_remetente, nome_remetente, mensagem, foto, hora, notifica)
	VALUES('$id_noti', '$ID', '$NOME', '$mensagem', '$FOTO', '$hora', '1')";
	mysql_query($strSQL) or die(mysql_error());
	//==================================================
	
	if($id_destino == "")
	{
		echo "Informe o E-mail.";
		exit;
	}
	
	if($email_mensagem == "")
	{
		echo "Nenhuma mensagem foi escrita.";
		exit;
	}
	
	//Verificar se existe esse e-mail
	$consulta = mysql_query("SELECT * from dados_usuarios where Email = '$id_destino'");
	$linha = mysql_num_rows($consulta);
	if($linha == 0) {
		echo "Este email não está cadastrado em nosso sistema.";
		exit;
	}
	
	$insert = "INSERT INTO tb_mensagem_nome (col_nome_destinatario, col_nome_remetente, col_email_destino, col_mensagem, col_data, col_hora, col_id_remetente, col_id_destino)
	VALUES('$nome_destinatario', '$NOME', '$id_destino', '$email_mensagem', '$data', '$hora', '$ID', '$id_noti')";
	$query = mysql_query($insert);
	echo "Mensagem enviada com sucesso!";
	

 ?>
