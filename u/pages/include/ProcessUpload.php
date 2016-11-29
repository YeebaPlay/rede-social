<?php
	include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados
?>

<?php

function removeAcentos($string, $slug = false) {
  $string = strtolower($string);
  // Código ASCII das vogais
  $ascii['a'] = range(224, 230);
  $ascii['e'] = range(232, 235);
  $ascii['i'] = range(236, 239);
  $ascii['o'] = array_merge(range(242, 246), array(240, 248));
  $ascii['u'] = range(249, 252);
  // Código ASCII dos outros caracteres
  $ascii['b'] = array(223);
  $ascii['c'] = array(231);
  $ascii['d'] = array(208);
  $ascii['n'] = array(241);
  $ascii['y'] = array(253, 255);
  foreach ($ascii as $key=>$item) {
    $acentos = '';
    foreach ($item AS $codigo) $acentos .= chr($codigo);
    $troca[$key] = '/['.$acentos.']/i';
  }
  $string = preg_replace(array_values($troca), array_keys($troca), $string);
  // Slug?
  if ($slug) {
    // Troca tudo que não for letra ou número por um caractere ($slug)
    $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
    // Tira os caracteres ($slug) repetidos
    $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
    $string = trim($string, $slug);
  }
  return $string;
}

if(isset($_POST))
{
	############ Edit settings ##############
	$DestinationDirectory	= '../../../uploads/'; //specify upload directory ends with / (slash)
	##########################################
	
	//check if this is an ajax request
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}
	
	$ImageType 		= $_FILES['ImageFile']['type'];	
	//tratar nome do arquivo para não conter caracteres especiais
	$nomeOriginalArquivo = removeAcentos($_FILES['ImageFile']['name'], '-');
	$ImageName 		= "yeeba_".date('dmy').time()."_".$nomeOriginalArquivo;
	$ImageSize 		= $_FILES['ImageFile']['size']; // get original image size
	$TempSrc	 	= $_FILES['ImageFile']['tmp_name']; // Temp name of image file stored in PHP tmp folder
	$ImageSize = $ImageSize/1024;	
	
	$ID = $_COOKIE['ID'];
	$Pontos = $_COOKIE['PONTOS'];
		
	//Enviar para o banco de dados
	date_default_timezone_set('America/Sao_Paulo');
	
	$data = date("d/m/Y");
	$hora = date("H:i");
	
	$nome_arquivo = $_POST['nome_arquivo']; 

	//Retirar todo tipo de acento das palavras
	
	if($ImageType == "application/pdf")
	{
		$ImageType = "pdf";
	}
	
	if($ImageType == "binary/octet-stream")
	{
		$ImageType = "pdf";
	}
	
	if($ImageType == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
	{
		$ImageType = "docx";
	}
	
	if($ImageType == "text/plain")
	{
		$ImageType = "txt";
	}
	
	if($ImageType == "application/msword")
	{
		$ImageType = "doc";
	}

	//Link da Imagem
	$link_arquivo = $ImageName.".".$ImageType;
	

	if($ImageName != "")
	{
		$insert = "INSERT INTO adicionar_arquivos(nome_arquivo, link_arquivo, tamanho_arquivo, tipo_arquivo, data_arquivo, hora_arquivo, id_membro, status)
		VALUES('$nome_arquivo', '$link_arquivo', '$ImageSize', '$ImageType', '$data', '$hora', '$ID', '1')";
		$query = mysql_query($insert);

		$Pontos = $Pontos + 50;
		mysql_query("UPDATE dados_usuarios SET Pontos='$Pontos' WHERE ID='$ID'");
	 
		//terminou o envio para o banco de dados
		//Mover arquivos para a pasta 
		if(move_uploaded_file($_FILES['ImageFile']['tmp_name'], $DestinationDirectory . $link_arquivo)){
		
		}else{
			echo "Erro ao mover arquivo";
		}
	}



}
?>