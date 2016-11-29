
<?php
if($_COOKIE['login_usuario'] == "" and $_COOKIE['senha_usuario'] == "") {
    //Tratamento de erro
    if(isset($_GET['e'])){
        if($_GET['e'] == '_erro'){
            echo'<div id="retorno" style="font-family:Calibri, Verdana; font-size: 15px; border: 2px solid #000000; background: #B20000; text-align: center; padding: 10px 10px 10px 10px; color: #FFFFFF;">Seu e-mail j&aacute; est&aacute; cadastrado, mas n&atilde;o pelo Facebook.</div>';
        }else if($_GET['e'] == '_errof'){
            echo'<div id="retorno" style="font-family:Calibri, Verdana; font-size: 15px; border: 2px solid #000000; background: #B20000; text-align: center; padding: 10px 10px 10px 10px; color: #FFFFFF;">Erro de conex&atilde;o com Facebook.</div>';
        }else if($_GET['e'] == '_errol'){
            echo'<div id="retorno" style="font-family:Calibri, Verdana; font-size: 15px; border: 2px solid #000000; background: #B20000; text-align: center; padding: 10px 10px 10px 10px; color: #FFFFFF;">Login incorreto.</div>';
        }
    }
}
?>
<header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo"></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
            <li>
                <div style="display: none;" id="login">  
                    <form action="u/pages/logar.php" method="POST" name="formlogin">
                        <input placeholder=" Login ou e-mail" class="cadastroformmenor" type="text" class="fields" size="15" name="login_logar" id="logar" required logar=logar />
                        <input placeholder=" Senha" class="cadastroformmenor" type="password" class="fields" size="15" name="senha_logar" id="senhalogin" required senhalogin=senhalogin />
                        <input type="submit" id="Send" name="logar" value="Entrar" id="logar">
                    </form>
                    <a class="" href="https://www.facebook.com/dialog/oauth?client_id=ID&redirect_uri=http://yeebaplay.com.br/yeeba/u/pages/logar.php&scope=email,user_website,user_location"><div class="button_cadastrar_facebook_logar" ><img src="imagens/face.png" width="30" valign="middle">&nbsp;&nbsp;&nbsp;Entrar com o Facebook</div></a>
                </div>
            </li>
                <li class="active"><a href="index.php">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Outros <i class="icon-angle-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="about-us.php">O que o Yeeba faz?</a></li>
                        <li><a href="yeebaplay.com.br">Blog</a></li>
                        <li class="divider"></li>
                        <li><a href="privacy.php">Política de privacidade</a></li>
                        <li><a href="terms.php">Termos do usuário</a></li>
                    </ul>
                </li>
                <li><a href="https://www.facebook.com/dialog/oauth?client_id=ID&redirect_uri=http://yeebaplay.com.br/yeeba/src/cadastra_usuario.php&scope=email,user_website,user_location">Cadastrar</a></li>
                <li><a id="fazer_login" href="#">Login</a></li>
            </ul>
        </div>
    </div>
</header><!--/header-->