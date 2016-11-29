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

	$DestinationDirectory	= '../../../uploads/imgpost/'; //specify upload directory ends with / (slash)

	$ID = $_COOKIE['ID'];
	$NOME = $_COOKIE['NOME'];
	$FOTO =$_COOKIE['FOTO'];
	//sleep(5);
	date_default_timezone_set('America/Sao_Paulo');

	$video_text   = $_POST['video_text'];
	$categoria    = $_POST['forum_selecionado'];

	if($_FILES['file']['tmp_name'])
	{
		$video_text = "";
		$ImageType    = $_FILES['file']['type'];
		$nomeOriginalArquivo = removeAcentos($_FILES['file']['tmp_name'], '-');
		$ImageName 	  = "yeeba_".date('dmy').time()."_".$nomeOriginalArquivo;
		//Verificar tipo do arquivo
		if($ImageType == "image/jpeg")
		{
			$ImageType = "jpg";
		}

		if($ImageType == "image/gif")
		{
			$ImageType = "gif";
		}

		if($ImageType == "image/png")
		{
			$ImageType = "png";
		}

		//Link da Imagem
		$imagem_text = $ImageName.".".$ImageType;	
	}
	
	$data         = date("Y-m-d H:i:s");

	//=============================================
	//Função para verificar se tem link
	$pergunta = $_POST['pergunta'];
	function MontarLink ($texto)
	{
	       if (!is_string ($texto))
	           return $texto;

	    //$er = "/(http:\/\/(www\.|.*?\/)?|www\.)([a-zA-Z0-9]+|_|-)+(\.(([0-9a-zA-Z]|-|_|\/|\?|=|&)+))+/i";
	    //$er = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	    $er = "/((http|https|ftp|ftps):\/\/(www\.|.*?\/)?|www\.)([a-zA-Z0-9]+|_|-)+(\.(([0-9a-zA-Z]|-|_|\/|\?|=|&)+))+/i";
	    preg_match_all ($er, $texto, $match);


	    foreach ($match[0] as $link)
	    {
	        //coloca o 'http://' caso o link não o possua
	        if(stristr($link, "http://") === false && stristr($link, "https://") === false)
	        {
	        	$link_completo = "http://" . $link;
	        }else{
	        	$link_completo = $link;
	        }
	        //$link_completo = (stristr($link, "http://") === false) ? "http://" . $link : $link;

	        $link_len = strlen ($link);


	        //troca "&" por "&", tornando o link válido pela W3C
	       $web_link = str_replace ("&", "&amp;", $link_completo);
	       $texto = str_ireplace ($link, "<a href=\"" . $web_link . "\" target=\"_blank\">". (($link_len > 60) ? substr ($web_link, 0, 25). "...". substr ($web_link, -15) : $web_link) ."</a>", $texto);
	       
	       //strtolower($web_link); Deixa tudo minusculo
	    }
	    return $texto;
	}
	
	$pergunta = MontarLink($pergunta);

	//=============================================
	//Verificar se o usuario já fez alguma pergunta hoje

	/*$sql = mysql_query ("SELECT id FROM tb_post WHERE col_id_membro = '$ID' AND col_data = '$data' AND col_status <> 0");
	$contador = mysql_num_rows($sql);
	if($contador >= 4){
		exit;
	}

	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <center>Publicado com sucesso!!</center>
    </div>



	*/
	//===================================================


	if(!empty($_FILES['file']['name'])){	
		$post = '
			<div class="post-count">
				<div class="panel panel-default">
			        <div class="panel-heading">
			            <i class="fa fa-pencil-square-o"></i>
			            
			            <div class="pull-right">
			                <div class="btn-group">
			                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
			                        Eu quero...
			                        <span class="caret"></span>
			                    </button>
			                    <ul class="dropdown-menu pull-right" role="menu">
			                        <li><a href="#">Denunciar publicação</a>
			                        </li>
			                    </ul>
			                </div>
			            </div>
			        </div>
			        <div class="panel-body">
					<table border="0" cellspacing="0" cellpadding="0">
							<table class="post">
									<tr>
										<td width="7%" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$FOTO.'" width="50"/></td>
										<td><a class="linkdoPerfil" href="http://yeeba.me/u/user/'.$ID.'">'.$NOME.'</a><br>'.$data.'</td>
										<td width="7%" align="center"></td>
									</tr>
								<tr>
									
									<td width="10%" align="center"><img src="../images/question.png" width="30" height="30"/></td>
									<td width="85%"><div class="wrap_post">'.$pergunta.'</div></td>
								</tr>
								<tr>
									<td>...</td>
									<td>
										<img src="../../uploads/imgpost/'.$imagem_text.'" width="100%" alt="" />
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<table>
											<tr width="100%">
												<td class="botaoPost">
													<a class="linkdoPerfil" href="">
														<button type="button" class="btn btn-outline btn-primary btn-xs">Ver todos os comentários</button>
													</a>
												</td>
												<td valign="middle" class="botaoPost">
													<input type="image" width="20" src="../images/staricondown.png""/>
												</td>
												<td valign="middle">
													0
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</table>
					</div>
			    </div>
			</u><br>
		';
	}else if($video_text != ""){
		$video = substr($video_text, -11);
		$post = '
			<div class="post-count">
				<div class="panel panel-default">
			        <div class="panel-heading">
			            <i class="fa fa-pencil-square-o"></i>
			            
			            <div class="pull-right">
			                <div class="btn-group">
			                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
			                        Eu quero...
			                        <span class="caret"></span>
			                    </button>
			                    <ul class="dropdown-menu pull-right" role="menu">
			                        <li><a href="#">Denunciar publicação</a>
			                        </li>
			                    </ul>
			                </div>
			            </div>
			        </div>
			        <div class="panel-body">
					<table border="0" cellspacing="0" cellpadding="0">
							<table class="post">
									<tr>
										<td width="7%" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$FOTO.'" width="50"/></td>
										<td><a class="linkdoPerfil" href="http://yeeba.me/u/user/'.$ID.'">'.$NOME.'</a><br>'.$data.'</td>
										<td width="7%" align="center"></td>
									</tr>
								<tr>
									
									<td width="10%" align="center"><img src="../images/question.png" width="30" height="30"/></td>
									<td width="85%"><div class="wrap_post">'.$pergunta.'</div></td>
								</tr>
								<tr>
									<td>...</td>
									<td>
										<iframe width="100%" height="350" src="//www.youtube.com/embed/'.$video.'" frameborder="0" allowfullscreen></iframe>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<table>
											<tr width="100%">
												<td class="botaoPost">
													<a class="linkdoPerfil" href="">
														<button type="button" class="btn btn-outline btn-primary btn-xs">Ver todos os comentários</button>
													</a>
												</td>
												<td valign="middle" class="botaoPost">
													<input type="image" width="20" src="../images/staricondown.png""/>
												</td>
												<td valign="middle">
													0
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</table>
					</div>
			    </div>
			</u><br>
		';
	}else{
		$post = '
			<div class="post-count">
				<div class="panel panel-default">
			        <div class="panel-heading">
			            <i class="fa fa-pencil-square-o"></i>
			            
			            <div class="pull-right">
			                <div class="btn-group">
			                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
			                        Eu quero...
			                        <span class="caret"></span>
			                    </button>
			                    <ul class="dropdown-menu pull-right" role="menu">
			                        <li><a href="#">Denunciar publicação</a>
			                        </li>
			                    </ul>
			                </div>
			            </div>
			        </div>
			        <div class="panel-body">
					<table border="0" cellspacing="0" cellpadding="0">
							<table class="post">
									<tr>
										<td width="7%" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$FOTO.'" width="50"/></td>
										<td><a class="linkdoPerfil" href="http://yeeba.me/u/user/'.$ID.'">'.$NOME.'</a><br>'.$data.'</td>
										<td width="7%" align="center"></td>
									</tr>
								<tr>
									<td width="10%" align="center"><img src="../images/question.png" width="30" height="30"/></td>
									<td width="85%"><div class="wrap_post">'.$pergunta.'</div></td>
								</tr>
								<tr>
									<td></td>
									<td>
										<table>
											<tr width="100%">
												<td class="botaoPost">
													<a class="linkdoPerfil" href="">
														<button type="button" class="btn btn-outline btn-primary btn-xs">Ver todos os comentários</button>
													</a>
												</td>
												<td valign="middle" class="botaoPost">
													<input type="image" width="20" src="../images/staricondown.png""/>
												</td>
												<td valign="middle">
													0
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</table>
					</div>
			    </div>
			</u><br>
		';
	}

 	//===================================================

 	if($pergunta == "" || $categoria == "")
	{
		$ret = array('error' => 'no_file');
		exit;
	}else{
		if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
		  if(move_uploaded_file($_FILES['file']['tmp_name'], $DestinationDirectory . $imagem_text)){
		  	$ret = array('status' => 'ok', 'pergunta' => $pergunta, 'data' => $data, 'post' => $post);
		  }else{
		  	$ret = array('error' => 'no_file');
		  } 
		}else{
			$imagem_text = ""; //Para funcionar o javascript
			$ret = array('status' => 'ok', 'pergunta' => $pergunta, 'data' => $data, 'post' => $post);
		}
		
		$insert = "INSERT INTO tb_post(col_nome, col_categoria, col_pergunta, col_data, col_id_membro, col_video, col_imagem, col_status)
		VALUES('$NOME', '$categoria', '$pergunta', '$data', '$ID', '$video_text', '$imagem_text', '1')";
		$query = mysql_query($insert);
	}
	
	header('Content-Type: application/json');
	echo json_encode($ret);
 ?>
