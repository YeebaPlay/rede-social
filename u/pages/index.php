<!DOCTYPE html>
<html lang="pt-br">
<?php 

    include "include/validar_session.php"; 
    include "../../Config/config_sistema.php";

    $ID = $_COOKIE['ID'];
    $curso = $_COOKIE['CURSO'];
    $FOTO = $_COOKIE['FOTO'];
    $Sobre = $_COOKIE['SOBRE'];
    $PONTOS = $_COOKIE['PONTOS'];
   
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yeeba.me</title>

    <!-- CSS Padrao -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <!-- Função para fazer upload -->
    <script src="../dist/js/function-upload.js"></script>

</head>

<body>

    <div id="wrapper">
        <?php 
            //Toda página é divida por includes para serem reutilizados
            include "include/MenuSuperior.php"; 
            include "include/MenuLateral.php";
        ?>
            
        <!-- /.navbar-static-side -->

        <div id="page-wrapper">
            <br />
            <div class="row">
                <div class="col-lg-8">
                    <?php
                        if(isset($_GET['info']))
                        {
                            echo '
                                 <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <center>Publicação denunciada!!</center>
                                </div>
                            ';
                        }
                    ?>
                   
                        <!-- /.Aqui fica o código das postagens -->
                        <div class="panel-body">
                            <!-- Modal -->
                            <?php include"include/Modal.php";?>

                            <div id="minhaPergunta" class="widthstatus">

                                <?php 
                                    $sql = mysql_query ("SELECT c.col_des_nome, c.id FROM tb_forum_interacoes fi, tb_curso c WHERE col_id_usuario = $ID AND c.id = fi.col_id_curso ORDER BY id DESC");
                                    $contadorCursos = mysql_num_rows($sql);
                                    if($contadorCursos > 0)
                                    {
                                ?>
                                <!-- Formulário de pergunta -->
                                <center>
                                    <div id="minhaPergunta">
                                        <form action="include/PostagemPublicar.php" method="post" id="upload">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td colspan="2">
                                                        <center>
                                                            <textarea class="form-control" name="pergunta" id="pergunta" placeholder=" Clique aqui e compartilhe algo que vá ajudar alguém." rows="2" cols="75" maxlength="1000" required mensagem=mensagem></textarea>
                                                        </center><br />
                                                    </td>
                                                </tr>
                                                <tr id="rodape_publicacao" style="display: none;" class="rodape-box-pergunta">
                                                    <td>
                                                        <input class="btn btn-primary" style="float: left;" type="submit" value="Publicar" />
                                                        <a href="#" id="video"><img style="margin-left: 5px; margin-top: 4px; float: left;" src="../../css/icon_video.png"></a>
                                                        <div style="cursor: pointer; margin-left: 5px; margin-top: 4px;" class="realupload-imagem"><input class="realupload-imagem-btn" style="cursor: pointer;" type="file" name="file" id="file" accept="image/*" /></div>
                                                        <div class="col-lg-8">
                                                        <input style="display:none;" class="form-control" type="text" name="video_text" id="video_text" placeholder="Url do video do YouTube" size="30" maxlength="255" />
                                                        </div>       
                                                        <img src="../images/ajax-loader.gif" width="40" id="loading-img-post" style="display:none;" alt="Aguarde..."/>
                                                        <div id="outputPost"></div>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if ($contadorCursos > 0)
                                                            {
                                                        ?>
                                                        <select id="forum_selecionado" name="forum_selecionado" class="form-control" required forum=forum>
                                                             <option value="" disabled selected style='display:none;'>Selecione o fórum do post</option>
                                                             <?php while($linha = mysql_fetch_array($sql)) { ?>
                                                             <option value="<?php echo $linha['id'] ?>"><?php echo $linha['col_des_nome'] ?></option>
                                                             <?php } }?>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </center>
                                <?php  
                                } else{
                                    echo '
                                        <div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <center>Antes de publicar você precisa adicionar alguns temas em configurações <a href="config.php">(Clique Aqui)</a>. </center>
                                        </div>
                                    ';
                                }
                            ?>
                            </div>
                        </div>

                        <div style="display: none;" id="carregando_imagem" class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">100% Complete</span>
                            </div>
                        </div>
                       
                    <div class="">
                        <div style="display: none;" id="morris-area-chart"></div>
                    </div>  

                    <div id="preview"></div> <!-- Retorna o post recem publicado -->
                    <div id="retornoPost"></div> <!-- Retorna o post recem publicado -->
                    <div id="conteudo"></div> <!-- Retorna todos os posts -->
                    
                    <center><div style="display: none;" id="gif_carregamento"><img src="../images/ajax-loader.gif" width="50"></div></center>
                    <center><button type="button" class="btn btn-success btn-circle btn-xl" id="clique"><li class="fa fa-undo"></li></button></center>
                    <br /><br />
                    <div class="col-lg-8">
                        <div style="display: none;" id="morris-bar-chart"></div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <?php include "include/MenuNews.php";?>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    <!-- Form para upload de arquivos -->
    <script type="text/javascript" src="../bower_components/jquery/dist/upload/jquery.form.min.js"></script>
   
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Padrao JavaScript -->
    <script src="../dist/js/functions.js"></script>



    <script>

    var categoria = document.getElementById('forum_selecionado').value;

    var $formUpload = document.getElementById('upload'),
        $preview = document.getElementById('preview'),
        i = 0;
    $formUpload.addEventListener('submit', function(event){
      event.preventDefault();
      var xhr = new XMLHttpRequest();
      xhr.open("POST", $formUpload.getAttribute('action'));
      var formData = new FormData($formUpload);
      formData.append("i", i++);
      xhr.send(formData);
      $('#carregando_imagem').show('fast');
      xhr.addEventListener('readystatechange', function() {
      	    var json = JSON.parse(xhr.responseText);
          	$preview.innerHTML = json.post;
            document.getElementById("pergunta").value = "";
            document.getElementById("file").value = "";
            $('#carregando_imagem').hide('fast');
      });
      xhr.upload.addEventListener("progress", function(e) {
        if (e.lengthComputable) {
          var percentage = Math.round((e.loaded * 100) / e.total);
          $preview.innerHTML = String(percentage) + '%';
        }
      }, false);
      xhr.upload.addEventListener("load", function(e){
        $preview.innerHTML = String(100) + '%';
      }, false);
    }, false);
    </script>


</body>
</html>
