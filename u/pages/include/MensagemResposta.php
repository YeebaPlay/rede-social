<?php

include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados

?>
<?php
//Faz com que todo acento vá para o banco de dados
mysql_set_charset('utf8');
error_reporting(0);

	$ID = $_COOKIE['ID'];
	$NOME = $_COOKIE['NOME'];
	$email_nome_destino = $_COOKIE['NOME'];
	$email = $_COOKIE['EMAIL'];
	$FOTO = $_COOKIE['FOTO'];

	date_default_timezone_set('America/Sao_Paulo');
	$id_destino=$_POST['id_destino'];
	$email_mensagem = htmlspecialchars($_POST['email_mensagem']);
	$id_mensagem = $_POST['id_mensagem'];
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
	$mensagem = ''.$email_nome_destino.' acabou de responder sua mensagem.';
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
	
	if($id_noti != $ID){
	$strSQL = "INSERT INTO notificacoes(id_destino, id_remetente, nome_remetente, mensagem, foto, hora, notifica)
	VALUES('$id_noti', '$ID', '$email_nome_destino', '$mensagem', '$FOTO', '$hora', '1')";
	mysql_query($strSQL) or die(mysql_error());
	}
	//==================================================
	
	if($email_mensagem == "")
	{
		echo "Nenhuma mensagem foi escrita.";
		exit;
	}
	
	$sql = mysql_query ("UPDATE tb_mensagem_nome SET  col_ultimo_envio = '$ID' WHERE id = '$id_mensagem'");

	$insert = "INSERT INTO tb_mensagem_respostas (col_id_destino, col_id_mensagem, col_nome_remetente, col_mensagem_resposta, col_data, col_hora, col_id_remetente, col_mensagem_nao_lida)
	VALUES('$id_noti', '$id_mensagem', '$NOME', '$email_mensagem', '$data', '$hora', '$ID', 1)";
	$query = mysql_query($insert);
	
	echo '
		<table border="0" cellspacing="0" cellpadding="0">
				<table class="batepapo">
					<tr>
						<td></td>
						<td></td>
						<td>'.$NOME.'</td>
					</tr>
					<tr>
						<td width="5%" valign="top" ><img class="foto-mensagem" src="../../uploads/fotos/'.$FOTO.'" width="30" height="30"/></td>
						<td width="2%"></td>
						<td width="88%" class="balao-remetente">'.$email_mensagem.'<br/><apan class="fonteDataMensagem">'.$data.' ás '.$hora.'</span></td>
						
					</tr>
				</table>
		</table>
	';

 ?>
