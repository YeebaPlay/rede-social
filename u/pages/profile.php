<!DOCTYPE html>
<html lang="pt-br">
<?php 
    error_reporting(0);
    include "include/validar_session.php"; 
    include "../../Config/config_sistema.php";

    $ID = $_COOKIE['ID'];
    $curso = $_COOKIE['CURSO'];
    $foto = $_COOKIE['FOTO'];
    $cont = $_COOKIE['PONTOS'];
    $email = $_COOKIE['EMAIL'];
    $nome = $_COOKIE['NOME'];
  

    $idUsuario = $_REQUEST['id'];
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
            <?php
                
                //Fazer a contagem do perfil (Amigos) (Apostilas) (Perguntas)
                $consultaArquivos = mysql_query("select id_arquivo from adicionar_arquivos where id_membro = '$idUsuario'");
                $contArquivos = mysql_num_rows($consultaArquivos);

                $consultaAmigos = mysql_query("select id from contatos where id_membro = '$idUsuario'");
                $contAmigos = mysql_num_rows($consultaAmigos);

                $consultaPerguntas = mysql_query("select id from tb_post where col_id_membro = '$idUsuario'");
                $contPerguntas = mysql_num_rows($consultaPerguntas);

                //Dados do usuário
                $buscaPerfil = mysql_query("SELECT * FROM dados_usuarios WHERE ID='".$idUsuario."'");
                $contPerfil = mysql_num_rows($buscaPerfil);
                if($contPerfil > 0)
                {
                    while($linha = mysql_fetch_object($buscaPerfil)) 
                    {
                        $idMembroPerfil = $linha->ID;
                        $nomeMembroPerfil = $linha->Nome;  
                        $fotoMembroPerfil = $linha->Foto; 
                        $cursoMembroPerfil = $linha->curso; 
                        $emailMembroPerfil = $linha->Email; 
                        $sobreMembroPerfil = $linha->Sobre;
                        $contMembroPerfil = $linha->Pontos;
                        $facebookMembroPerfil = $linha->Facebook;
                        $twitterMembroPerfil = $linha->Twitter;

                    }//fim do while
                }else{
                    echo '
                         <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <center>Perfil não existe!!</center>
                        </div>
                    ';
                    exit;
                }
                

            ?>

            <div class="row">
                <div class="col-lg-8">
                <!-- Modal -->
                <?php include"include/Modal.php";?>
                    <div class="panel panel-default">
                        
                        <!-- /.Aqui fica o código das postagens -->
                        <div class="panel-body">
                            <div style="background-image: url(../images/yeebaperfil.png); height: 120px; width: auto;">
                          
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">     
                                    <tr>
                                        <td align="center"> <br />
                                        <center><div class="nome-perfil-usuario"><?php echo $nomeMembroPerfil; ?></div></center>
                                        <br />
                                        <br />
                                            &nbsp; &nbsp;  <?php echo '<center><img class="foto-perfil-user-publico" src="../../uploads/fotos/'.$fotoMembroPerfil.'" /></center>'; ?> 
                                        </td>
                                    <tr/>
                                    <tr>
                                        <td>
                                        
                                        </td>
                                        
                                    </tr>
                                </table>
                            </div>

                                <table class="perfildescricao">
                                    <tr>
                                    
                                        <td  width="27%">
                                            
                                            <table> 
                                                <tr>
                                                    <td>
                                                        <table class="info-perfil">
                                                            <tr>
                                                                <td width="95">
                                                                    <center>
                                                                        <div class="sizeitens">Amigos</div>
                                                                        <div class="fontedescricao"><?php echo $contAmigos; ?></div>
                                                                        <div class="faixaperfil"></div>
                                                                    </center>               
                                                                </td>
                                                                <td width="95">
                                                                    <center>
                                                                        <div class="sizeitens">Apostilas</div>
                                                                        <div class="fontedescricao"><?php echo $contArquivos; ?></div>
                                                                        <div class="faixaperfil"></div>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        
                                        </td>
                                        <td class="nomeperfil" name="nome_destino" width="50%"></td>
                                        <td width="20%">
                                            <?php
                                            $flag = 0;
                                            
                                            $busca_membros = mysql_query("SELECT * FROM contatos WHERE id_membro='".$ID."'");
                                            while($linha = mysql_fetch_object($busca_membros)) 
                                                {
                                                    $id_adicionado = $linha->id_adicionado;
                                                    $id_membro = $linha->id_membro;
                                                            
                                                        if($ID == $id_membro && $id_adicionado == $idUsuario)
                                                        {       
                                                            $flag = 1;
                                                        }

                                                }//fim do while
                                            
                                            if($flag == 0)
                                            {
                                                if($idUsuario != $ID)
                                                {
                                                    echo '
                                                        <div id="adicionar">
                                                            <div class="btn btn-outline btn-info"> 
                                                                <input type="hidden" name="nome" id="nome" value="'.$nomeMembroPerfil.'">
                                                                <input type="hidden" name="id_adicionado" id="id_adicionado" value="'.$idMembroPerfil.'">
                                                                <input type="hidden" name="foto" id="foto" value="'.$fotoMembroPerfil.'">
                                                                <input type="hidden" name="curso" id="curso" value="'.$cursoMembroPerfil.'">
                                                            Adicionar Contato
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="remover" style="display:none;">
                                                            <div class="btn btn-outline btn-danger"> 
                                                                <input type="hidden" name="id_adicionado" id="id_adicionado" value="'.$idMembroPerfil.'">
                                                                Excluir Contato
                                                            </div>
                                                        </div>

                                                        ';
                                                }
                                            }
                                            
                                            if($flag == 1){
                                                
                                                echo '
                                                    <div id="remover">
                                                        <div class="btn btn-outline btn-danger" > 
                                                            <input type="hidden" name="id_adicionado" id="id_adicionado" value="'.$idMembroPerfil.'">
                                                        Excluir Contato
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div id="adicionar" style="display:none;">
                                                        <div class="btn btn-outline btn-info" > 
                                                            <input type="hidden" name="nome" id="nome" value="'.$nomeMembroPerfil.'">
                                                            <input type="hidden" name="id_adicionado" id="id_adicionado" value="'.$idMembroPerfil.'">
                                                            <input type="hidden" name="foto" id="foto" value="'.$fotoMembroPerfil.'">
                                                            <input type="hidden" name="curso" id="curso" value="'.$cursoMembroPerfil.'">
                                                        Adicionar Contato
                                                        </div>
                                                    </div>
                                                    ';
                                            }
                                        
                                        
                                        ?>

                                        </td>
                                        <td>
                                        <?php 
                                        $flag = 0;
                                        if($contMembroPerfil >= 0 && $contMembroPerfil <= 1000)
                                        {
                                            echo '<a class="tooltipspontos" href="#"><img class="pontos" src="../images/level/nivel1.png" width="50" height="50" /> <span>Voc&ecirc; come&ccedil;ou agora, explore mais o site.</span></a>';
                                            $flag = 0;
                                            
                                        }else if ($contMembroPerfil > 1000 && $contMembroPerfil <= 4000)
                                        { 
                                            echo '<a class="tooltipspontos" href="#"><img class="pontos" src="../images/level/nivel2.png" width="50" height="50" /> <span>Bom trabalho n&iacute;vel 2 alcan&ccedil;ado com sucesso.</span></a>';
                                            $flag = 1;
                                            
                                        }else if ($contMembroPerfil > 4000 && $contMembroPerfil <= 8000)
                                        {
                                            echo '<a class="tooltipspontos" href="#"><img class="pontos" src="../images/level/nivel3.png" width="50" height="50" /> <span>Bom trabalho n&iacute;vel 3 alcan&ccedil;ado com sucesso.</span></a>';
                                            $flag = 2;
                                            
                                        }else if($contMembroPerfil > 8000 && $contMembroPerfil <= 13000)
                                        {
                                            echo '<a class="tooltipspontos" href="#"><img class="pontos" src="../images/level/nivel4.png" width="50" height="50" /> <span>Bom trabalho n&iacute;vel 4 alcan&ccedil;ado com sucesso.</span></a>';
                                            $flag = 3;
                                            
                                        }else if($contMembroPerfil > 13000 && $contMembroPerfil <= 18000)
                                        {
                                            echo '<a class="tooltipspontos" href="#"><img class="pontos"  src="../images/level/nivel5.png" width="50" height="50" /> <span>Bom trabalho n&iacute;vel 5 alcan&ccedil;ado com sucesso.</span></a>';
                                            $flag = 4;  
                                            
                                        }else if($contMembroPerfil > 18000 && $contMembroPerfil <= 23000)
                                        {
                                            echo '<a class="tooltipspontos" href="#"><img class="pontos" src="../images/level/nivel6.png" width="50" height="50" /> <span>Bom trabalho n&iacute;vel 6 alcan&ccedil;ado com sucesso.</span></a>';
                                            $flag = 5;  
                                            
                                        }else if($contMembroPerfil > 23000 && $contMembroPerfil <= 25000)
                                        {
                                            echo '<a class="tooltipspontos" href="#"><img class="pontos" src="../images/level/nivel7.png" width="50" height="50" /> <span>Bom trabalho n&iacute;vel 7 alcan&ccedil;ado com sucesso.</span></a>';   
                                            $flag = 6;
                                            
                                        }else if($contMembroPerfil > 25000)
                                        {
                                            echo '<a class="tooltipspontos" href="#"><img class="pontos" src="../images/level/nivel8.png" width="50" height="50" /> <span>N&iacute;vel m&aacute;ximo alcan&ccedil;ado \o/.</span></a>';    
                                            $flag = 7;
                                            
                                        }
                                    
                                    ?>
                                        </td>
                                    </tr>
                                </table>
                                <br />
                                <!-- Descrição -->
                                <table class="perfil-descricao">
                                    <tr>
                                        <td><span class="fontedescricao"><b>Sobre mim:</b></span>
                                            <?php if($sobreMembroPerfil == "")
                                                    {
                                                        echo "Nenhuma descri&ccedil;&atilde;o";
                                                    }else {
                                                        echo " ".$sobreMembroPerfil;
                                                    } 
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <center>
                                        <br />
                                        <?php 
                                        if($twitterMembroPerfil != "")
                                        {
                                            echo '<a target="_blank" href="https://twitter.com/'.$twitterMembroPerfil.'"><img src="../images/tw.png" width="30"></a>&nbsp;';
                                        }
                                        
                                        if($facebookMembroPerfil != "")
                                        {
                                            echo '&nbsp;<a target="_blank" href="'.$facebookMembroPerfil.'"><img src="../images/face.png" width="30"></a>';
                                        }
                                        ?>
                                        </center>
                                        </td>
                                    </tr>
                                </table>

                                <div id="formularioEmail">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>
                                                <input type="hidden" name="id_destino" id="id_destino" value="<?php echo $emailMembroPerfil; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <center>
                                                    <img src="../images/statusmensagem.png" width="100%"  alt="" />
                                                </center>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><center><textarea class="textarea-perguntas" name="email_mensagem" id="email_mensagem" placeholder=" Deixe uma mensagem [350 caracteres]" rows="5" cols="75" maxlength="350" required msg=msg></textarea></center></td>
                                        </tr>
                                        <tr class="status">
                                            <td>
                                                <input style="cursor:pointer;" class="btn btn-primary" type="submit" name="email_envia" id="email_envia" value="Enviar">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div id="retorno" style="font-family:Calibri, 'Trebuchet MS', Verdana; font-size: 15px; border: 2px solid #000000; background: #0085B2; text-align: center; display:none; padding: 10px 10px 10px 10px; color: #FFFFFF;"><br /></div>
                                            </td>
                                        </tr>
                                    </table>  <br />
                                    <?php
                                        //MINHAS PERGUNTAS
                                        error_reporting(0);
                                        
                                        $sql = mysql_query ("SELECT p.*, c.col_des_nome, u.Nome, u.Foto FROM tb_post p, tb_curso c, dados_usuarios u WHERE col_id_membro = '$idUsuario' AND c.id = p.col_categoria AND u.ID = p.col_id_membro AND p.col_status = 1 ORDER BY p.id DESC LIMIT 0, 20");
                                        $contador = mysql_num_rows($sql);
                                        
                                        if ($contador > 0)
                                        {
                                            while($linha = mysql_fetch_array($sql))
                                            {
                                                
                                                $pergunta = $linha['col_pergunta'];
                                                $data = $linha['col_data'];
                                                $id = $linha['col_id_membro'];
                                                $id_pergunta = $linha['id'];
                                                $categoria = $linha['col_des_nome'];
                                                $video = $linha['col_video'];
                                                $imagem = $linha['col_imagem'];
                                                $data = date('d/m/Y - H:i:s', strtotime($data));

                                                $nome = $linha['Nome'];
                                                $fotoPergunta = $linha['Foto'];

                                                $sqlLike = mysql_query ("SELECT id FROM tb_curtir_post WHERE col_id_da_postagem = '$id_pergunta'");
                                                $num_Like = mysql_num_rows($sqlLike);

                                                //Verificar se o usuario já votou
                                                $sqlVotou = mysql_query ("SELECT id FROM tb_curtir_post WHERE col_id_de_quem_curtiu = '$ID' AND col_id_da_postagem = '$id_pergunta'");
                                                $contadorVotou = mysql_num_rows($sqlVotou);
                                                        
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
                                                                                    <td width="7%" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
                                                                                    <td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;'.$nomeCurso.'</td>
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
                                                                                    <td width="7%" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
                                                                                    <td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;'.$nomeCurso.'</td>
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
                                                                                    <td width="7%" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
                                                                                    <td><a class="linkdoPerfil" href="profile.php?id='.$id.'">'.$nome.'</a><br>'.$data.'&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;'.$nomeCurso.'</td>
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
                                        }else{
                                                echo '
                                                     <div class="alert alert-danger">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <center>Não foi encontrado nenhuma publicação.</center>
                                                    </div>
                                                ';
                                            }
                                    ?>                       
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->

                        <div class="col-lg-8">
                        	<div style="display: none;" id="morris-bar-chart"></div>
                    	</div>
                    <div style="display: none;" id="morris-area-chart"></div>
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

    <script type="text/javascript">

    //Função que ao clicar no botão, irá fazer.
    $("#adicionar").click(function(){
        //esconde um botão e mostra outro
        $("#adicionar").hide("fast");
        $("#remover").show("fast");
        //Pegando os valores que foram digitados no formulário e colocando nas variáveis nome e email.
        var nome = $("#nome").val();
        var id_adicionado = $("#id_adicionado").val();
        var foto = $("#foto").val();
        var curso = $("#curso").val();
        //Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
        $.post("include/ContatoAdicionar.php", { nome:nome, id_adicionado:id_adicionado, foto:foto, curso:curso }, function(get_retorno) {
        });
    });


    //Função que ao clicar no botão, irá fazer.
    $("#remover").click(function(){
    //esconde um botão e mostra outro
    $("#remover").hide("fast");
    $("#adicionar").show("fast");
    //Pegando os valores que foram digitados no formulário e colocando nas variáveis nome e email.
    var id_adicionado = $("#id_adicionado").val();
        //Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
        $.post("include/ContatoRemover.php", { id_adicionado:id_adicionado}, function(get_retorno) {
    
        });
    });

</script>
</body>
</html>
