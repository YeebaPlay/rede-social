<?php
	
	include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados
?>
<?php
	
	$ID = $_COOKIE['ID'];
		
	
	date_default_timezone_set('America/Sao_Paulo');
	$postid=$_POST['postid'];
	$data = date("d/m/Y");
	$hora = date("H:i");
	
	//=============================================


	//Verificar se o usuario já votou
	$sql = mysql_query ("SELECT id FROM tb_curtir_post WHERE col_id_de_quem_curtiu = '$ID' && col_id_da_postagem = '$postid'");
	$contador = mysql_num_rows($sql);
	if($contador > 0){
		echo "votou";
		exit;
	}
	

	$insert = "INSERT INTO tb_curtir_post (col_id_da_postagem, col_id_de_quem_curtiu, col_data, col_hora)
	VALUES('$postid', '$ID', '$data', '$hora')";
	$query = mysql_query($insert);
	//echo '<script>window.location.assign("http://yeeba.me/u/index.php")</script>';

	
 ?>
