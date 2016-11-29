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
    $EMAIL = $_COOKIE['EMAIL'];
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
                <!-- Modal -->
                <?php include"include/Modal.php";?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tags fa-fw"></i> Notas
                        </div> 
                        <!-- /.Aqui fica o código das postagens -->
                        <div class="panel-body">
                            <table width="100%" class="">
                                <tr>
                                    <form action="notas_busca.php" name="busca" method="GET">
                                        <td width="55%"><input class="email-form" type="text" name="b" placeholder=" Procurar notas" size="30" maxlength="30" required nome=nome /></td>
                                        <td width="5%"><input class="btn btn-primary" style="cursor:pointer;" type="submit" value="Buscar"></td>
                                        <td width="40%"></td>
                                    </form>
                                </tr>
                            </table>
                            <?php 
                                $nota_busca=$_REQUEST['b'];
                                $sql = mysql_query ("SELECT * FROM notas_alunos WHERE nota OR titulo LIKE '%".$nota_busca."%'");
                                $contador = 0;
                                $contador = mysql_num_rows($sql);
                                $teste = 12;
                                
                                if ($contador > 0)
                                {
                                    while($linha = mysql_fetch_array($sql))
                                    {
                                        // capitura as variaveis do banco de dados para serem imprimidas
                                        $id_nota = $linha['id'];
                                        $id_usuario = $linha['id_usuario'];
                                        $nota = $linha['nota'];
                                        $titulo = $linha['titulo'];
                                        $data = $linha['data'];
                                        $hora = $linha['hora'];
                                        $importante = $linha['importante'];
                                        if($id_usuario == $ID)
                                        {   
                                          echo'
                                                <div class="visual-notas">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td>
                                                          <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td width="auto" class="fontebuscah2">'.$titulo.'  <span class="font_pequena_data">'.$data.' - '.$hora.' </span></td>
                                                                <td width="30" align="center" valign="middle"><a class="tooltipsnota">
                                                                    <form action="include/NotasImportante.php" method="POST">
                                                                        <input type="hidden" name="id" value="'.$id_nota.'">
                                                                        <input type="image" src="../images/importante.png" width="20" height="20" />
                                                                    </form><span>Importante</span></a>
                                                                </td>
                                                              <td width="30" align="center" valign="middle"><a class="tooltipsnota">
                                                                  <form action="notas_view.php" method="POST">
                                                                    <input type="hidden" name="id" id="id" value="'.$id_nota.'" />
                                                                    <input value="'.$nota.'" type="hidden" name="nota" id="nota" />
                                                                    <input value="'.$titulo.'" type="hidden" name="titulo" id="titulo" />
                                                                    <input type="image" src="../images/editando.png" id="mostrar_edita" width="20" height="20" />
                                                                  </form><span>Editar</span></a>
                                                              </td>
                                                              <td width="30" align="center" valign="middle"><a class="tooltipsnota">
                                                                  <form action="include/NotasExcluir.php" method="POST">
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
                                        }   
                                    }  
                                }else{
                                    //Se o contador não achar nada ele imprime mensagem de erro na busca
                                    echo'<br /><br /><center><img src="../images/erro_de_busca.png" width="500" height="400" /></center>';
                                    
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
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-folder-open fa-fw"></i> Últimos arquivos
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-refresh fa-fw"></i> Refresh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-circle fa-fw"></i> Available
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-times fa-fw"></i> Busy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o fa-fw"></i> Away
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-sign-out fa-fw"></i> Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <?php 
                                    $sql = mysql_query ("SELECT * FROM adicionar_arquivos WHERE status != 0 AND tamanho_arquivo != 0 ORDER BY id_arquivo DESC LIMIT 8" );
                                    
                                    while($linha = mysql_fetch_array($sql))
                                    {
                                        
                                        $nome = $linha['nome_arquivo'];
                                        $link = $linha['link_arquivo'];
                                        $tamanho = $linha['tamanho_arquivo'];
                                        $tipo = $linha['tipo_arquivo'];
                                        
                                        
                                        if($tipo == "pdf")
                                        {
                                            echo '
                                                <a href="../../../uploads/'.$link.'" class="list-group-item">
                                                    <img src="../images/arquivo/pdf.png" width="15"/></i> '.$nome.'
                                                    <span class="pull-right text-muted small"><em>'.$tamanho.'Kb</em>
                                                    </span>
                                                </a>
                                            ';
                                    
                                        }else{
                                            
                                            if($tipo == "png" || $tipo == "jpg" || $tipo == "gif")
                                            { 
                                                
                                                echo '
                                                    <a href="../../../uploads/'.$link.'" class="list-group-item">
                                                        <img src="../images/arquivo/fotos.png" width="15"/></i> '.$nome.'
                                                        <span class="pull-right text-muted small"><em>'.$tamanho.'Kb</em>
                                                        </span>
                                                    </a>
                                                ';
                                            }else{
                                                if($tipo == "docx" || $tipo == "doc")
                                                {
                                                    echo '
                                                        <a href="../../../uploads/'.$link.'" class="list-group-item">
                                                            <img src="../images/arquivo/word.png" width="15"/></i> '.$nome.'
                                                            <span class="pull-right text-muted small"><em>'.$tamanho.'Kb</em>
                                                            </span>
                                                        </a>
                                                    ';  
                                                }else{
                                                    if($tipo == "zip")
                                                    {
                                                        
                                                        echo '
                                                            <a href="../../../uploads/'.$link.'" class="list-group-item">
                                                                <img src="../images/arquivo/zip.png" width="15"/></i> '.$nome.'
                                                                <span class="pull-right text-muted small"><em>'.$tamanho.'Kb</em>
                                                                </span>
                                                            </a>
                                                        ';
                                                            
                                                    }else{
                                                            
                                                        if($tipo == "rar")
                                                        {
                                                            
                                                            echo '
                                                                <a href="../../../uploads/'.$link.'" class="list-group-item">
                                                                    <img src="../images/arquivo/rar.png" width="15"/></i> '.$nome.'
                                                                    <span class="pull-right text-muted small"><em>'.$tamanho.'Kb</em>
                                                                    </span>
                                                                </a>
                                                            ';  
                                                        }           
                                                    }       
                                                }   
                                            }
                                        }//fim do else
                                    }
                                ?>
                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">Ver mais</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Donut Chart Example
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                            <a href="#" class="btn btn-default btn-block">View Details</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                            Publicidade
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <script type="text/javascript">
                                bb_bid = "1682682";
                                bb_lang = "pt-BR";
                                bb_name = "custom";
                                bb_limit = "6";
                                bb_format = "bbn";
                            </script>
                            <script type="text/javascript" src="http://static.boo-box.com/javascripts/embed.js"></script>
                        </div>
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
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
