<?php

include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados

?>
<?php
	
	$ID = $_COOKIE['ID'];
	$NOME = $_COOKIE['NOME'];
	$foto = $_COOKIE['FOTO'];
	
	date_default_timezone_set('America/Sao_Paulo');
	$resposta=$_POST['resposta'];
	$data = date("d/m/Y");
	$hora = date("H:i");
	$id_da_pergunta =$_POST['id_pergunta'];
	

	//=============================================
	//Função para verificar se tem link
	function MontarLink ($texto)
	{
	       if (!is_string ($texto))
	           return $texto;

	    $er = "/(http:\/\/(www\.|.*?\/)?|www\.)([a-zA-Z0-9]+|_|-)+(\.(([0-9a-zA-Z]|-|_|\/|\?|=|&)+))+/i";
	    preg_match_all ($er, $texto, $match);

	    foreach ($match[0] as $link)
	    {
	        //coloca o 'http://' caso o link não o possua
	        $link_completo = (stristr($link, "http://") === false) ? "http://" . $link : $link;

	        $link_len = strlen ($link);


	        //troca "&" por "&", tornando o link válido pela W3C
	       $web_link = str_replace ("&", "&amp;", $link_completo);
	       $texto = str_ireplace ($link, "<a href=\"" . $web_link . "\" target=\"_blank\">". (($link_len > 60) ? substr ($web_link, 0, 25). "...". substr ($web_link, -15) : $web_link) ."</a>", $texto);

	    }

	    return $texto;

	}
	
	$resposta = MontarLink($resposta);

	//=============================================
	

	if($resposta == "")
	{
		echo '<script>window.location.assign("http://yeeba.me/u/perguntas/'.$id_da_pergunta.'")</script>';
	}else{
	$insert = "INSERT INTO respostas(nome, resposta, data, hora, id_membro, id_pergunta, foto)
	VALUES('$NOME', '$resposta', '$data', '$hora', '$ID', '$id_da_pergunta', '$foto')";
	$query = mysql_query($insert);
	echo '<script>window.location.assign("../'.$id_da_pergunta.'")</script>';
	
	}
	

	
	
 ?>
