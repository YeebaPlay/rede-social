<?php
include "../../../Config/config_sistema.php";
?>
<?php
	error_reporting(0);
	$ID = $_COOKIE['ID'];
	$NOME = $_COOKIE['NOME'];
	$FOTO = $_COOKIE['FOTO'];
	
	date_default_timezone_set('America/Sao_Paulo');
	$comentario =$_POST['comentario'];
	$idPergunta=$_POST['idPergunta'];
	$data = date("d/m/Y");
	$hora = date("H:i");

	if($comentario != "")
	{
		$insert = "INSERT INTO respostas(nome, resposta, data, hora, id_membro, id_pergunta, foto)
		VALUES('$NOME', '$comentario', '$data', '$hora', '$ID', '$idPergunta', '$FOTO')";
		$query = mysql_query($insert);

		echo'
			<table>
				<tr>
					<td valign="top" align="left" width="35">
						<img class="foto-comentario" src="../../uploads/fotos/'.$FOTO.'" width="25" height="25"> 
					</td>
					<td>
						<table>
							<tr>
								<td class="comentario-post">
									<a href="profile.php?id='.$ID.'" >'.$NOME.'</a> disse: '.$comentario.'
								</td>
							</tr>
							<tr>
								<td class="data-comentario-post">
									'.$data.' - '.$hora.'
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table><br />
		';
	}
 ?>
