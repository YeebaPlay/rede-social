<?php

//@session_start();

// inclui o arquivo de configuração do sistema
include "Config/config_sistema.php";

// verifica se a variavel existir
if(isset($_COOKIE['login_usuario']) and isset($_COOKIE['senha_usuario'])) {
	// se existie as sessões coloca os valores em uma varivel
	$login_usuario = $_COOKIE['login_usuario'];
	$senha_usuario = $_COOKIE['senha_usuario'];
	
} else {
	
}

// verifica se as variaveis estão atribuidas
if(!(empty($login_usuario) or empty($senha_usuario))) {
	// se estiverem atribuidos vamos ver se existe o login
	$consulta = mysql_query("select * from dados_usuarios where Login = '$login_usuario'");
	if(mysql_num_rows($consulta) == 1) {
		// se o usuario existir vamos verificar a senha
		if($senha_usuario != mysql_result($consulta,0,"Senha")) {
			// se a senha está correta vamos apagar a
			// sessão que existia mas erra a errada
			unset($_COOKIE['login_usuario']);
			unset($_COOKIE['senha_usuario']);
		
		}
	} else {
		unset($_COOKIE['login_usuario']);
		unset($_COOKIE['senha_usuario']);
		
	}
} else {
	
	//echo '<script>window.location.assign("../u")</script>';
	
}
mysql_close($conn);
?>