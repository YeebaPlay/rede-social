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
                <!-- Modal -->
                <?php include"include/Modal.php";?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comment fa-fw"></i>
                        </div>
                        <!-- /.Aqui fica o código das postagens -->
                        <div class="panel-body">
                            <?php
                                $id_pergunta =$_GET['id'];
                                //PERGUNTAS
                                $sql = mysql_query ("SELECT tp.*, du.Foto, du.Nome FROM tb_post tp INNER JOIN dados_usuarios du ON du.ID = tp.col_id_membro WHERE tp.id = $id_pergunta ");
                                $contador = mysql_num_rows($sql);
                                
                                if ($contador > 0)
                                {
                                    while($linha = mysql_fetch_array($sql))
                                    {
                                        
                                        $pergunta = $linha['col_pergunta'];
                                        $data = $linha['col_data'];
                                        $id = $linha['col_id_membro'];
                                        $id_pergunta = $linha['id'];
                                        $categoria = $linha['col_categoria'];
                                        $video = $linha['col_video'];
                                        $imagem = $linha['col_imagem'];
                                        $status = $linha['col_status'];
                                        $data = date('d/m/Y - H:i:s', strtotime($data));
                                        
                                        $nome = $linha['Nome'];
                                        $fotoPergunta = $linha['Foto'];
                                    
                                        if($status != 0){
                                        
                                            $sqlLike = mysql_query ("SELECT id FROM tb_curtir_post WHERE col_id_da_postagem = '$id_pergunta'");
                                            $num_Like = mysql_num_rows($sqlLike);

                                            //Verificar se o usuario já votou
                                            $sqlVotou = mysql_query ("SELECT id FROM tb_curtir_post WHERE col_id_de_quem_curtiu = '$ID' AND col_id_da_postagem = '$id_pergunta'");
                                            $contadorVotou = mysql_num_rows($sqlVotou);

                                            if($video == "" && $imagem == "")
                                            {
                                            //<input type="text" value="teste" onclick="funcaoCurtir(this.value())" />
                                                echo '
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <table class="post_perfil">
                                                                <tr>
                                                                    <td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
                                                                    <td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'</td>
                                                                    <td width="7%" align="center"></td>
                                                                </tr>
                                                            <tr>
                                                                
                                                                <td width="10%" align="center"><img src="../images/question.png" width="30" height="30"/></td>
                                                                <td width="85%"><div class="wrap_post">'.$pergunta.'</div></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <table>
                                                                        <tr width="100%">
                                                                            '; 
                                                                                if($contadorVotou == 0)
                                                                                {
                                                                                ?>
                                                                                <td valign="middle" class="botaoPost">
                                                                                    <input style="cursor:pointer; float: left;" type="image" width="20" onClick="this.src='../images/staricon.png'; like(this.value);" src="../images/staricondown.png" name="pergunta_envia" id="pergunta_envia" value="<?php echo $id_pergunta; ?>"/> 
                                                                                </td>
                                                                                <td valign="middle">
                                                                                    <div id="<?php echo $id_pergunta; ?>" style="display: block; "><?php echo $num_Like; ?></div>
                                                                                </td>
                                                                                <?php 

                                                                                }else{
                                                                                    echo '
                                                                                        <td valign="middle" class="botaoPost">
                                                                                            <input type="image" width="20" src="../images/staricon.png""/>
                                                                                        </td>
                                                                                        <td valign="middle">
                                                                                            '.$num_Like.'
                                                                                        </td>
                                                                                        ';
                                                                                }   
                                                                                echo '
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </table>
                                                ';
                                            }else if($video != ""){
                                                $video = substr($video, -11);
                                                echo '
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <table class="post_perfil">
                                                                <tr>
                                                                    <td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
                                                                    <td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'</td>
                                                                    <td width="7%" align="center"></td>
                                                                </tr>
                                                            <tr>
                                                                
                                                                <td width="10%" align="center"><img src="../images/question.png" width="30" height="30"/></td>
                                                                <td width="85%"><div class="wrap_post">'.$pergunta.'</div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>...</td>
                                                                <td>
                                                                    <iframe width="100%" height="350" src="//www.youtube.com/embed/'.$video.'" frameborder="0" allowfullscreen></iframe>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <table>
                                                                        <tr width="100%">
                                                                            '; 
                                                                                if($contadorVotou == 0)
                                                                                {
                                                                                ?>
                                                                                <td valign="middle" class="botaoPost">
                                                                                    <input style="cursor:pointer; float: left;" type="image" width="20" onClick="this.src='../images/staricon.png'; like(this.value);" src="../images/staricondown.png" name="pergunta_envia" id="pergunta_envia" value="<?php echo $id_pergunta; ?>"/> 
                                                                                </td>
                                                                                <td valign="middle">
                                                                                    <div id="<?php echo $id_pergunta; ?>" style="display: block; "><?php echo $num_Like; ?></div>
                                                                                </td>
                                                                                <?php 

                                                                                }else{
                                                                                    echo '
                                                                                        <td valign="middle" class="botaoPost">
                                                                                            <input type="image" width="20" src="../images/staricon.png""/>
                                                                                        </td>
                                                                                        <td valign="middle">
                                                                                            '.$num_Like.'
                                                                                        </td>
                                                                                        ';
                                                                                }   
                                                                            echo '
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </table>
                                                ';
                                            }else if($imagem != ""){
                                                echo '
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <table class="post_perfil">
                                                                <tr>
                                                                    <td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
                                                                    <td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'</td>
                                                                    <td width="7%" align="center"></td>
                                                                </tr>
                                                            <tr>
                                                                
                                                                <td width="10%" align="center"><img src="../images/question.png" width="30" height="30"/></td>
                                                                <td width="85%"><div class="wrap_post">'.$pergunta.'</div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>...</td>
                                                                <td>
                                                                    <img src="../../uploads/imgpost/'.$imagem.'" width="100%" alt="" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <table>
                                                                        <tr width="100%">
                                                                            '; 
                                                                                if($contadorVotou == 0)
                                                                                {
                                                                                ?>
                                                                                <td valign="middle" class="botaoPost">
                                                                                    <input style="cursor:pointer; float: left;" type="image" width="20" onClick="this.src='../images/staricon.png'; like(this.value);" src="../images/staricondown.png" name="pergunta_envia" id="pergunta_envia" value="<?php echo $id_pergunta; ?>"/> 
                                                                                </td>
                                                                                <td valign="middle">
                                                                                    <div id="<?php echo $id_pergunta; ?>" style="display: block; "><?php echo $num_Like; ?></div>
                                                                                </td>
                                                                                <?php 

                                                                                }else{
                                                                                    echo '
                                                                                        <td valign="middle" class="botaoPost">
                                                                                            <input type="image" width="20" src="../images/staricon.png""/>
                                                                                        </td>
                                                                                        <td valign="middle">
                                                                                            '.$num_Like.'
                                                                                        </td>
                                                                                        ';
                                                                                }   
                                                                            echo '
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </table>
                                                ';
                                            }
                                        }
                                    }
                                }
                            ?>
                            <div style="display: none;" id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                    <div class="panel panel-default">
                        
                        <!-- /.Aqui fica o código das postagens -->
                        <div class="panel-body">
                            <?php 

                                //RESPOSTAS
                                
                                $sql = mysql_query ("SELECT * FROM respostas WHERE id_pergunta = '$id_pergunta' ORDER BY id DESC");
                                $cont = mysql_num_rows($sql);
                                
                                if ($cont > 0)
                                {
                                    while($linha = mysql_fetch_array($sql))
                                    {
                                        
                                        $resposta = $linha['resposta'];
                                        $data = $linha['data'];
                                        $hora = $linha['hora'];
                                        $id_da_pergunta = $linha['id_pergunta'];
                                        $nome = $linha['nome'];
                                        $fotoResposta = $linha['foto'];
                                        $id_membro = $linha['id_membro'];
                                        $id_resposta = $linha['id'];
                                    
                                        if($status != 0){
                                        if($ID == $id_membro)
                                        {
                                            echo '
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                            <table class="box-postagem-resposta">
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><a class="linkdoPerfil" href="profile.php?id='.$id_membro.'">'.$nome.'</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="5%" valign="top" align="center" >
                                                                        <img class="imagem-perfil-respostas" src="../../uploads/fotos/'.$fotoResposta.'" width="30" height="30"/><br /><br />
                                                                        <form action="include/RespostaDeletar.php" method="POST">
                                                                            <input type="hidden" name="codigo" value="'.$id_resposta.'">
                                                                            <input type="hidden" name="id_da_pergunta" value="'.$id_da_pergunta.'">
                                                                            <input type="image" src="../images/delete.png" width="20" value="X" />
                                                                        </form>
                                                                    </td>
                                                                    <td width="2%"></td>
                                                                    <td width="88%" class="balao-resposta"><div class="wrap_post_comentario">'.$resposta.'</div><br/><apan class="fonteDataMensagem">'.$data.' &agrave;s '.$hora.'</span></td>
                                                                    
                                                                </tr>
                                                            </table>
                                                    </table>
                                            ';
                                        }
                                        else
                                        {
                                            
                                            echo '
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                            <table class="box-postagem-resposta">
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><a class="linkdoPerfil" href="profile.php?id='.$id_membro.'">'.$nome.'</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="5%" valign="top" align="center" >
                                                                        <img class="imagem-perfil-respostas" src="../../uploads/fotos/'.$fotoResposta.'" width="30" height="30"/>
                                                                    </td>
                                                                    <td width="2%"></td>
                                                                    <td width="88%" class="balao-resposta"><div class="wrap_post_comentario">'.$resposta.'</div><br/><apan class="fonteDataMensagem">'.$data.' &agrave;s '.$hora.'</span></td>
                                                                    
                                                                </tr>
                                                            </table>
                                                    </table>
                                            ';
                                        }
                                    }
                                    }
                                }
                            ?>
                            <?php if($status != 0){ ?>
                            <br />
                            <form action="include/PostagemResponder.php" name="email" method="POST">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">       
                                    <tr>
                                        <td>
                                            <center>
                                            <textarea class="textarea-perguntas" name="resposta" placeholder=" Ajude se puder" rows="7" cols="70" maxlength="350"></textarea>
                                            </center>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class=""> 
                                            <input style="cursor:pointer;" class="btn btn-primary" type="submit" name="email_envia" value="Responder">
                                        </td>
                                        <td>
                                            <input type="hidden" name="id_pergunta" value="<?php echo $id_pergunta; ?>" />
                                        </td>
                                    </tr>
                                </table>                           
                            </form>
                            <?php }else{

                                    echo '
                                        <table class="">
                                            <tr>
                                                <td>
                                                    <div style="width: 570px; font-family:Calibri, Verdana; font-size: 15px; border: 2px solid #000000; background: #00B259; text-align: center; padding: 10px 10px 10px 10px; color: #FFFFFF;">
                                                        Nada por aqui.
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    ';

                                } ?>
                        </div>
                        <!-- /.panel-body -->
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
