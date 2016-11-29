<?php
	include "../../../Config/config_sistema.php";

	$ID = $_COOKIE['ID'];

	$pais = $_REQUEST['pais'];
	$estado = $_REQUEST['estado'];
	$cidade = $_REQUEST['cidade'];
	$nome = $_REQUEST['nome'];
	$curso = $_REQUEST['curso'];
	$descricao = $_REQUEST['descricao'];
	$facebook = $_REQUEST['facebook'];
	$twitter = $_REQUEST['twitter'];

	// faz consulta para atualizar os dados
	$sql = "UPDATE dados_usuarios SET Pais = '$pais',Estado = '$estado',Cidade = '$cidade',Nome = '$nome', curso = '$curso', Facebook = '$facebook', Twitter = '$twitter', Sobre = '$descricao' WHERE ID = '$ID'";
	$consulta = mysql_query($sql);

	//======= Atualizar Cookie ============================

	setcookie('CURSO', $curso, time()+60*60*24*365);
	setcookie('SOBRE', $descricao, time()+60*60*24*365);
	setcookie('NOME', $nome, time()+60*60*24*365);
	setcookie('FACEBOOK', $facebook, time()+60*60*24*365);
	setcookie('TWITTER', $twitter, time()+60*60*24*365);
	setcookie('CIDADE', $cidade, time()+60*60*24*365);
	setcookie('ESTADO', $estado, time()+60*60*24*365);
	setcookie('PAIS', $pais, time()+60*60*24*365);

	//=====================================================

	// verifica se foi atualizado os dados
	if($consulta) {
		$msg = urlencode("");
		echo '<script>window.location.assign("../config.php")</script>';
		exit;
	} else {
		echo "<font color=red><b>
			  Não foi possivel atualizar os dados!<br>
			  Click <a href=dados_usuarios.php>aqui</a> para retornar!
			  </font></b>";
			 echo '<script>window.location.assign("../config.php")</script>';
		exit;
	}
?>