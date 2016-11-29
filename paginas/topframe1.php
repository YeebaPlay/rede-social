<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">

$(function(){
	//Função que ao clicar no botão, irá fazer.
	$("#fazer_login").click(function(){
	$("#login").show("slow");
	$("#fazer_login").hide("fast");

	});
});
 
</script>

<?php
include "validar_session_home.php";

include "Config/config_sistema.php";

// faz consulta no banco
$consulta = mysql_query("SELECT * FROM dados_usuarios WHERE Login = '$login_usuario'");
while($linha = mysql_fetch_object($consulta)) {
	$linkFoto = $linha->Foto;
	$loginUsuario = $linha->Login;
	$ID = $linha->ID;
	$NOME = $linha->Nome;
}
?>

<div id="menu">
	<div class="logoindex" align="right">
	</div>
	<div class="botaoindex" align="right">
		<?php if($loginUsuario == ""){
			echo '
			
				<div style="display: none;" id="login">	 
					<form action="logar.php" method="POST" name="formlogin">
						<input placeholder=" Login ou e-mail" class="cadastroformmenor" type="text" class="fields" size="15" name="login_logar" id="logar" required logar=logar />
						<input placeholder=" Senha" class="cadastroformmenor" type="password" class="fields" size="15" name="senha_logar" id="senhalogin" required senhalogin=senhalogin />
						<input type="submit" id="Send" name="logar" value="Entrar" id="logar">
					</form>
					<a class="" href="https://www.facebook.com/dialog/oauth?client_id=373538102706671&redirect_uri=http://yeeba.me/logar.php&scope=email,user_website,user_location"><div class="button_cadastrar_facebook_logar" ><img src="imagens/face.png" width="30" valign="middle">&nbsp;&nbsp;&nbsp;Entrar com o Facebook</div></a>
				</div>
						

			';
		}?>
	</div>
	<div class="logado_home">
	<?php 

	if($loginUsuario != ""){
		echo '
		<center>
		<table>
			<tr>
				<td>
					<a href="http://yeeba.me/u/user/<?php echo $ID; ?>"><img class="foto_perfil" src="uploads/fotos/'.$linkFoto.'" width="40" height="40" /></a> 
				</td>
				<td align="middle">
					<a href="u/"><div style="color: #F5F5F5; padding-left: 5px; font-family: sans-serif;">Entrar</div></a>
				</td>
			</tr>
		</table>
		</center>
		';
	}else{
		echo '
		<center>
		<div>
			<table>
				<tr>
					<td>
						 <img class="foto_perfil" src="uploads/fotos/logon.jpg" width="40" height="40" />
					</td>
					<td align="middle">
						<a href="#"><div id="fazer_login" style="color: #F5F5F5; padding-left: 5px; font-family: sans-serif;">Entrar</div></a>
					</td>
				</tr>
			</table>
		</div>
		</center>
		';
	}
	?>
	</div>
</div>