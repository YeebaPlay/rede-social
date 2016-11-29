<?php 

include "../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados

?>
<div class="buscador_home">

<?php 
	error_reporting(0);
	$busca=$_GET['busca'];
	$limite = 40; //Limite de post por página
	$total = mysql_query("SELECT id_arquivo FROM adicionar_arquivos WHERE nome_arquivo LIKE '%".$busca."%' AND status != 0");
	$contadorTotal = mysql_num_rows($total);
	
	//Se existir a página ele mostra no link ?pg=1
	$pg = $_GET["pg"];
	if(isset($pg)) {
		$pg = $pg;
	} else {
		$pg = 1;
	}
	
	$start = ($pg - 1) * $limite; //iniciar a paginação no primeiro valor
	
	
	$sql = mysql_query ("SELECT * FROM adicionar_arquivos WHERE nome_arquivo LIKE '%".$busca."%' && status != 0 ORDER BY id_arquivo DESC LIMIT $start, $limite" );
	$contador = mysql_num_rows($sql);
	
	
	if ($contador > 0 && $busca != "")
	{
		while($linha = mysql_fetch_array($sql))
		{
			
			$nome = $linha['nome_arquivo'];
			$link = $linha['link_arquivo'];
			$data = $linha['data_arquivo'];
			$tamanho = $linha['tamanho_arquivo'];
			$tipo = $linha['tipo_arquivo'];
			
			
			
			if($tipo == "pdf")
			{

			echo '
				<table class="busca_arquivos_home" width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="19%" height="68">&nbsp;&nbsp;&nbsp;
							<img class="" src="../../u/imagens/pdf.png" width="50"/>
						</td>
						<td width="81%">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>' .$nome.'</td>
								</tr>
								<tr>
									<td class="font_curso_usuario">Tamanho: '.$tamanho.' kb</td>
								</tr>
								<tr>
									<td class="font_descricao_usuario">
										'.$data.'
									</td>
									
								</tr>
							</table>
						</td>
						<td>
							<a class="tooltipsbusca" target="_blank" href="../../uploads/'.$link.'"><img height="30" src="../../u/imagens/baixar_apostila.png"><span>Donwload</span></a>
						</td>
						<td>
							&nbsp;&nbsp;
						</td>
					</tr>
				</table>

			
			';
		
			}else{
				
					if($tipo == "png" || $tipo == "jpg" || $tipo == "gif")
					{ 
						
						echo '
			
			
							<table class="busca_arquivos_home" width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="19%" height="68">&nbsp;&nbsp;&nbsp;
										<img class="" src="../../u/imagens/fotos.png" width="50"/>
									</td>
									<td width="81%">
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td>' .$nome.'</td>
											</tr>
											<tr>
												<td class="font_curso_usuario">Tamanho: '.$tamanho.' kb</td>
											</tr>
											<tr>
												<td class="font_descricao_usuario">
													'.$data.'
												</td>
												
											</tr>
										</table>
									</td>
									<td>
										<a class="tooltipsbusca" target="_blank" href="../../uploads/'.$link.'"><img height="30" src="../../u/imagens/baixar_apostila.png"><span>Donwload</span></a>
									</td>
									<td>
										&nbsp;&nbsp;
									</td>
								</tr>
							</table>

			
						';
						
							
					}else{
							if($tipo == "docx" || $tipo == "doc")
							{
								echo '
				
				
								<table class="busca_arquivos_home" width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="19%" height="68">&nbsp;&nbsp;&nbsp;
											<img class="" src="../../u/imagens/word.png" width="50"/>
										</td>
										<td width="81%">
											<table width="100%" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td>' .$nome.'</td>
												</tr>
												<tr>
													<td class="font_curso_usuario">Tamanho: '.$tamanho.' kb</td>
												</tr>
												<tr>
													<td class="font_descricao_usuario">
														'.$data.'
													</td>
													
												</tr>
											</table>
										</td>
										<td>
											<a class="tooltipsbusca" target="_blank" href="../../uploads/'.$link.'"><img height="30" src="../../u/imagens/baixar_apostila.png"><span>Donwload</span></a>
										</td>
										<td>
											&nbsp;&nbsp;
										</td>
									</tr>
								</table>
	
				
								';	
							}else{
									if($tipo == "zip")
									{
										
								echo '
								<table class="busca_arquivos_home" width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="19%" height="68">&nbsp;&nbsp;&nbsp;
												<img class="" src="../../u/imagens/zip.png" width="50"/>
											</td>
											<td width="81%">
												<table width="100%" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td>' .$nome.'</td>
													</tr>
													<tr>
														<td class="font_curso_usuario">Tamanho: '.$tamanho.' kb</td>
													</tr>
													<tr>
														<td class="font_descricao_usuario">
															'.$data.'
														</td>
														
													</tr>
												</table>
											</td>
											<td>
												<a class="tooltipsbusca" target="_blank" href="../../uploads/'.$link.'"><img height="30" src="../../u/imagens/baixar_apostila.png"><span>Donwload</span></a>
											</td>
											<td>
												&nbsp;&nbsp;
											</td>
										</tr>
									</table>
								';
										
									}else{
										
											if($tipo == "rar")
											{
												
												echo '
													<table class="busca_arquivos_home" width="100%" border="0" cellpadding="0" cellspacing="0">
														<tr>
															<td width="19%" height="68">&nbsp;&nbsp;&nbsp;
																<img class="" src="../../u/imagens/rar.png" width="50"/>
															</td>
															<td width="81%">
																<table width="100%" border="0" cellpadding="0" cellspacing="0">
																	<tr>
																		<td>' .$nome.'</td>
																	</tr>
																	<tr>
																		<td class="font_curso_usuario">Tamanho: '.$tamanho.' kb</td>
																	</tr>
																	<tr>
																		<td class="font_descricao_usuario">
																			'.$data.'
																		</td>
																		
																	</tr>
																</table>
															</td>
															<td>
																<a class="tooltipsbusca" target="_blank" href="../../uploads/'.$link.'"><img height="30" src="../../u/imagens/baixar_apostila.png"><span>Donwload</span></a>
															</td>
															<td>
																&nbsp;&nbsp;
															</td>
														</tr>
													</table>
													';
													
											}else
											{
												echo '
													<table class="busca_arquivos_home" width="100%" border="0" cellpadding="0" cellspacing="0">
														<tr>
															<td width="19%" height="68">&nbsp;&nbsp;&nbsp;
																<img class="" src="../../u/imagens/nada.png" width="50"/>
															</td>
															<td width="81%">
																<table width="100%" border="0" cellpadding="0" cellspacing="0">
																	<tr>
																		<td>' .$nome.'</td>
																	</tr>
																	<tr>
																		<td class="font_curso_usuario">Tamanho: '.$tamanho.' kb</td>
																	</tr>
																	<tr>
																		<td class="font_descricao_usuario">
																			'.$data.'
																		</td>
																		
																	</tr>
																</table>
															</td>
															<td>
																<a class="tooltipsbusca" target="_blank" href="../../uploads/'.$link.'"><img height="30" src="../../u/imagens/baixar_apostila.png"><span>Donwload</span></a>
															</td>
															<td>
																&nbsp;&nbsp;
															</td>
														</tr>
													</table>
													';
											}
										
										}
								
								}
						
						}
				
				}//fim do else
			
			
			
		}

	}else{
		
		echo'<br /><br /><center><img src="../../u/imagens/erro_de_busca.png" width="500" height="400" /></center>';
		$SQL_RESUL = 0;
		
		}

?>

<center>
	<table class="contador" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  	<td>
		    <?php

			// Calculando pagina anterior
			$menos = $pg - 1;
			// Calculando pagina posterior
			$mais = $pg + 1;

			$pgs = ceil($contadorTotal / $limite);
			
			if($pgs > 1 ) 
			{
				if($menos>0){
					echo "<a href='?pg=$menos&busca=$busca' class='texto_paginacao'>Anterior</a> "; 
				}
				 
				if(($pg-4) < 1 ){
					$anterior = 1;
				}
				else{
					$anterior = $pg-4;
				}

				if(($pg+4) > $pgs ){
					$posterior = $pgs;
				}else{
					$posterior = $pg + 4;
				}


				for($i=$anterior; $i <= $posterior;$i++){
					if($i != $pg) {
						echo " <a href=\"?pg=".($i)."&busca=".($busca)."\" class='texto_paginacao'>$i</a>";
					}else{
						echo " <strong class='texto_paginacao_pgatual'>".$i."</strong>";
					}
				}
				if($mais <= $pgs) {
				echo " <a href=\"?pg=$mais&busca=$busca\" class='texto_paginacao'>Proxima</a>";
				}
			}
			
			 ?>
		    </td>
		</tr>
	</table>
</center>

</div>