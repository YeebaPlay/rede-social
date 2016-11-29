<?php 
	error_reporting(0);
	include "../../../Config/config_sistema.php";

	$ID = $_COOKIE['ID'];
	$curso = $_COOKIE['CURSO'];
	$FOTO = $_COOKIE['FOTO'];
	$Sobre = $_COOKIE['SOBRE'];
	$PONTOS = $_COOKIE['PONTOS'];


	$init 	= $_POST['init'];
	$max 	= $_POST['max'];

	//sleep(2);
	$sql = mysql_query ("SELECT id FROM tb_forum_interacoes WHERE col_id_usuario = '".$ID."' LIMIT 1");
	$count = mysql_num_rows($sql);
	
	if($count == 0)
	{
		$sqlTotalPost = mysql_query ("SELECT id FROM tb_post");
		$contador = mysql_num_rows($sqlTotalPost);
	}else{
		$sql = mysql_query ("
			SELECT
				COUNT(u.id) AS total
			FROM 
				tb_curso c,
				dados_usuarios u,
				tb_forum_interacoes uc,
				tb_post p
			WHERE 	
				uc.col_id_usuario = $ID AND 
				uc.col_id_curso = c.id AND
				p.col_categoria = c.id AND
				p.col_status = 1 AND
				p.col_id_membro = u.id
			");
		
		while($linha = mysql_fetch_array($sql)){ $contador = $linha['total'];}
	}

	if($contador == $init)
	{
		echo "fim";
		exit;
	}
	
	if ($contador - $init < $max) {
		$max = $contador - $init ;
	}

	//echo "Contador: ".$contador."<br/>";
	//echo "INICIO: ".$init."<br/>";
	//echo "MAX".$max."<br/>";

	$contagemParaVerAux = 0;
	if($count > 0)
	{
		$sqlPost = mysql_query ("
			SELECT
				u.Foto,
				u.Nome,
				p.*,
				c.col_des_nome,
				uc.col_id_curso
			FROM 
				tb_curso c,
				dados_usuarios u,
				tb_forum_interacoes uc,
				tb_post p
			WHERE 	
				uc.col_id_usuario = $ID AND 
				uc.col_id_curso = c.id AND
				p.col_categoria = c.id AND
				p.col_status = 1 AND
				p.col_id_membro = u.id
			ORDER BY p.id DESC LIMIT $init, $max
			");
		
		$contadorPost = mysql_num_rows($sqlPost);

		if ($contadorPost > 0)
		{
			while($linha = mysql_fetch_array($sqlPost))
			{
				$id_pergunta = $linha['id'];
				$pergunta = $linha['col_pergunta'];
				$id = $linha['col_id_membro'];
				$categoria = $linha['col_categoria'];
				$video = $linha['col_video'];
				$imagem = $linha['col_imagem'];
				$status = $linha['col_status'];
				$data = $linha['col_data'];
				$nomeCurso = $linha['col_des_nome'];
				$data = date('d/m/Y - H:i:s', strtotime($data));
				$idCurso = $linha['col_id_curso'];


				$fotoPergunta = $linha['Foto'];
				$nome = $linha['Nome'];
				
				$sqlLike = mysql_query ("SELECT id FROM tb_curtir_post WHERE col_id_da_postagem = '$id_pergunta'");
				$num_Like = mysql_num_rows($sqlLike);

				//Verificar se o usuario já votou
				$sqlVotou = mysql_query ("SELECT id FROM tb_curtir_post WHERE col_id_de_quem_curtiu = '$ID' AND col_id_da_postagem = '$id_pergunta'");
				$contadorVotou = mysql_num_rows($sqlVotou);

				if($status != 0)
				{		
					if($video == "" && $imagem == "")
					{
					//<input type="text" value="teste" onclick="funcaoCurtir(this.value())" />
						echo '
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
			                                        <li><a href="include/DenunciarPost.php?id='.$id_pergunta.'">Denunciar publicação</a>
			                                        </li>
			                                    </ul>
			                                </div>
			                            </div>
			                        </div>
			                        <div class="panel-body">
			                            <table border="0" cellspacing="0" cellpadding="0">
											<table class="post">
													<tr>
														<td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
														<td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<a href="forum.php?id='.base64_encode($idCurso).'"><button type="button" class="btn btn-default">#'.$nomeCurso.'</button></a></td>
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
																<td valign="middle" class="botaoPost">
																	<a class="linkdoPerfil" href="'.$id_pergunta.'">
																		<button type="button" class="btn btn-outline btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Veja todos os comentários">Ver todos os comentários</button>
																	</a>
																</td>
																'; 
																if($contadorVotou == 0)
																{
																?>
																<td valign="middle" class="botaoPost">
																	<input style="cursor:pointer; float: left;" type="image" width="20" onClick="this.src='../images/staricon.png'; like(this.value);" src="../images/staricondown.png" name="pergunta_envia" id="pergunta_envia" value="<?php echo $id_pergunta; ?>"/> 
																</td>
																<td valign="middle">
																	<div id="<?php echo $id_pergunta; ?>" style="display: block; "><?php echo $num_Like; ?></div>
																</td>
																<?php 

																}else{
																	echo '
																		<td valign="middle" class="botaoPost">
																			<input type="image" width="20" src="../images/staricon.png""/>
																		</td>
																		<td valign="middle">
																			'.$num_Like.'
																		</td>
																		';
																}	
																echo '
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</table>
										<table>
											<tr>
												<td></td>
												<td align="left"> '; ?>
													<div class="accordions">
														<div class="accordion-item">
														    <input type="checkbox" name="accordion" id="accordion-<?php echo $id_pergunta; ?>" />
														    <label for= "accordion-<?php echo $id_pergunta; ?>"><img src="../images/comentario_post.png" width="25" style="padding-right: 5px;"></label>
															<?php
																$sqlComentario = mysql_query("SELECT r.resposta, r.id_membro, r.data, r.hora, du.Nome, du.Foto FROM respostas r INNER JOIN dados_usuarios du ON r.id_membro = du.ID WHERE r.id_pergunta = $id_pergunta ORDER BY r.id DESC LIMIT 10");
																$contadorComentario = mysql_num_rows($sqlComentario);

																if ($contadorComentario > 0)
																{
																	while($linha = mysql_fetch_array($sqlComentario))
																	{
																		$comentario = $linha['resposta'];
																		$dataComentario = $linha['data'];
																		$horaComentario = $linha['hora'];
																		$id_dono_comentario = $linha['id_membro'];
																	
																		$fotoComentario = $linha['Foto'];
																		$nomeComentario = $linha['Nome'];

																		echo '
																			 <div class="accordion-content">
																				<table class="postagem-comentario-wrap">
																					<tr>
																						<td valign="top" align="left" width="35">
																							<img class="foto-comentario" src="../../uploads/fotos/'.$fotoComentario.'" width="25" height="25"> 
																						</td>
																						<td>
																							<table>
																								<tr>
																									<td class="comentario-post">
																										<a href="profile.php?id='.$id_dono_comentario.'" >'.$nomeComentario.'</a> disse: '.$comentario.'
																									</td>
																								</tr>
																								<tr>
																									<td class="data-comentario-post">
																										'.$dataComentario.' - '.$horaComentario.'
																									</td>
																								</tr>
																							</table>
																						</td>
																					</tr>
																				</table>
																			</div>
																		';
																	}
																	//Verificar se tem mais de 10 comentários
																	if($contadorComentario > 9)
																	{
																		$contadorComentario = "+ ".$contadorComentario;
																	}
																} 
																echo '
														</div>
													</div>
													<div id="comentario-feito'.$id_pergunta.'"></div>
												</td>
											</tr>
											<tr>
												<td valign="top">
													<center><img src="../../uploads/fotos/'.$FOTO.'" width="35" height="35"></center>
												</td>
												<td width="100%">
													<div class="col-lg-12">
														<form name="comentario" id="'.$id_pergunta.'" onsubmit="chamarComentario(this.id); return false;">
															<input id="id_pergunta'.$id_pergunta.'" type="hidden" value="'.$id_pergunta.'" />
															<input id="comentario'.$id_pergunta.'" type="text" class="form-control" placeholder="Escreva um comentário"/>
															<div style="display: none">><input type="submit"></div>
														</form>
														<span style="font-size: 10px; padding-right: 5px;">'.$contadorComentario.' Comentário(s)</span>
													</div>
												</td>
											</tr>
										</table>
			                     	</div>
			                    </div>
							</div>
							<br>
						';
					}else if($video != ""){
						$video = substr($video, -11);
						echo '
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
			                                        <li><a href="include/DenunciarPost.php?id='.$id_pergunta.'">Denunciar publicação</a>
			                                        </li>
			                                    </ul>
			                                </div>
			                            </div>
			                        </div>
			                        <div class="panel-body">
										<table border="0" cellspacing="0" cellpadding="0">
											<table class="post">
													<tr>
														<td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
														<td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<a href="forum.php?id='.base64_encode($idCurso).'"><button type="button" class="btn btn-default">#'.$nomeCurso.'</button></a></td>
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
																	<a class="linkdoPerfil" href="'.$id_pergunta.'">
																		<button type="button" class="btn btn-outline btn-primary btn-xs">Ver todos os comentários</button>
																	</a>	
																</td>
																'; 
																	if($contadorVotou == 0)
																	{
																	?>
																	<td valign="middle" class="botaoPost">
																		<input style="cursor:pointer; float: left;" type="image" width="20" onClick="this.src='../images/staricon.png'; like(this.value);" src="../images/staricondown.png" name="pergunta_envia" id="pergunta_envia" value="<?php echo $id_pergunta; ?>"/> 
																	</td>
																	<td valign="middle">
																		<div id="<?php echo $id_pergunta; ?>" style="display: block; "><?php echo $num_Like; ?></div>
																	</td>
																	<?php 

																	}else{
																		echo '
																			<td valign="middle" class="botaoPost">
																				<input type="image" width="20" src="../images/staricon.png""/>
																			</td>
																			<td valign="middle">
																				'.$num_Like.'
																			</td>
																			';
																	}	
																	echo '
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</table>
										<table>
											<tr>
												<td></td>
												<td align="left"> '; ?>
													<div class="accordions">
														<div class="accordion-item">
														    <input type="checkbox" name="accordion" id="accordion-<?php echo $id_pergunta; ?>" />
														    <label for= "accordion-<?php echo $id_pergunta; ?>"><img src="../images/comentario_post.png" width="25" style="padding-right: 5px;"></label>
															<?php
																$sqlComentario = mysql_query("SELECT r.resposta, r.id_membro, r.data, r.hora, du.Nome, du.Foto FROM respostas r INNER JOIN dados_usuarios du ON r.id_membro = du.ID WHERE r.id_pergunta = $id_pergunta ORDER BY r.id DESC LIMIT 10");
																$contadorComentario = mysql_num_rows($sqlComentario);

																if ($contadorComentario > 0)
																{
																	while($linha = mysql_fetch_array($sqlComentario))
																	{
																		$comentario = $linha['resposta'];
																		$dataComentario = $linha['data'];
																		$horaComentario = $linha['hora'];
																		$id_dono_comentario = $linha['id_membro'];
																	
																		$fotoComentario = $linha['Foto'];
																		$nomeComentario = $linha['Nome'];

																		echo '
																			 <div class="accordion-content">
																				<table class="postagem-comentario-wrap">
																					<tr>
																						<td valign="top" align="left" width="35">
																							<img class="foto-comentario" src="../../uploads/fotos/'.$fotoComentario.'" width="25" height="25"> 
																						</td>
																						<td>
																							<table>
																								<tr>
																									<td class="comentario-post">
																										<a href="profile.php?id='.$id_dono_comentario.'" >'.$nomeComentario.'</a> disse: '.$comentario.'
																									</td>
																								</tr>
																								<tr>
																									<td class="data-comentario-post">
																										'.$dataComentario.' - '.$horaComentario.'
																									</td>
																								</tr>
																							</table>
																						</td>
																					</tr>
																				</table>
																			</div>
																		';
																	}
																	//Verificar se tem mais de 10 comentários
																	if($contadorComentario > 9)
																	{
																		$contadorComentario = "+ ".$contadorComentario;
																	}
																} 
																echo '
														</div>
													</div>
													<div id="comentario-feito'.$id_pergunta.'"></div>
												</td>
											</tr>
											<tr>
												<td valign="top">
													<center><img src="../../uploads/fotos/'.$FOTO.'" width="35" height="35"></center>
												</td>
												<td width="100%">
													<div class="col-lg-12">
														<form name="comentario" id="'.$id_pergunta.'" onsubmit="chamarComentario(this.id); return false;">
															<input id="id_pergunta'.$id_pergunta.'" type="hidden" value="'.$id_pergunta.'" />
															<input id="comentario'.$id_pergunta.'" type="text" class="form-control" placeholder="Escreva um comentário"/>
															<div style="display: none">><input type="submit"></div>
														</form>
														<span style="font-size: 10px; padding-right: 5px;">'.$contadorComentario.' Comentário(s)</span>
													</div>
												</td>
											</tr>
										</table>
									</div>
			                    </div>
							</div><br>
						';
					}else if($imagem != ""){
						echo '
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
			                                        <li><a href="include/DenunciarPost.php?id='.$id_pergunta.'">Denunciar publicação</a>
			                                        </li>
			                                    </ul>
			                                </div>
			                            </div>
			                        </div>
			                        <div class="panel-body">
										<table border="0" cellspacing="0" cellpadding="0">
											<table class="post">
													<tr>
														<td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
														<td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<a href="forum.php?id='.base64_encode($idCurso).'"><button type="button" class="btn btn-default">#'.$nomeCurso.'</button></a></td>
														<td width="7%" align="center"></td>
													</tr>
												<tr>
													
													<td width="10%" align="center"><img src="../images/question.png" width="30" height="30"/></td>
													<td width="85%"><div class="wrap_post">'.$pergunta.'</div></td>
												</tr>
												<tr>
													<td>...</td>
													<td>
														<img src="../../uploads/imgpost/'.$imagem.'" width="100%" alt="" />
													</td>
												</tr>
												<tr>
													<td></td>
													<td>
														<table>
															<tr width="100%">
																<td class="botaoPost">
																	<a class="linkdoPerfil" href="'.$id_pergunta.'">
																		<button type="button" class="btn btn-outline btn-primary btn-xs">Ver todos os comentários</button>
																	</a>
																</td>
																'; 
																	if($contadorVotou == 0)
																	{
																	?>
																	<td valign="middle" class="botaoPost">
																		<input style="cursor:pointer; float: left;" type="image" width="20" onClick="this.src='../images/staricon.png'; like(this.value);" src="../images/staricondown.png" name="pergunta_envia" id="pergunta_envia" value="<?php echo $id_pergunta; ?>"/> 
																	</td>
																	<td valign="middle">
																		<div id="<?php echo $id_pergunta; ?>" style="display: block; "><?php echo $num_Like; ?></div>
																	</td>
																	<?php 

																	}else{
																		echo '
																			<td valign="middle" class="botaoPost">
																				<input type="image" width="20" src="../images/staricon.png""/>
																			</td>
																			<td valign="middle">
																				'.$num_Like.'
																			</td>
																			';
																	}	
																	echo '
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</table>
										<table>
											<tr>
												<td></td>
												<td align="left"> '; ?>
													<div class="accordions">
														<div class="accordion-item">
														    <input type="checkbox" name="accordion" id="accordion-<?php echo $id_pergunta; ?>" />
														    <label for= "accordion-<?php echo $id_pergunta; ?>"><img src="../images/comentario_post.png" width="25" style="padding-right: 5px;"></label>
															<?php
																$sqlComentario = mysql_query("SELECT r.resposta, r.id_membro, r.data, r.hora, du.Nome, du.Foto FROM respostas r INNER JOIN dados_usuarios du ON r.id_membro = du.ID WHERE r.id_pergunta = $id_pergunta ORDER BY r.id DESC LIMIT 10");
																$contadorComentario = mysql_num_rows($sqlComentario);

																if ($contadorComentario > 0)
																{
																	while($linha = mysql_fetch_array($sqlComentario))
																	{
																		$comentario = $linha['resposta'];
																		$dataComentario = $linha['data'];
																		$horaComentario = $linha['hora'];
																		$id_dono_comentario = $linha['id_membro'];
																	
																		$fotoComentario = $linha['Foto'];
																		$nomeComentario = $linha['Nome'];

																		echo '
																			 <div class="accordion-content">
																				<table class="postagem-comentario-wrap">
																					<tr>
																						<td valign="top" align="left" width="35">
																							<img class="foto-comentario" src="../../uploads/fotos/'.$fotoComentario.'" width="25" height="25"> 
																						</td>
																						<td>
																							<table>
																								<tr>
																									<td class="comentario-post">
																										<a href="profile.php?id='.$id_dono_comentario.'" >'.$nomeComentario.'</a> disse: '.$comentario.'
																									</td>
																								</tr>
																								<tr>
																									<td class="data-comentario-post">
																										'.$dataComentario.' - '.$horaComentario.'
																									</td>
																								</tr>
																							</table>
																						</td>
																					</tr>
																				</table>
																			</div>
																		';
																	}
																	//Verificar se tem mais de 10 comentários
																	if($contadorComentario > 9)
																	{
																		$contadorComentario = "+ ".$contadorComentario;
																	}
																} 
																echo '
														</div>
													</div>
													<div id="comentario-feito'.$id_pergunta.'"></div>
												</td>
											</tr>
											<tr>
												<td valign="top">
													<center><img src="../../uploads/fotos/'.$FOTO.'" width="35" height="35"></center>
												</td>
												<td width="100%">
													<div class="col-lg-12">
														<form name="comentario" id="'.$id_pergunta.'" onsubmit="chamarComentario(this.id); return false;">
															<input id="id_pergunta'.$id_pergunta.'" type="hidden" value="'.$id_pergunta.'" />
															<input id="comentario'.$id_pergunta.'" type="text" class="form-control" placeholder="Escreva um comentário"/>
															<div style="display: none">><input type="submit"></div>
														</form>
														<span style="font-size: 10px; padding-right: 5px;">'.$contadorComentario.' Comentário(s)</span>
													</div>
												</td>
											</tr>
										</table>
									</div>
			                    </div>
							</div><br>
						';
					}
				}	
			}
		}
	}else{
		$sqlPostGeral = mysql_query ("SELECT p.*, du.Foto, du.Nome FROM tb_post p INNER JOIN dados_usuarios du ON du.ID = p.col_id_membro WHERE p.col_status = 1 ORDER BY p.id DESC LIMIT $init, $max");
		$contadorPostGeral = mysql_num_rows($sqlPostGeral);

		if ($contadorPostGeral > 0)
		{
			while($linha = mysql_fetch_array($sqlPostGeral))
			{
				$id_pergunta = $linha['id'];
				$pergunta = $linha['col_pergunta'];
				$id = $linha['col_id_membro'];
				$categoria = $linha['col_categoria'];
				$video = $linha['col_video'];
				$imagem = $linha['col_imagem'];
				$status = $linha['col_status'];
				$data = $linha['col_data'];
				$timestamp = strtotime($data); // Gera o timestamp de $data_mysql
				$data = date('d/m/Y H:i:s', $timestamp); 

				$fotoPergunta = $linha['Foto'];
				$nome = $linha['Nome'];
				
				$sqlLike = mysql_query ("SELECT id FROM tb_curtir_post WHERE col_id_da_postagem = '$id_pergunta'");
				$num_Like = mysql_num_rows($sqlLike);
				
				//Verificar se o usuario já votou
				$sqlVotou = mysql_query ("SELECT id FROM tb_curtir_post WHERE col_id_de_quem_curtiu = '$ID' && col_id_da_postagem = '$id_pergunta'");
				$contadorVotou = mysql_num_rows($sqlVotou);
				
				if($status != 0)
				{		
					if($video == "" && $imagem == "")
					{
					//<input type="text" value="teste" onclick="funcaoCurtir(this.value())" />
						echo '
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
			                                        <li><a href="include/DenunciarPost.php?id='.$id_pergunta.'">Denunciar publicação</a>
			                                        </li>
			                                    </ul>
			                                </div>
			                            </div>
			                        </div>
			                        <div class="panel-body">
			                            <table border="0" cellspacing="0" cellpadding="0">
											<table class="post">
													<tr>
														<td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
														<td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<a href="forum.php?id='.base64_encode($idCurso).'"><button type="button" class="btn btn-default">#'.$nomeCurso.'</button></a></td>
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
																<td valign="middle" class="botaoPost">
																	<a class="linkdoPerfil" href="'.$id_pergunta.'">
																		<button type="button" class="btn btn-outline btn-primary btn-xs">Ver todos os comentários</button>
																	</a>
																</td>
																'; 
																if($contadorVotou == 0)
																{
																?>
																<td valign="middle" class="botaoPost">
																	<input style="cursor:pointer; float: left;" type="image" width="20" onClick="this.src='../images/staricon.png'; like(this.value);" src="../images/staricondown.png" name="pergunta_envia" id="pergunta_envia" value="<?php echo $id_pergunta; ?>"/> 
																</td>
																<td valign="middle">
																	<div id="<?php echo $id_pergunta; ?>" style="display: block; "><?php echo $num_Like; ?></div>
																</td>
																<?php 

																}else{
																	echo '
																		<td valign="middle" class="botaoPost">
																			<input type="image" width="20" src="../images/staricon.png""/>
																		</td>
																		<td valign="middle">
																			'.$num_Like.'
																		</td>
																		';
																}	
																echo '
																
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</table>
										<table>
											<tr>
												<td></td>
												<td align="left"> '; ?>
													<div class="accordions">
														<div class="accordion-item">
														    <input type="checkbox" name="accordion" id="accordion-<?php echo $id_pergunta; ?>" />
														    <label for= "accordion-<?php echo $id_pergunta; ?>"><img src="../images/comentario_post.png" width="25" style="padding-right: 5px;"></label>
															<?php
																$sqlComentario = mysql_query("SELECT r.resposta, r.id_membro, r.data, r.hora, du.Nome, du.Foto FROM respostas r INNER JOIN dados_usuarios du ON r.id_membro = du.ID WHERE r.id_pergunta = $id_pergunta ORDER BY r.id DESC LIMIT 10");
																$contadorComentario = mysql_num_rows($sqlComentario);

																if ($contadorComentario > 0)
																{
																	while($linha = mysql_fetch_array($sqlComentario))
																	{
																		$comentario = $linha['resposta'];
																		$dataComentario = $linha['data'];
																		$horaComentario = $linha['hora'];
																		$id_dono_comentario = $linha['id_membro'];
																	
																		$fotoComentario = $linha['Foto'];
																		$nomeComentario = $linha['Nome'];

																		echo '
																			 <div class="accordion-content">
																				<table class="postagem-comentario-wrap">
																					<tr>
																						<td valign="top" align="left" width="35">
																							<img class="foto-comentario" src="../../uploads/fotos/'.$fotoComentario.'" width="25" height="25"> 
																						</td>
																						<td>
																							<table>
																								<tr>
																									<td class="comentario-post">
																										<a href="profile.php?id='.$id_dono_comentario.'" >'.$nomeComentario.'</a> disse: '.$comentario.'
																									</td>
																								</tr>
																								<tr>
																									<td class="data-comentario-post">
																										'.$dataComentario.' - '.$horaComentario.'
																									</td>
																								</tr>
																							</table>
																						</td>
																					</tr>
																				</table>
																			</div>
																		';
																	}
																	//Verificar se tem mais de 10 comentários
																	if($contadorComentario > 9)
																	{
																		$contadorComentario = "+ ".$contadorComentario;
																	}
																} 
																echo '
														</div>
													</div>
													<div id="comentario-feito'.$id_pergunta.'"></div>
												</td>
											</tr>
											<tr>
												<td valign="top">
													<center><img src="../../uploads/fotos/'.$FOTO.'" width="35" height="35"></center>
												</td>
												<td width="100%">
													<div class="col-lg-12">
														<form name="comentario" id="'.$id_pergunta.'" onsubmit="chamarComentario(this.id); return false;">
															<input id="id_pergunta'.$id_pergunta.'" type="hidden" value="'.$id_pergunta.'" />
															<input id="comentario'.$id_pergunta.'" type="text" class="form-control" placeholder="Escreva um comentário"/>
															<div style="display: none">><input type="submit"></div>
														</form>
														<span style="font-size: 10px; padding-right: 5px;">'.$contadorComentario.' Comentário(s)</span>
													</div>
												</td>
											</tr>
										</table>
			                     	</div>
			                    </div>
							</div>
							<br>
						';
					}else if($video != ""){
						$video = substr($video, -11);
						echo '
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
			                                        <li><a href="include/DenunciarPost.php?id='.$id_pergunta.'">Denunciar publicação</a>
			                                        </li>
			                                    </ul>
			                                </div>
			                            </div>
			                        </div>
			                        <div class="panel-body">
										<table border="0" cellspacing="0" cellpadding="0">
											<table class="post">
													<tr>
														<td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
														<td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<a href="forum.php?id='.base64_encode($idCurso).'"><button type="button" class="btn btn-default">#'.$nomeCurso.'</button></a></td>
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
																	<a class="linkdoPerfil" href="'.$id_pergunta.'">
																		<button type="button" class="btn btn-outline btn-primary btn-xs">Ver todos os comentários</button>
																	</a>	
																</td>
																'; 
																	if($contadorVotou == 0)
																	{
																	?>
																	<td valign="middle" class="botaoPost">
																		<input style="cursor:pointer; float: left;" type="image" width="20" onClick="this.src='../images/staricon.png'; like(this.value);" src="../images/staricondown.png" name="pergunta_envia" id="pergunta_envia" value="<?php echo $id_pergunta; ?>"/> 
																	</td>
																	<td valign="middle">
																		<div id="<?php echo $id_pergunta; ?>" style="display: block; "><?php echo $num_Like; ?></div>
																	</td>
																	<?php 

																	}else{
																		echo '
																			<td valign="middle" class="botaoPost">
																				<input type="image" width="20" src="../images/staricon.png""/>
																			</td>
																			<td valign="middle">
																				'.$num_Like.'
																			</td>
																			';
																	}	
																	echo '
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</table>
										<table>
											<tr>
												<td></td>
												<td align="left"> '; ?>
													<div class="accordions">
														<div class="accordion-item">
														    <input type="checkbox" name="accordion" id="accordion-<?php echo $id_pergunta; ?>" />
														    <label for= "accordion-<?php echo $id_pergunta; ?>"><img src="../images/comentario_post.png" width="25" style="padding-right: 5px;"></label>
															<?php
																$sqlComentario = mysql_query("SELECT r.resposta, r.id_membro, r.data, r.hora, du.Nome, du.Foto FROM respostas r INNER JOIN dados_usuarios du ON r.id_membro = du.ID WHERE r.id_pergunta = $id_pergunta ORDER BY r.id DESC LIMIT 10");
																$contadorComentario = mysql_num_rows($sqlComentario);

																if ($contadorComentario > 0)
																{
																	while($linha = mysql_fetch_array($sqlComentario))
																	{
																		$comentario = $linha['resposta'];
																		$dataComentario = $linha['data'];
																		$horaComentario = $linha['hora'];
																		$id_dono_comentario = $linha['id_membro'];
																	
																		$fotoComentario = $linha['Foto'];
																		$nomeComentario = $linha['Nome'];

																		echo '
																			 <div class="accordion-content">
																				<table class="postagem-comentario-wrap">
																					<tr>
																						<td valign="top" align="left" width="35">
																							<img class="foto-comentario" src="../../uploads/fotos/'.$fotoComentario.'" width="25" height="25"> 
																						</td>
																						<td>
																							<table>
																								<tr>
																									<td class="comentario-post">
																										<a href="profile.php?id='.$id_dono_comentario.'" >'.$nomeComentario.'</a> disse: '.$comentario.'
																									</td>
																								</tr>
																								<tr>
																									<td class="data-comentario-post">
																										'.$dataComentario.' - '.$horaComentario.'
																									</td>
																								</tr>
																							</table>
																						</td>
																					</tr>
																				</table>
																			</div>
																		';
																	}
																	//Verificar se tem mais de 10 comentários
																	if($contadorComentario > 9)
																	{
																		$contadorComentario = "+ ".$contadorComentario;
																	}
																} 
																echo '
														</div>
													</div>
													<div id="comentario-feito'.$id_pergunta.'"></div>
												</td>
											</tr>
											<tr>
												<td valign="top">
													<center><img src="../../uploads/fotos/'.$FOTO.'" width="35" height="35"></center>
												</td>
												<td width="100%">
													<div class="col-lg-12">
														<form name="comentario" id="'.$id_pergunta.'" onsubmit="chamarComentario(this.id); return false;">
															<input id="id_pergunta'.$id_pergunta.'" type="hidden" value="'.$id_pergunta.'" />
															<input id="comentario'.$id_pergunta.'" type="text" class="form-control" placeholder="Escreva um comentário"/>
															<div style="display: none">><input type="submit"></div>
														</form>
														<span style="font-size: 10px; padding-right: 5px;">'.$contadorComentario.' Comentário(s)</span>
													</div>
												</td>
											</tr>
										</table>
									</div>
			                    </div>
							</div><br>
						';
					}else if($imagem != ""){
						echo '
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
			                                        <li><a href="include/DenunciarPost.php?id='.$id_pergunta.'">Denunciar publicação</a>
			                                        </li>
			                                    </ul>
			                                </div>
			                            </div>
			                        </div>
			                        <div class="panel-body">
									<table border="0" cellspacing="0" cellpadding="0">
											<table class="post">
													<tr>
														<td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
														<td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<a href="forum.php?id='.base64_encode($idCurso).'"><button type="button" class="btn btn-default">#'.$nomeCurso.'</button></a></td>
														<td width="7%" align="center"></td>
													</tr>
												<tr>
													
													<td width="10%" align="center"><img src="../images/question.png" width="30" height="30"/></td>
													<td width="85%"><div class="wrap_post">'.$pergunta.'</div></td>
												</tr>
												<tr>
													<td>...</td>
													<td>
														<img src="../../uploads/imgpost/'.$imagem.'" width="100%" alt="" />
													</td>
												</tr>
												<tr>
													<td></td>
													<td>
														<table>
															<tr width="100%">
																<td class="botaoPost">
																	<a class="linkdoPerfil" href="'.$id_pergunta.'">
																		<button type="button" class="btn btn-outline btn-primary btn-xs">Ver todos os comentários</button>
																	</a>
																</td>
																'; 
																	if($contadorVotou == 0)
																	{
																	?>
																	<td valign="middle" class="botaoPost">
																		<input style="cursor:pointer; float: left;" type="image" width="20" onClick="this.src='../images/staricon.png'; like(this.value);" src="../images/staricondown.png" name="pergunta_envia" id="pergunta_envia" value="<?php echo $id_pergunta; ?>"/> 
																	</td>
																	<td valign="middle">
																		<div id="<?php echo $id_pergunta; ?>" style="display: block; "><?php echo $num_Like; ?></div>
																	</td>
																	<?php 

																	}else{
																		echo '
																			<td valign="middle" class="botaoPost">
																				<input type="image" width="20" src="../images/staricon.png""/>
																			</td>
																			<td valign="middle">
																				'.$num_Like.'
																			</td>
																			';
																	}	
																	echo '
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</table>
										<table>
											<tr>
												<td></td>
												<td align="left"> '; ?>
													<div class="accordions">
														<div class="accordion-item">
														    <input type="checkbox" name="accordion" id="accordion-<?php echo $id_pergunta; ?>" />
														    <label for= "accordion-<?php echo $id_pergunta; ?>"><img src="../images/comentario_post.png" width="25" style="padding-right: 5px;"></label>
															<?php
																$sqlComentario = mysql_query("SELECT r.resposta, r.id_membro, r.data, r.hora, du.Nome, du.Foto FROM respostas r INNER JOIN dados_usuarios du ON r.id_membro = du.ID WHERE r.id_pergunta = $id_pergunta ORDER BY r.id DESC LIMIT 10");
																$contadorComentario = mysql_num_rows($sqlComentario);

																if ($contadorComentario > 0)
																{
																	while($linha = mysql_fetch_array($sqlComentario))
																	{
																		$comentario = $linha['resposta'];
																		$dataComentario = $linha['data'];
																		$horaComentario = $linha['hora'];
																		$id_dono_comentario = $linha['id_membro'];
																	
																		$fotoComentario = $linha['Foto'];
																		$nomeComentario = $linha['Nome'];

																		echo '
																			 <div class="accordion-content">
																				<table class="postagem-comentario-wrap">
																					<tr>
																						<td valign="top" align="left" width="35">
																							<img class="foto-comentario" src="../../uploads/fotos/'.$fotoComentario.'" width="25" height="25"> 
																						</td>
																						<td>
																							<table>
																								<tr>
																									<td class="comentario-post">
																										<a href="profile.php?id='.$id_dono_comentario.'" >'.$nomeComentario.'</a> disse: '.$comentario.'
																									</td>
																								</tr>
																								<tr>
																									<td class="data-comentario-post">
																										'.$dataComentario.' - '.$horaComentario.'
																									</td>
																								</tr>
																							</table>
																						</td>
																					</tr>
																				</table>
																			</div>
																		';
																	}
																	//Verificar se tem mais de 10 comentários
																	if($contadorComentario > 9)
																	{
																		$contadorComentario = "+ ".$contadorComentario;
																	}
																} 
																echo '
														</div>
													</div>
													<div id="comentario-feito'.$id_pergunta.'"></div>
												</td>
											</tr>
											<tr>
												<td valign="top">
													<center><img src="../../uploads/fotos/'.$FOTO.'" width="35" height="35"></center>
												</td>
												<td width="100%">
													<div class="col-lg-12">
														<form name="comentario" id="'.$id_pergunta.'" onsubmit="chamarComentario(this.id); return false;">
															<input id="id_pergunta'.$id_pergunta.'" type="hidden" value="'.$id_pergunta.'" />
															<input id="comentario'.$id_pergunta.'" type="text" class="form-control" placeholder="Escreva um comentário"/>
															<div style="display: none">><input type="submit"></div>
														</form>
														<span style="font-size: 10px; padding-right: 5px;">'.$contadorComentario.' Comentário(s)</span>
													</div>
												</td>
											</tr>
										</table>
									</div>
			                    </div>
							</div><br>
						';
					}
				}
			}
		}
	}
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
function chamarComentario(id)
{
	var div = "#comentario-feito"+id;

	//Pegando os valores que foram digitados no formulário e colocando nas variáveis nome e email.
	var comentario = $("#comentario"+id).val();
	var idPergunta = $("#id_pergunta"+id).val();
	$("#comentario"+id).val("");
	//Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
	$.post("include/PostagemComentario.php", { comentario:comentario, idPergunta:idPergunta }, function(get_retorno) {

		$(div).show("slow").append(get_retorno);

	});
}

</script>
