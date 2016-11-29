<?php
	include "../../../Config/config_sistema.php";

	//Obter dados
	$ID = $_COOKIE['ID'];
	$nomeForum = $_REQUEST['nomeForum'];

	//Verificar se já existe um fórum com o mesmo nome
	$sql = mysql_query("SELECT id FROM tb_curso WHERE col_des_nome = '$nomeForum'");
	$contador = mysql_num_rows($sql);
	if($contador > 0)
	{
		echo "1";
	}else{
		if($nomeForum != "")
		{
			// Adicionar forum no banco
			$insert = "INSERT INTO tb_curso(col_des_nome, col_id_dono)
					   VALUES('$nomeForum', '$ID')";
			$query = mysql_query($insert);

			//Selecionar o id do forum inserido
			$sql = mysql_query("SELECT id FROM tb_curso WHERE col_des_nome = '$nomeForum'");
			$contador = mysql_num_rows($sql);
			while($linha = mysql_fetch_array($sql))
			{
				$idCurso = $linha['id'];
			}

			// Adicionar interação no banco
			$insert = "INSERT INTO tb_forum_interacoes(col_id_usuario, col_id_curso)
					   VALUES('$ID', '$idCurso')";
			$query = mysql_query($insert);

			//Selecionar interação inserida
			$sql = mysql_query ("SELECT id FROM tb_forum_interacoes WHERE col_id_usuario = $ID AND col_id_curso = $idCurso");
			$contador = mysql_num_rows($sql);
			while($linha = mysql_fetch_array($sql))
			{
				$idForumInserido = $linha['id'];
			}

			// verifica se foi atualizado os dados
			if($idForumInserido != "") 
			{
				echo '
					<div id="'.$idForumInserido.'" class="conteudo-forum" onClick="deletarForum(this.id);">
						<br /><center>'.$nomeForum.'</center><br />
					</div>
					';
			}
		}else{
			echo "Nome não foi preenchido!!";
		}
	}
?>