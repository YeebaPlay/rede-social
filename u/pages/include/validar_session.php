<?php

// inclui o arquivo de configura��o do sistema
include "../../Config/config_sistema.php";
error_reporting(0);

// verifica se a variavel existir
if(isset($_COOKIE['login_usuario']) && isset($_COOKIE['senha_usuario'])) {
	// se existie as sess�es coloca os valores em uma varivel
	$login_usuario = $_COOKIE['login_usuario'];
	$senha_usuario = $_COOKIE['senha_usuario']; 
} else {
	echo $erro = urlencode("Voc� n�o esta logado!");
	echo '<script>window.location.assign("../../")</script>';
	exit;
}

// verifica se as variaveis est�o atribuidas
if(!(empty($login_usuario) or empty($senha_usuario))) {
	// se estiverem atribuidos vamos ver se existe o login
	$consulta = mysql_query("select * from dados_usuarios where Login = '$login_usuario'");
	if(mysql_num_rows($consulta) == 1) {
		// se o usuario existir vamos verificar a senha
		if($senha_usuario != mysql_result($consulta,0,"Senha")) {
			// se a senha est� correta vamos apagar a
			// sess�o que existia mas erra a errada
			unset($_COOKIE['login_usuario']);
			unset($_COOKIE['senha_usuario']);
			
			$erro = urlencode("Voc� n�o esta logado!");
			echo '<script>window.location.assign("../../")</script>';
			exit;
		}
	} else {
		unset($_COOKIE['login_usuario']);
		unset($_COOKIE['senha_usuario']);
		
		$erro = urlencode("Voc� n�o esta logado!");
		echo '<script>window.location.assign("../../")</script>';
		exit;
	}
} else {
	// caso as sess�es estarem vaizias
	$erro = urlencode("Voc� n�o esta logado!");
	echo '<script>window.location.assign("../../")</script>';
	exit;
}
mysql_close($conn);
?>