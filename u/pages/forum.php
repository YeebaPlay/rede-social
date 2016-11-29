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
                            $getIdCurso = $_GET['id'];
                            $getIdCurso = base64_decode($getIdCurso);
                           
                            error_reporting(0);
                            $limite = 30; //Limite de post por página
                            $SQL = mysql_query("SELECT * FROM tb_post where col_categoria = '$idCurso' AND col_status = 1"); //Contagem dos elementos do banco por id
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
                            
                            $sql = mysql_query ("
                                        SELECT
                                            u.Foto,
                                            u.Nome,
                                            p.*,
                                            c.col_des_nome,
                                            uc.col_id_curso
                                        FROM 
                                            tb_curso c,
                                            dados_usuarios u,
                                            tb_forum_interacoes uc,
                                            tb_post p
                                        WHERE   
                                            uc.col_id_usuario = $ID AND 
                                            uc.col_id_curso = c.id AND
                                            p.col_categoria = c.id AND
                                            p.col_status = 1 AND
                                            p.col_id_membro = u.id AND
                                            p.col_categoria = $getIdCurso
                                        ORDER BY p.id DESC LIMIT $start, $limite
                                        ");
                            $contador = mysql_num_rows($sql);
                            
                            if ($contador > 0)
                            {
                                while($linha = mysql_fetch_array($sql))
                                {
                                    $id_pergunta = $linha['id'];
                                    $pergunta = $linha['col_pergunta'];
                                    $id = $linha['col_id_membro'];
                                    $categoria = $linha['col_categoria'];
                                    $video = $linha['col_video'];
                                    $imagem = $linha['col_imagem'];
                                    $status = $linha['col_status'];
                                    $data = $linha['col_data'];
                                    $nomeCurso = $linha['col_des_nome'];
                                    $data = date('d/m/Y - H:i:s', strtotime($data));
                                    $idCurso = $linha['col_id_curso'];


                                    $fotoPergunta = $linha['Foto'];
                                    $nome = $linha['Nome'];
                                    
                                    $sqlLike = mysql_query ("SELECT id FROM tb_curtir_post WHERE col_id_da_postagem = '$id_pergunta'");
                                    $num_Like = mysql_num_rows($sqlLike);

                                    //Verificar se o usuario já votou
                                    $sqlVotou = mysql_query ("SELECT id FROM tb_curtir_post WHERE col_id_de_quem_curtiu = '$ID' AND col_id_da_postagem = '$id_pergunta'");
                                    $contadorVotou = mysql_num_rows($sqlVotou);

                                    if($status != 0)
                                    {
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
                                                                        <li><a href="include/DenunciarPost.php?id='.$id_pergunta.'">Denunciar publicação</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                <table class="post">
                                                                        <tr>
                                                                            <td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
                                                                            <td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default">#'.$nomeCurso.'</button></td>
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
                                                                                            <button type="button" class="btn btn-outline btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Veja todos os comentários">Ver todos os comentários</button>
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
                                                            <table>
                                                                <tr>
                                                                    <td></td>
                                                                    <td align="left"> '; ?>
                                                                        <div class="accordions">
                                                                            <div class="accordion-item">
                                                                                <input type="checkbox" name="accordion" id="accordion-<?php echo $id_pergunta; ?>" />
                                                                                <label for= "accordion-<?php echo $id_pergunta; ?>"><img src="../images/comentario_post.png" width="25" style="padding-right: 5px;"></label>
                                                                                <?php
                                                                                    $sqlComentario = mysql_query("SELECT r.resposta, r.id_membro, r.data, r.hora, du.Nome, du.Foto FROM respostas r INNER JOIN dados_usuarios du ON r.id_membro = du.ID WHERE r.id_pergunta = $id_pergunta ORDER BY r.id DESC LIMIT 10");
                                                                                    $contadorComentario = mysql_num_rows($sqlComentario);

                                                                                    if ($contadorComentario > 0)
                                                                                    {
                                                                                        while($linha = mysql_fetch_array($sqlComentario))
                                                                                        {
                                                                                            $comentario = $linha['resposta'];
                                                                                            $dataComentario = $linha['data'];
                                                                                            $horaComentario = $linha['hora'];
                                                                                            $id_dono_comentario = $linha['id_membro'];
                                                                                        
                                                                                            $fotoComentario = $linha['Foto'];
                                                                                            $nomeComentario = $linha['Nome'];

                                                                                            echo '
                                                                                                 <div class="accordion-content">
                                                                                                    <table class="postagem-comentario-wrap">
                                                                                                        <tr>
                                                                                                            <td valign="top" align="left" width="35">
                                                                                                                <img class="foto-comentario" src="../../uploads/fotos/'.$fotoComentario.'" width="25" height="25"> 
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <table>
                                                                                                                    <tr>
                                                                                                                        <td class="comentario-post">
                                                                                                                            <a href="profile.php?id='.$id_dono_comentario.'" >'.$nomeComentario.'</a> disse: '.$comentario.'
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <td class="data-comentario-post">
                                                                                                                            '.$dataComentario.' - '.$horaComentario.'
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </div>
                                                                                            ';
                                                                                        }
                                                                                        //Verificar se tem mais de 10 comentários
                                                                                        if($contadorComentario > 9)
                                                                                        {
                                                                                            $contadorComentario = "+ ".$contadorComentario;
                                                                                        }
                                                                                    } 
                                                                                    echo '
                                                                            </div>
                                                                        </div>
                                                                        <div id="comentario-feito'.$id_pergunta.'"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td valign="top">
                                                                        <center><img src="../../uploads/fotos/'.$FOTO.'" width="35" height="35"></center>
                                                                    </td>
                                                                    <td width="100%">
                                                                        <div class="col-lg-12">
                                                                            <form name="comentario" id="'.$id_pergunta.'" onsubmit="chamarComentario(this.id); return false;">
                                                                                <input id="id_pergunta'.$id_pergunta.'" type="hidden" value="'.$id_pergunta.'" />
                                                                                <input id="comentario'.$id_pergunta.'" type="text" class="form-control" placeholder="Escreva um comentário"/>
                                                                                <div style="display: none">><input type="submit"></div>
                                                                            </form>
                                                                            <span style="font-size: 10px; padding-right: 5px;">'.$contadorComentario.' Comentário(s)</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
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
                                                                        <li><a href="include/DenunciarPost.php?id='.$id_pergunta.'">Denunciar publicação</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                <table class="post">
                                                                        <tr>
                                                                            <td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
                                                                            <td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default">#'.$nomeCurso.'</button></td>
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
                                                                                            <button type="button" class="btn btn-outline btn-primary btn-xs">Ver todos os comentários</button>
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
                                                            <table>
                                                                <tr>
                                                                    <td></td>
                                                                    <td align="left"> '; ?>
                                                                        <div class="accordions">
                                                                            <div class="accordion-item">
                                                                                <input type="checkbox" name="accordion" id="accordion-<?php echo $id_pergunta; ?>" />
                                                                                <label for= "accordion-<?php echo $id_pergunta; ?>"><img src="../images/comentario_post.png" width="25" style="padding-right: 5px;"></label>
                                                                                <?php
                                                                                    $sqlComentario = mysql_query("SELECT r.resposta, r.id_membro, r.data, r.hora, du.Nome, du.Foto FROM respostas r INNER JOIN dados_usuarios du ON r.id_membro = du.ID WHERE r.id_pergunta = $id_pergunta ORDER BY r.id DESC LIMIT 10");
                                                                                    $contadorComentario = mysql_num_rows($sqlComentario);

                                                                                    if ($contadorComentario > 0)
                                                                                    {
                                                                                        while($linha = mysql_fetch_array($sqlComentario))
                                                                                        {
                                                                                            $comentario = $linha['resposta'];
                                                                                            $dataComentario = $linha['data'];
                                                                                            $horaComentario = $linha['hora'];
                                                                                            $id_dono_comentario = $linha['id_membro'];
                                                                                        
                                                                                            $fotoComentario = $linha['Foto'];
                                                                                            $nomeComentario = $linha['Nome'];

                                                                                            echo '
                                                                                                 <div class="accordion-content">
                                                                                                    <table class="postagem-comentario-wrap">
                                                                                                        <tr>
                                                                                                            <td valign="top" align="left" width="35">
                                                                                                                <img class="foto-comentario" src="../../uploads/fotos/'.$fotoComentario.'" width="25" height="25"> 
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <table>
                                                                                                                    <tr>
                                                                                                                        <td class="comentario-post">
                                                                                                                            <a href="profile.php?id='.$id_dono_comentario.'" >'.$nomeComentario.'</a> disse: '.$comentario.'
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <td class="data-comentario-post">
                                                                                                                            '.$dataComentario.' - '.$horaComentario.'
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </div>
                                                                                            ';
                                                                                        }
                                                                                        //Verificar se tem mais de 10 comentários
                                                                                        if($contadorComentario > 9)
                                                                                        {
                                                                                            $contadorComentario = "+ ".$contadorComentario;
                                                                                        }
                                                                                    } 
                                                                                    echo '
                                                                            </div>
                                                                        </div>
                                                                        <div id="comentario-feito'.$id_pergunta.'"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td valign="top">
                                                                        <center><img src="../../uploads/fotos/'.$FOTO.'" width="35" height="35"></center>
                                                                    </td>
                                                                    <td width="100%">
                                                                        <div class="col-lg-12">
                                                                            <form name="comentario" id="'.$id_pergunta.'" onsubmit="chamarComentario(this.id); return false;">
                                                                                <input id="id_pergunta'.$id_pergunta.'" type="hidden" value="'.$id_pergunta.'" />
                                                                                <input id="comentario'.$id_pergunta.'" type="text" class="form-control" placeholder="Escreva um comentário"/>
                                                                                <div style="display: none">><input type="submit"></div>
                                                                            </form>
                                                                            <span style="font-size: 10px; padding-right: 5px;">'.$contadorComentario.' Comentário(s)</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
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
                                                                        <li><a href="include/DenunciarPost.php?id='.$id_pergunta.'">Denunciar publicação</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                <table class="post">
                                                                        <tr>
                                                                            <td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
                                                                            <td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default">#'.$nomeCurso.'</button></td>
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
                                                                                            <button type="button" class="btn btn-outline btn-primary btn-xs">Ver todos os comentários</button>
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
                                                            <table>
                                                                <tr>
                                                                    <td></td>
                                                                    <td align="left"> '; ?>
                                                                        <div class="accordions">
                                                                            <div class="accordion-item">
                                                                                <input type="checkbox" name="accordion" id="accordion-<?php echo $id_pergunta; ?>" />
                                                                                <label for= "accordion-<?php echo $id_pergunta; ?>"><img src="../images/comentario_post.png" width="25" style="padding-right: 5px;"></label>
                                                                                <?php
                                                                                    $sqlComentario = mysql_query("SELECT r.resposta, r.id_membro, r.data, r.hora, du.Nome, du.Foto FROM respostas r INNER JOIN dados_usuarios du ON r.id_membro = du.ID WHERE r.id_pergunta = $id_pergunta ORDER BY r.id DESC LIMIT 10");
                                                                                    $contadorComentario = mysql_num_rows($sqlComentario);

                                                                                    if ($contadorComentario > 0)
                                                                                    {
                                                                                        while($linha = mysql_fetch_array($sqlComentario))
                                                                                        {
                                                                                            $comentario = $linha['resposta'];
                                                                                            $dataComentario = $linha['data'];
                                                                                            $horaComentario = $linha['hora'];
                                                                                            $id_dono_comentario = $linha['id_membro'];
                                                                                        
                                                                                            $fotoComentario = $linha['Foto'];
                                                                                            $nomeComentario = $linha['Nome'];

                                                                                            echo '
                                                                                                 <div class="accordion-content">
                                                                                                    <table class="postagem-comentario-wrap">
                                                                                                        <tr>
                                                                                                            <td valign="top" align="left" width="35">
                                                                                                                <img class="foto-comentario" src="../../uploads/fotos/'.$fotoComentario.'" width="25" height="25"> 
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <table>
                                                                                                                    <tr>
                                                                                                                        <td class="comentario-post">
                                                                                                                            <a href="profile.php?id='.$id_dono_comentario.'" >'.$nomeComentario.'</a> disse: '.$comentario.'
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <td class="data-comentario-post">
                                                                                                                            '.$dataComentario.' - '.$horaComentario.'
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </div>
                                                                                            ';
                                                                                        }
                                                                                        //Verificar se tem mais de 10 comentários
                                                                                        if($contadorComentario > 9)
                                                                                        {
                                                                                            $contadorComentario = "+ ".$contadorComentario;
                                                                                        }
                                                                                    } 
                                                                                    echo '
                                                                            </div>
                                                                        </div>
                                                                        <div id="comentario-feito'.$id_pergunta.'"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td valign="top">
                                                                        <center><img src="../../uploads/fotos/'.$FOTO.'" width="35" height="35"></center>
                                                                    </td>
                                                                    <td width="100%">
                                                                        <div class="col-lg-12">
                                                                            <form name="comentario" id="'.$id_pergunta.'" onsubmit="chamarComentario(this.id); return false;">
                                                                                <input id="id_pergunta'.$id_pergunta.'" type="hidden" value="'.$id_pergunta.'" />
                                                                                <input id="comentario'.$id_pergunta.'" type="text" class="form-control" placeholder="Escreva um comentário"/>
                                                                                <div style="display: none">><input type="submit"></div>
                                                                            </form>
                                                                            <span style="font-size: 10px; padding-right: 5px;">'.$contadorComentario.' Comentário(s)</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
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
                                            // Calculando pagina anterior
                                            $menos = $pg - 1;
                                            // Calculando pagina posterior
                                            $mais = $pg + 1;

                                            $pgs = ceil($SQL_COUNT / $limite);
                                            
                                            if($pgs > 1 ) 
                                            {
                                                if($menos>0){
                                                    echo "<li class='paginate_button'>
                                                            <a href='?pg=$menos&id=$idCurso' class='texto_paginacao'>Anterior</a> 
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
                                                                <a href="?pg='.$i.'&id='.$idCurso.'"> '.$i.'</a>
                                                             </li>'; 
                                                    }else{
                                                        echo'<li class="paginate_button">
                                                                <a href="?pg='.$i.'&id='.$idCurso.'"> '.$i.'</a>
                                                             </li>'; 
                                                    }
                                                }
                                                if($mais <= $pgs) {
                                                echo "<li class='paginate_button'> 
                                                        <a href=\"?pg=$mais&id=$idCurso\" class='texto_paginacao'>Proxima</a>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript">
    function chamarComentario(id)
    {
        var div = "#comentario-feito"+id;

        //Pegando os valores que foram digitados no formulário e colocando nas variáveis nome e email.
        var comentario = $("#comentario"+id).val();
        var idPergunta = $("#id_pergunta"+id).val();
        $("#comentario"+id).val("");
        //Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
        $.post("include/PostagemComentario.php", { comentario:comentario, idPergunta:idPergunta }, function(get_retorno) {

            $(div).show("slow").append(get_retorno);

        });
    }

    </script>

</body>
</html>
