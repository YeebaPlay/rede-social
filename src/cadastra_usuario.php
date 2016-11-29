<?php

// inclui o arquivo de configura��o do sistema
include "../Config/config_sistema.php";

error_reporting(0);
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['code'])){
  // Informe o seu App ID abaixo do facebook
  $appId = 'ID';
  // Digite o App Secret do seu aplicativo abaixo:
  $appSecret = 'SECRET';
  // Url informada no campo "Site URL"
  $redirectUri = urlencode('http://yeebaplay.com.br/yeeba/src/cadastra_usuario.php');

  // Obt�m o c�digo da query string
  $code = $_GET['code'];
  // Monta a url para obter o token de acesso e assim obter os dados do usu�rio
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
    *Apartir daqui, voc� j� tem acesso aos dados usuario, podendo armazen�-los
    *em sess�o, cookie ou j� pode inserir em seu banco de dados para efetuar
    *autentica��o.
    *No meu caso, solicitei todos os dados abaixo e guardei em sess�es.
    */
 
        $emailUsuario = $user->email;
        $nomeUsuario = $user->name;
        $cidade = $user->location->name;
        $idSenhaUsuario = $user->id;
        $urlPerfil = $user->link;
        //$foto = "http://graph.facebook.com/".$idSenhaUsuario."/picture?type=large";

        //baixar imagem para o servidor

        # Caminho da imagem a ser redimensionada: 
		$input_image = "http://graph.facebook.com/".$idSenhaUsuario."/picture?type=large";
		 
		// Pega o tamanho original da imagem e armazena em um Array:
		$size = getimagesize( $input_image );
		 
		// Configura a nova largura da imagem:
		$thumb_width = "200";
		 
		// Calcula a altura da nova imagem para manter a propor��o na tela: 
		$thumb_height = ( int )(( $thumb_width/$size[0] )*$size[1] );
		 
		// Cria a imagem com as cores reais originais na mem�ria.
		$thumbnail = ImageCreateTrueColor( $thumb_width, $thumb_height );
		 
		// Criar� uma nova imagem do arquivo.
		$src_img = ImageCreateFromJPEG( $input_image );
		 
		// Criar� a imagem redimensionada:
		ImageCopyResampled( $thumbnail, $src_img, 0, 0, 0, 0, $thumb_width, $thumb_height, $size[0], $size[1] );
		 
		// Informe aqui o novo nome da imagem e a localiza��o:
		$nomeArquivoFoto = "yeeba_".date('dmy').time().".jpg";
		ImageJPEG( $thumbnail, "../uploads/fotos/".$nomeArquivoFoto."");
		 
		// Limpa da memoria a imagem criada tempor�riamente: 
		ImageDestroy( $thumbnail );

        //------------------------------

        $consultaEmail = mysql_query("select * from dados_usuarios where Email = '$emailUsuario'");
		//Verifica se existe email cadastrado
		$linhaEmail = mysql_num_rows($consultaEmail);
		if($linhaEmail != 0) {
			echo 'Email existente em nosso sistema! - Cadastre outro.';
			echo '<script>window.location.assign("https://www.facebook.com/dialog/oauth?client_id=ID&redirect_uri=http://yeebaplay.com.br/yeeba/u/pages/logar.php&scope=email,user_website,user_location")</script>';
			exit;
		}

        //Criptografando senha
        $idSenhaUsuario = md5($idSenhaUsuario);
        //Capturar o dia e hora que o usu�rio fez cadastro.
		date_default_timezone_set('America/Sao_Paulo');
		$data = date("d/m/Y");
		$hora = date("H:i");

		// faz consulta no banco para inserir os dados do usuario
		$sql = "INSERT INTO dados_usuarios (ID, Login, Senha, Nome, Email, Foto, data_inicio, hora_inicio, curso, Cidade, ID_Facebook) 
		values ('', '$emailUsuario', '$idSenhaUsuario', '$nomeUsuario', '$emailUsuario', '$nomeArquivoFoto', '$data', '$hora', 'Geral', '$cidade', '1')";
		$consulta = mysql_query($sql);

		// verifica se o usuario foi cadastrado
		if($consulta) {
			setcookie('login_usuario', $emailUsuario, time()+60*60*24*365);
			setcookie('senha_usuario', $idSenhaUsuario, time()+60*60*24*365);
			//Finaliza o cadastro e redireciona
			echo '<script>window.location.assign("http://yeebaplay.com.br/yeeba/u/pages/explorar.php")</script>';
			echo "Cadastrado com sucesso!";
			exit;
		} else {
			echo "Falha no cadastro, 
				  tente mais tarde pode ser um problema no servidor!";
				  //echo '<script>window.location.assign("http://yeebaplay.com.br/yeeba/?e=_errof")</script>';
			exit;
		}
      }
    }else{
      echo "Erro de conexao com Facebook 1";
      //echo '<script>window.location.assign("http://yeebaplay.com.br/yeeba/?e=_errof")</script>';
      exit(0);
    }

  }else{
    echo "Erro de conexao com Facebook 2";
    //echo '<script>window.location.assign("http://yeebaplay.com.br//yeeba/?e=_errof")</script>';
    exit(0);
  }
}else if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['error'])){
  echo 'Permissao nao concedida';
  //echo '<script>window.location.assign("http://yeebaplay.com.br/yeeba/?e=_errof")</script>';
}else{

	//Caso n�o v� se cadastrar com o Facebook ele vem para essa parte
	// recebe dados do formulario
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	$rep_senha = $_POST['rep_senha'];
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$foto = "logon.jpg";


	// verifica se o usuario digitou o login
	if($login == "") {
		echo "Digite seu login!";
		exit;
	} else {
		// se o usuario digitou o login ele verifica
		// se esta disponivel
		$consulta = mysql_query("select * from dados_usuarios where Login = '$login'");
		$consultaEmail = mysql_query("select * from dados_usuarios where Email = '$email'");
		//Verifica se existe email cadastrado
		$linhaEmail = mysql_num_rows($consultaEmail);
		if($linhaEmail != 0) {
			echo 'Email existente em nosso sistema! - Cadastre outro.';
			exit;
		}
		//Verifica se existe Login cadastrado
		$linha = mysql_num_rows($consulta);
		if($linha != 0) {
			echo 'Login existente em nosso sistema! - Cadastre outro.';
			exit;
		}
	}

	// verifica se o usuario digitou a senha
	if($senha == "") {
		echo "Digite sua senha!";
		exit;
	} else {
		// se o usuario digitou a senha
		// vamos comparar com a contra senha
		if($senha != $rep_senha) {
			echo "Senhas diferentes!";
			exit;
		}
	}

	// verifica se o usuario digitou o nome
	if($nome == "") {
		echo "Digite seu nome!";
		exit;
	}

	// verifica o email
	if($email == "") {
		echo "Digite o seu e-mail!";
		exit;
	}

	//Verificar se o e-mail passa
	if( preg_match("#^([\w\.-]+)\@([\w\.-]+)+\.([a-z]{2,6})$#",$email)){
	 
	}else{
	 echo "Digite realmente o seu e-mai";
	 exit;
	}


	//===================================================
	//Enviar e-mail
	$headers = "MIME-Version: 1.1\r\n";
	$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
	$headers .= "From: yeebame@gmail.com\r\n"; // remetente
	$headers .= "Return-Path: yeebame@gmail.com\r\n"; // return-path
	$msg = '<b>'.$nome.', seja bem vindo ao Yeeba.me</b><br /> Caso tenha alguma d�vida mande um e-mail para yeebame@gmail.com <br /><br /> 
	==================================== <br /><br />  ..::Dados de cadastro::..<br /> Login: '.$login.'<br /> Senha: '.$senha.'';
	$envio = mail($email, 'Cadastro Yeeba.me', $msg, $headers);

	//if($envio)
	 //echo '<script>window.location.assign("http://yeeba.me/")</script>';
	//else
	 //echo '<script>window.location.assign("http://yeeba.me/")</script>';

	//===================================================
	 
	//Criptografando senha 
	$senha = md5($senha);
	//Capturar o dia e hora que o usu�rio fez cadastro.
	date_default_timezone_set('America/Sao_Paulo');
	$data = date("d/m/Y");
	$hora = date("H:i");

	// faz consulta no banco para inserir os dados do usuario
	$sql = "INSERT INTO dados_usuarios (ID, Login, Senha, Nome, Email, Foto, data_inicio, hora_inicio, curso) 
	values ('', '$login', '$senha', '$nome', '$email', '$foto', '$data', '$hora', 'Geral')";
	$consulta = mysql_query($sql);

	// verifica se o usuario foi cadastrado
	if($consulta) {
		setcookie('login_usuario', $login, time()+60*60*24*365);
		setcookie('senha_usuario', $senha, time()+60*60*24*365);
		echo "Cadastrado com sucesso!";
		exit;
	} else {
		echo "Falha no cadastro, 
			  tente mais tarde pode ser um problema no servidor!";
		exit;
	}

}

?>