<!DOCTYPE html>
<html lang="pt-br">
<?php 
    error_reporting(0);
    include "include/validar_session.php"; 
    include "../../Config/config_sistema.php";

    $ID = $_COOKIE['ID'];
    $curso = $_COOKIE['CURSO'];
    $FOTO = $_COOKIE['FOTO'];
    $Sobre = $_COOKIE['SOBRE'];
    $PONTOS = $_COOKIE['PONTOS'];

    //Receber os parâmetros de busca
    $palavraBuscada = $_GET['b']; //Palavra a ser buscada
    $tipoBusca = $_GET['tipo']; //Tipo de busca, sendo usuário, post etc.
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
                    
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comment fa-fw"></i> Últimas 50 notificações
                        </div>
                        <!-- /.Aqui fica o código das postagens -->
                        <div class="panel-body">
                            <!-- Modal -->
                            <?php include"include/Modal.php";?>
                            <?php 
                                $sql = mysql_query ("SELECT n.*, du.Foto FROM notificacoes n INNER JOIN dados_usuarios du ON n.id_remetente = du.id WHERE id_destino='$ID' ORDER BY id DESC LIMIT 50");
                                
                                $contador = mysql_num_rows($sql);
                                $limite = 0; //Contagem de limite de notificações
                                
                                if ($contador > 0)
                                {
                                    
                                    while($linha = mysql_fetch_array($sql))
                                    {
                                        // capitura as variaveis do banco de dados para serem imprimidas
                                        $mensagem = $linha['mensagem'];
                                        $hora = $linha['hora'];
                                        $foto = $linha['Foto'];
                                        $id_remetente = $linha['id_remetente'];
                                        $tipo = $linha['tipo'];
                                        $id_grupo = $linha['id_grupo'];
                                        
                                       
                                        //acrescenta ao limite de vez que mostra as notificações
                                       
                                            if($tipo != "grupo")
                                            {
                                                echo'
                                                        <a href="profile.php?id='.$id_remetente.'">
                                                            <div>
                                                                <img src="../../uploads/fotos/'.$foto.'" class="msg-photo" alt="Seu avatar" /> 
                                                                <span class="blue">'.$_COOKIE['NOME'].':</span> '.$mensagem.'
                                                                <span class="pull-right text-muted small">&agrave;s: '.$hora.'</span>
                                                            </div>
                                                        </a><br />
                                                ';
                                            }
                                    }
                                }
                            ?>
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>

                    <div class="">
                        <div style="display: none;" id="morris-area-chart"></div>
                    </div>
                    
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


</body>
</html>
