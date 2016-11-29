<!DOCTYPE html>
<html lang="pt-br">
<?php 
    include "include/validar_session.php"; 
    include "../../Config/config_sistema.php";

    $ID = $_COOKIE['ID'];
    $curso = $_COOKIE['CURSO'];
    $foto = $_COOKIE['FOTO'];
    $sobre = $_COOKIE['SOBRE'];
    $cont = $_COOKIE['PONTOS'];
    $email = $_COOKIE['EMAIL'];
    $nome = $_COOKIE['NOME'];
    $face = $_COOKIE['FACEBOOK'];
    $tw = $_COOKIE['TWITTER'];
   

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

    <!-- Auto Complete -->

    <script type="text/javascript" src="../js/script.js"></script>

    <script type="text/javascript">

        $("#country_id").blur(function(){ 
           $("#country_list_id").css('display', 'none'); 
        }); 

        $(function(){
            window.setTimeout(function() {
            $("#retorno").hide("slow");
            }, 3000);
        });

        
    </script>
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
            <?php
                //Box de dados 
                include "include/DadosUsuario.php"; 
            ?>
            <div class="row">
                <div class="col-lg-8">
                <!-- Modal -->
                <?php include"include/Modal.php";?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tags fa-fw"></i> Explore os temas mais seguidos
                        </div> 
                        <!-- /.Aqui fica o código das postagens -->
                        <div class="panel-body">
                            <img src="../images/explorar.png" width="100%"><br /><br />
                            <?php 
                                $sql = mysql_query ("
                                        SELECT * FROM tb_curso
                                        WHERE id NOT IN (
                                        SELECT DISTINCT 
                                            c.id
                                        FROM
                                            tb_curso c,
                                            tb_forum_interacoes fi
                                        WHERE 
                                            fi.col_id_usuario = $ID AND
                                            c.id = fi.col_id_curso)
                                    ");

                                $contador = mysql_num_rows($sql);
                                
                                if ($contador > 0)
                                {
                                    while($linha = mysql_fetch_array($sql))
                                    {
                                        $nome_forum = $linha['col_des_nome'];
                                        $id_forum = $linha['id'];

                                        echo '
                                            <div id="'.$id_forum.'" class="conteudo-forum-explorar" onClick="adicionarForum(this.id);">
                                                <br /><center>'.$nome_forum.'</center><br />
                                            </div>
                                        ';
                                    }
                                }else{
                                    echo '
                                        <div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <center>Não encontramos mais fóruns para você seguir.</center>
                                        </div>
                                    ';
                                }

                            ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                    <div style="display: none;" id="morris-area-chart"></div>
            
                    <div class="col-lg-8">
                        <div style="display: none;" id="morris-bar-chart"></div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <?php include "include/MenuNews.php";?>
            </div>
            <!-- /.row -->
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

    <!-- Editor de texto -->
    <script type="text/javascript" src="../bower_components/ckeditor/ckeditor.js"></script> 

    
</body>
</html>
