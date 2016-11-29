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

    //recebe variavel
    $id_nota=$_REQUEST['id'];
    $titulo=$_REQUEST['titulo'];
    $nota=$_REQUEST['nota'];
    
?>

<head>

    <script type="text/javascript">

        window.onload = function()  {
            CKEDITOR.replace( 'nota_b' );
          };

        window.onload = function()  {
        CKEDITOR.replace( 'nota_b', {
            uiColor: '#F5F5F5'
        });
        };
    </script>

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
                            <br />
                            <div class="widthstatusNotas">
                                <div id="formulario_nota">
                                    <form action="include/NotasEditar.php" method="POST">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">     
                                            
                                            <tr>
                                                <td>
                                                    <center>
                                                        <textarea id="nota_b" name="nota_b"><?php echo $nota; ?></textarea>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                            <table>
                                                <tr>
                                                    <input type="hidden" name="id_nota" id="id_nota" value="<?php echo $id_nota; ?>">
                                                    <td><input class="email-form" type="text" name="titulo" id="titulo" value="<?php echo $titulo; ?>" size="30" maxlength="50" required assunto=assunto /></td>
                                                    <td><input class="btn btn-primary" type="submit" name="atualizar_notas" id="atualizar_notas" value="Atualizar"></td>
                                                </tr>
                                            </table>
                                                    
                                            </tr>
                                        </table>   
                                    </form>                        
                                </div>
                            </div>

                                <div id="retornoAviso" style="display:none; width: 97%; height: auto; background-color: #0085B2; color: #FFF; padding: 5px; margin: 3px;
                                    float: left; border-top:2px solid #000; border-left:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000;"><br />
                                </div>
                                <div class="visual-notas">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                          <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td width="auto" class="fontebuscah2">Yeeba.me notas</td>
                                              <td width="30" align="center" valign="middle"><a class="tooltipsnota"><img src="../images/importante.png" width="20" height="20" /><span>Importante</span></a></td>
                                              <td width="30" align="center" valign="middle"><a class="tooltipsnota"><img src="../images/editando.png" width="20" height="20" /><span>Editar</span></a></td>
                                              <td width="30" align="center" valign="middle"><a class="tooltipsnota"><img src="../images/excluir_nota.png" width="20" height="20" /><span>Excluir</span></a></td>
                                            </tr>
                                          </table>
                                        </td>
                                    </tr>
                                  <tr>
                                    <td class="font_pequena_preto"><span class="font_pequena_data"><?php date_default_timezone_set('America/Sao_Paulo'); $data = date("d/m/Y"); echo $data; ?></span> Este &eacute; um exemplo de aviso que voc&ecirc; pode deixar, aceitamos o uso de tags pra deixar <b>negrito</b>, <i>it&aacute;lico</i>, se a nota &eacute; importante s&oacute; marcar, ela vai mudar de cor pra facilitar al&eacute;m de ficar no topo, aproveite ao m&aacute;ximo.</td>
                                  </tr>
                                </table>
                                </div>  


                                <?php 
                                //Importantes notas
                                $sql = mysql_query ("SELECT * FROM notas_alunos WHERE id_usuario = '$ID' && importante = 1 ORDER BY id DESC");
                                $contador = mysql_num_rows($sql);
                                    
                                    
                                if ($contador > 0)
                                {
                                    
                                    while($linha = mysql_fetch_array($sql))
                                    {
                                        // capitura as variaveis do banco de dados para serem imprimidas
                                        $id_nota = $linha['id'];
                                        $nota = $linha['nota'];
                                        $titulo = $linha['titulo'];
                                        $data = $linha['data'];
                                        $hora = $linha['hora'];
                                        $importante = $linha['importante'];
                                            
                                             echo'
                                                <div class="visual-notas-import">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td>
                                                          <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td width="auto" class="fontebuscah2">'.$titulo.' <span class="font_pequena_data">'.$data.' - '.$hora.' </span></td>
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
                                ?>

                                <div id="retorno_da_nota">
                                </div>

                                <?php 
                                //Demais notas
                                $sql = mysql_query ("SELECT * FROM notas_alunos WHERE id_usuario = '$ID' && importante != 1 ORDER BY id DESC");
                                $contador = mysql_num_rows($sql);
                                    
                                    
                                if ($contador > 0)
                                {
                                    
                                    while($linha = mysql_fetch_array($sql))
                                    {
                                        // capitura as variaveis do banco de dados para serem imprimidas
                                        $id_nota = $linha['id'];
                                        $nota = $linha['nota'];
                                        $titulo = $linha['titulo'];
                                        $data = $linha['data'];
                                        $hora = $linha['hora'];
                                        $importante = $linha['importante'];

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
