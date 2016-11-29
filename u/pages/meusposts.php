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
                        <?php
                            //MINHAS PERGUNTAS
                            error_reporting(0);
                            $limite = 30; //Limite de post por página
                            $SQL = mysql_query("SELECT * FROM tb_post where col_id_membro = '$ID'"); //Contagem dos elementos do banco por id
                            $SQL_COUNT = mysql_num_rows($SQL);
                            $SQL_RESUL = ceil(($SQL_COUNT) / $limite);
                            
                            //Se existir a página ele mostra no link ?pg=1
                            $pg = $_GET["pg"];
                            if(isset($pg)) {
                                $pg = $pg;
                            } else {
                                $pg = 1;
                            }
                            
                            $start = ($pg - 1) * $limite; //iniciar a paginação no primeiro valor
                            
                            $sql = mysql_query ("SELECT * FROM tb_post where col_id_membro = '$ID' ORDER BY id DESC LIMIT $start, $limite");
                            $contador = mysql_num_rows($sql);
                            
                            if ($contador > 0)
                            {
                                while($linha = mysql_fetch_array($sql))
                                {
                                    $pergunta = $linha['col_pergunta'];
                                    $data = $linha['col_data'];
                                    $id = $linha['col_id_membro'];
                                    $nome = $linha['col_nome'];
                                    $id_pergunta = $linha['id'];
                                    $categoria = $linha['col_categoria'];
                                    $video = $linha['col_video'];
                                    $imagem = $linha['col_imagem'];
                                    $status = $linha['col_status'];
                                    
                                    $sqlLike = mysql_query ("SELECT id FROM tb_curtir_post WHERE col_id_da_postagem = '$id_pergunta'");
                                    $num_Like = mysql_num_rows($sqlLike);

                                    //Verificar se o usuario já votou
                                    $sqlVotou = mysql_query ("SELECT id FROM tb_curtir_post WHERE col_id_de_quem_curtiu = '$ID' AND col_id_da_postagem = '$id_pergunta'");
                                    $contadorVotou = mysql_num_rows($sqlVotou);

                                    if($status != 0){
                                        if($video == "" && $imagem == "")
                                        {
                                        //<input type="text" value="teste" onclick="funcaoCurtir(this.value())" />
                                            echo '
                                                <div class="post-count">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <i class="fa fa-pencil-square-o"></i>
                                                            
                                                            <div class="pull-right">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                        Eu quero...
                                                                        <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu pull-right" role="menu">
                                                                        <li><a href="include/PostagemExcluir.php?id_post='.$id_pergunta.'">Excluir publicação</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="panel-body">
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                <table class="post">
                                                                        <tr>
                                                                            <td width="7%" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$FOTO.'" width="50"/></td>
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
                                                                                    <td valign="middle" class="botaoPost">
                                                                                        <a class="linkdoPerfil" href="'.$id_pergunta.'">
                                                                                            <button type="button" class="btn btn-primary btn-xs">Responder</button>
                                                                                        </a>
                                                                                    </td>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            ';
                                        }else if($video != ""){
                                            $video = substr($video, -11);
                                            echo '
                                                <div class="post-count">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <i class="fa fa-pencil-square-o"></i>
                                                            
                                                            <div class="pull-right">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                        Eu quero...
                                                                        <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu pull-right" role="menu">
                                                                        <li><a href="include/PostagemExcluir.php?id_post='.$id_pergunta.'">Excluir publicação</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                <table class="post">
                                                                        <tr>
                                                                            <td width="7%" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$FOTO.'" width="50"/></td>
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
                                                                                    <td class="botaoPost">
                                                                                        <a class="linkdoPerfil" href="'.$id_pergunta.'">
                                                                                            <button type="button" class="btn btn-primary btn-xs">Responder</button>
                                                                                        </a>    
                                                                                    </td>
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
                                                        </div>
                                                    </div>
                                                </div><br>
                                            ';
                                        }else if($imagem != ""){
                                            echo '
                                                <div class="post-count">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <i class="fa fa-pencil-square-o"></i>
                                                            
                                                            <div class="pull-right">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                        Eu quero...
                                                                        <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu pull-right" role="menu">
                                                                        <li><a href="include/PostagemExcluir.php?id_post='.$id_pergunta.'">Excluir publicação</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                <table class="post">
                                                                        <tr>
                                                                            <td width="7%" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$FOTO.'" width="50"/></td>
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
                                                                                    <td class="botaoPost">
                                                                                        <a class="linkdoPerfil" href="'.$id_pergunta.'">
                                                                                            <button type="button" class="btn btn-primary btn-xs">Responder</button>
                                                                                        </a>
                                                                                    </td>
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
                                                        </div>
                                                    </div>
                                                </div><br>
                                            ';
                                        } 
                                    }
                                }
                            }else{
                                echo'
                                    <div class="alert alert-warning">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <center>Você ainda não publicou.</center>
                                    </div>
                                ';
                            }
                        ?>
                        <br />
                        <table class="contador" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    <u class="pagination">
                                        <?php
                                            if($SQL_RESUL > 1 && $pg<=$SQL_RESUL)
                                            {
                                                for($i=1; $i<=$SQL_RESUL; $i++)
                                                {
                                                    if($pg == $i){
                                                        
                                                    }else{
                                                        
                                                    }
                                                }
                                            }
                                        ?>
                                    </u>
                                </div>

                                <div class="dataTables_paginate paging_simple_numbers">
                                    <u class="pagination">
                                        <?php

                                            // Calculando pagina anterior
                                            $menos = $pg - 1;
                                            // Calculando pagina posterior
                                            $mais = $pg + 1;

                                            $pgs = ceil($SQL_COUNT / $limite);
                                            
                                            if($pgs > 1 ) 
                                            {
                                                if($menos>0){
                                                    echo "<li class='paginate_button'>
                                                            <a href='?pg=$menos' class='texto_paginacao'>Anterior</a> 
                                                          </li>
                                                         "; 
                                                }
                                                 
                                                if(($pg-4) < 1 ){
                                                    $anterior = 1;
                                                }
                                                else{
                                                    $anterior = $pg-4;
                                                }

                                                if(($pg+4) > $pgs ){
                                                    $posterior = $pgs;
                                                }else{
                                                    $posterior = $pg + 4;
                                                }


                                                for($i=$anterior; $i <= $posterior;$i++){
                                                    if($i == $pg) {
                                                        echo'<li class="paginate_button active">
                                                                <a href="?pg='.$i.'"> '.$i.'</a>
                                                             </li>'; 
                                                    }else{
                                                        echo'<li class="paginate_button">
                                                                <a href="?pg='.$i.'"> '.$i.'</a>
                                                             </li>'; 
                                                    }
                                                }
                                                if($mais <= $pgs) {
                                                echo "<li class='paginate_button'> 
                                                        <a href=\"?pg=$mais\" class='texto_paginacao'>Proxima</a>
                                                      </li>   
                                                     ";
                                                }
                                            }
                                        
                                         ?>
                                    </u>
                                 </div>
                            </td>
                          </tr>
                        </table>
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


</body>
</html>
