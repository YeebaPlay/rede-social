<?php 
    //Fazer a contagem do perfil (Amigos) (Apostilas) (Perguntas)
    $consultaArquivos = mysql_query("select id_arquivo from adicionar_arquivos where id_membro = '$ID'");
    $contArquivos = mysql_num_rows($consultaArquivos);

    $consultaAmigos = mysql_query("select id from contatos where id_membro = '$ID'");
    $contAmigos = mysql_num_rows($consultaAmigos);

    $consultaPerguntas = mysql_query("select id from tb_post where col_id_membro = '$ID'");
    $contPerguntas = mysql_num_rows($consultaPerguntas);

    $consultaMensagens = mysql_query("select id from tb_mensagem_respostas where col_id_remetente = '$ID' AND col_mensagem_nao_lida = 0");
    $contMensagens = mysql_num_rows($consultaMensagens);

    $sqlInteracoesForum = mysql_query ("SELECT fi.id FROM tb_forum_interacoes fi, tb_curso c WHERE col_id_usuario = $ID AND c.id = fi.col_id_curso");
    $contadorInteracoesForum = mysql_num_rows($sqlInteracoesForum);

    $sqlArquivosFavoritos = mysql_query ("SELECT aa.id_arquivo FROM adicionar_arquivos aa, tb_curtir_arquivo ca WHERE ca.col_id_usuario = $ID AND aa.id_arquivo = ca.col_id_apostila AND aa.status != 0");
    $contadorArquivosFavoritos = mysql_num_rows($sqlArquivosFavoritos);
?>
<div class="row">
    <a href="mensagem.php">
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $contMensagens;?></div>
                            <div>Mensagens</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <a href="meusposts.php">
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-edit fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $contPerguntas; ?></div>
                            <div>Publicações</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <a href="arquivo.php">
    <div class="col-lg-2 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-folder-open fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $contArquivos; ?></div>
                        <div>Arquivos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    <a href="contatos.php">
    <div class="col-lg-2 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $contAmigos; ?></div>
                        <div>Amigos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    <a href="explorar.php">
    <div class="col-lg-2 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-paper-plane fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $contadorInteracoesForum; ?></div>
                        <div>Fóruns</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    <a href="favorito.php">
     <div class="col-lg-2 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-heart fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $contadorArquivosFavoritos; ?></div>
                        <div>Favoritos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>