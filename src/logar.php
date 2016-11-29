<?php
// inclui o arquiv o de configuração do sistema
include "../Config/config_sistema.php";



session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['code'])){
  // Informe o seu App ID abaixo
  $appId = '373538102706671';
  // Digite o App Secret do seu aplicativo abaixo:
  $appSecret = '682b31d68faf2999e0e00d182b9c5bbc';
  // Url informada no campo "Site URL"
  $redirectUri = urlencode('http://yeebaplay.com.br/src/logar.php');

  // Obtém o código da query string
  $code = $_GET['code'];
  // Monta a url para obter o token de acesso e assim obter os dados do usuário
  $token_url = "https://graph.facebook.com/oauth/access_token?"
  . "client_id=" . $appId . "&redirect_uri=" . $redirectUri
  . "&client_secret=" . $appSecret . "&code=" . $code;

  //pega os dados
  $response = @file_get_contents($token_url);

  if($response){
    $params = null;
    parse_str($response, $params);
    if(isset($params['access_token']) && $params['access_token']){
      $graph_url = "https://graph.facebook.com/me?access_token="
      . $params['access_token'];
      $user = json_decode(file_get_contents($graph_url));

    // nesse IF verificamos se veio os dados corretamente
      if(isset($user->email) && $user->email){

		    /*
		    *Apartir daqui, você já tem acesso aos dados usuario, podendo armazená-los
		    *em sessão, cookie ou já pode inserir em seu banco de dados para efetuar
		    *autenticação.
		    *No meu caso, solicitei todos os dados abaixo e guardei em sessões.
		    */

 			//Dados necessarios para logar
	        $emailUsuario = $user->email;
	        $idSenhaUsuario = $user->id;

	        $idSenhaUsuario = md5($idSenhaUsuario);
	       
	        $consultaEmail = mysql_query("select * from dados_usuarios where Email='$emailUsuario' AND Senha = '$idSenhaUsuario'");
			//Conta quantos resultados obteve do Login e do Email sendo que apenas um vai dar TRUE
			$camposEmail = mysql_num_rows($consultaEmail);

			// verifica se o usuario foi cadastrado
			if($camposEmail) 
			{
				while($linha = mysql_fetch_array($consultaEmail))
				{
					$login = $linha['Login'];
					$senha = $linha['Senha'];
				}
				setcookie('login_usuario', $login, time()+60*60*24*365);
				setcookie('senha_usuario', $senha, time()+60*60*24*365);
				GuardarDadosSessao($login);
				
				//Finaliza o cadastro e redireciona
				echo '<script>window.location.assign("http://yeebaplay.com.br/u")</script>';
				echo "Cadastrado com sucesso!";
				exit;
			} else {
				echo "Falha no cadastro, 
					  tente mais tarde pode ser um problema no servidor!";
				echo '<script>window.location.assign("http://yeebaplay.com.br/?e=_erro")</script>';
				exit;
			}
      }
    }else{
      echo "Erro de conexão com Facebook";
      echo '<script>window.location.assign("http://yeebaplay.com.br/?e=_errof")</script>';
      exit(0);
    }

  }else{
    echo "Erro de conexão com Facebook";
    echo '<script>window.location.assign("http://yeebaplay.com.br/?e=_errof")</script>';
    exit(0);
  }
}else if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['error'])){
  echo 'Permissão não concedida';
}else{
	// reccebe dados do formulario
	$login = $_POST['login_logar'];
	$senha = md5($_POST['senha_logar']);

	//Faz consulta do Login e do Email
	$consulta = mysql_query("select * from dados_usuarios where Login='$login'");
	$consultaEmail = mysql_query("select * from dados_usuarios where Email='$login'");
	//Conta quantos resultados obteve do Login e do Email sendo que apenas um vai dar TRUE
	$camposEmail = mysql_num_rows($consultaEmail);
	$campos = mysql_num_rows($consulta);
	// verifica se o Email existe
	if($camposEmail != 0){
		while($linha = mysql_fetch_array($consultaEmail))
		{
			$login = $linha['Login'];
		}
					
		// se o usuario existi verifica a senha dele
		if($senha != mysql_result($consultaEmail,0,"Senha")) {
			//header("Location: index.php");
			echo "Senha incorreta!";
			echo '<script>window.location.assign("http://yeebaplay.com.br/?e=_errol")</script>';
			exit;
		} else {
			// estiver tudo certo vamos ver se ele é o administrador
			if($login == $login_admin) {
				// se for o login do administrador vamos verificar a senha dele
				// se é igual a do administrado
				if($senha == $senha_admin) {
					// se for o administrador vomos criar a sessão
					//session_start();
					//$_SESSION['login_usuario'] = $login;
					//$_SESSION['senha_usuario'] = $senha;
				
					GuardarDadosSessao($login, $senha);
					// redireciona o link para uma outra pagina
					header("Location: Admin/listar_usuarios.php");
					
				}
			} else {
				// se o login não for do administrado vamos criar a sessão dele
				//session_start();
				//$_SESSION['login_usuario'] = $login;
				//$_SESSION['senha_usuario'] = $senha;
				
				GuardarDadosSessao($login, $senha);
				// redireciona o link para uma outra pagina
				header("Location: u/pages/index.php");
			}
		}
	}else {

		if($campos != 0) {
		// se o usuario existi verifica a senha dele
			if($senha != mysql_result($consulta,0,"Senha")) {
				//header("Location: index.php");
				echo "Senha incorreta!";
				echo '<script>window.location.assign("http://yeebaplay.com.br/?e=_errol")</script>';
				exit;
			} else {
				// estiver tudo certo vamos ver se ele é o administrador
				if($login == $login_admin) {
					// se for o login do administrador vamos verificar a senha dele
					// se é igual a do administrado
					if($senha == $senha_admin) {
						// se for o administrador vomos criar a sessão
						//session_start();
						//$_SESSION['login_usuario'] = $login;
						//$_SESSION['senha_usuario'] = $senha;
						
						GuardarDadosSessao($login, $senha);
					
						// redireciona o link para uma outra pagina
						header("Location: Admin/listar_usuarios.php");
						
					}
				} else {
					// se o login não for do administrado vamos criar a sessão dele
					//session_start();
					//$_SESSION['login_usuario'] = $login;
					//$_SESSION['senha_usuario'] = $senha;
					
					GuardarDadosSessao($login, $senha);
					// redireciona o link para uma outra pagina
					header("Location: ../u/pages/index.php");
				}
			}
		} else {
			echo '<script>window.location.assign("http://yeebaplay.com.br/?e=_errol")</script>';
			exit;
		}
	}
}

function GuardarDadosSessao ($login, $senha){
	//Faz a consulta no banco de dados procurando o usuário logado
	$consultaUsuario = mysql_query("select * from dados_usuarios where Login = '$login'");

	//Pega o ID do usuário
	while($linha = mysql_fetch_object($consultaUsuario))
    {
        $ID = $linha->ID;
        $CURSO = $linha->curso;
        $FOTO = $linha->Foto;
        $SOBRE = $linha->Sobre;
        $PONTOS = $linha->Pontos;
        $EMAIL = $linha->Email;
        $NOME = $linha->Nome;
        $face = $linha->Facebook;
		$tw = $linha->Twitter;
		$CIDADE = $linha->Cidade;
		$ESTADO = $linha->Estado;
		$PAIS = $linha->Pais;
    }

    //Armazena tudo em cookies para acessar em qualquer parte do sistema
    
	setcookie('ID', $ID, time()+60*60*24*365);
	setcookie('CURSO', $CURSO, time()+60*60*24*365);
	setcookie('SOBRE', $SOBRE, time()+60*60*24*365);
	setcookie('FOTO', $FOTO, time()+60*60*24*365);
	setcookie('PONTOS', $PONTOS, time()+60*60*24*365);
	setcookie('EMAIL', $EMAIL, time()+60*60*24*365);
	setcookie('NOME', $NOME, time()+60*60*24*365);
	setcookie('FACEBOOK', $face, time()+60*60*24*365);
	setcookie('TWITTER', $tw, time()+60*60*24*365);
	setcookie('CIDADE', $CIDADE, time()+60*60*24*365);
	setcookie('ESTADO', $ESTADO, time()+60*60*24*365);
	setcookie('PAIS', $PAIS, time()+60*60*24*365);

	setcookie('login_usuario', $login, time()+60*60*24*365);
	setcookie('senha_usuario', $senha, time()+60*60*24*365);

	$_SESSION["LOGIN"] = $login;
	$_SESSION["SENHA"] = $senha;


}
?>