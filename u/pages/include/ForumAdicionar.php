<?php
	include "../../../Config/config_sistema.php";

	 $ID = $_COOKIE['ID'];

	$nome_forum = $_REQUEST['country_id'];

	$sql = mysql_query("SELECT id FROM tb_curso WHERE col_des_nome = '$nome_forum'");
	$contador = mysql_num_rows($sql);
	if($contador > 0)
	{
		while($linha = mysql_fetch_array($sql))
		{
			$idCurso = $linha['id'];
		}
	}else{
		echo "<center>Inexistente</center>";
		exit;
	}

	$sql = mysql_query ("SELECT id FROM tb_forum_interacoes WHERE col_id_usuario = $ID AND col_id_curso = '$idCurso'");
	$contador = mysql_num_rows($sql);
	if($contador > 0){ 
		exit;
	}


	if($nome_forum != ""){
		// Adicionar forum no banco
		$insert = "INSERT INTO tb_forum_interacoes(col_id_usuario, col_id_curso)
				   VALUES('$ID', '$idCurso')";
		$query = mysql_query($insert);

		$sql = mysql_query ("SELECT id FROM tb_forum_interacoes WHERE col_id_usuario = $ID AND col_id_curso = '$idCurso'");
		$contador = mysql_num_rows($sql);
		while($linha = mysql_fetch_array($sql))
		{
			$idForumInserido = $linha['id'];
		}

		// verifica se foi atualizado os dados
		if($query) {
			echo '
				<div id="'.$idForumInserido.'" class="conteudo-forum" onClick="deletarForum(this.id);">
					<br /><center>'.$nome_forum.'</center><br />
				</div>
				';
		}
	}
?>