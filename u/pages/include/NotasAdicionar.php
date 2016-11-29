<?php

	include "../../../Config/config_sistema.php"; // Inclui minha conexão com o banco de dados
?>
<?php
	//error_reporting(0);
	$nota=$_REQUEST['nota'];
	$titulo=$_REQUEST['titulo'];
	$ID=$_REQUEST['ID'];
	date_default_timezone_set('America/Sao_Paulo');
	$data = date("d/m/Y");
	$hora = date("H:i");

	if($nota == "")
	{
		echo "<pre><b><center>Não consegui ver nenhuma nota escrita ainda.</center></b></pre>";
		exit;
	}
	
	if($titulo == "")
	{
		echo "<pre><b><center>E o título?</center></b></pre>";
		exit;
	}
	
	
	if($nota != "" && $titulo != ""){
	$insert = "INSERT INTO notas_alunos(nota, data, id_usuario, hora, titulo)
	VALUES('$nota', '$data', '$ID', '$hora', '$titulo')";
	$query = mysql_query($insert);
	//echo '<script>window.location.assign("http://yeeba.me/u/notas/")</script>';
	}
	
	$sql = mysql_query ("SELECT id FROM notas_alunos WHERE id_usuario = '$ID' && nota = '$nota'");
	while($linha = mysql_fetch_array($sql))
	{
		$id_nota = $linha['id'];
	}
	
	echo'
			<div class="visual-notas">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="auto" class="fontebuscah2">'.$titulo.'  <span class="font_pequena_data">'.$data.' - '.$hora.' </span></td>
                            <td width="30" align="center" valign="middle"><a class="tooltipsnota">
                                <form action="paginas/importante.php" method="POST">
                                    <input type="hidden" name="id" value="'.$id_nota.'">
                                    <input type="image" src="../images/importante.png" width="20" height="20" />
                                </form><span>Importante</span></a>
                            </td>
                          <td width="30" align="center" valign="middle"><a class="tooltipsnota">
                              <form action="atualizar.php" method="POST">
                                <input type="hidden" name="id" id="id" value="'.$id_nota.'" />
                                <input value="'.$nota.'" type="hidden" name="nota" id="nota" />
                                <input value="'.$titulo.'" type="hidden" name="titulo" id="titulo" />
                                <input type="image" src="../images/editando.png" id="mostrar_edita" width="20" height="20" />
                              </form><span>Editar</span></a>
                          </td>
                          <td width="30" align="center" valign="middle"><a class="tooltipsnota">
                              <form action="paginas/excluir.php" method="POST">
                                <input type="hidden" name="id" value="'.$id_nota.'">
                                <input type="image" src="../images/excluir_nota.png" width="20" height="20" />
                              </form><span>Excluir</span></a>
                          </td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="font_pequena_preto">'.$nota.'</td>
                  </tr>
                </table>
            </div>
		
			';
 ?>
