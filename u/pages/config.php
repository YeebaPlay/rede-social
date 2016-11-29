<!DOCTYPE html>
<html lang="pt-br">
<?php 
    include "include/validar_session.php"; 
    include "../../Config/config_sistema.php";

    $ID = $_COOKIE['ID'];
    $consultaUsuario = mysql_query("SELECT * FROM dados_usuarios WHERE ID = '$ID'");

    //Pega o ID do usuário
    while($linha = mysql_fetch_object($consultaUsuario)) 
    {
        $FOTO = $linha->Foto;
        $Sobre = $linha->Sobre;
        $PONTOS = $linha->Pontos;
        $EMAIL = $linha->Email;
        $NOME = $linha->Nome;
        $ESTADO = $linha->Estado;
        $PAIS = $linha->Pais;
        $CIDADE = $linha->Cidade;
        $TWITTER = $linha->Twitter;
        $FACEBOOK = $linha->Facebook;
        $CURSO = $linha->curso;
    }

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
                            <i class="fa fa-tags fa-fw"></i> Notas
                        </div> 
                        <!-- /.Aqui fica o código das postagens -->
                        <div class="panel-body">
                           
                            <center>
                                <table>
                                    <tr>
                                        <td>
                                            <div id="btn_adicionar_forum" style="cursor: pointer;" class="btn btn-info">Buscar Fórum</div>       
                                        </td>
                                        <td width="10"></td>
                                        <td>
                                            <a href="explorar.php"><div id="btn_explorar_forum" style="cursor: pointer;" class="btn btn-info">Explorar Fóruns</div></a>
                                        </td>
                                        <td width="10"></td>
                                        <td>
                                            <div id="btn_criar_forum" style="cursor: pointer;" class="btn btn-info">Criar fórum</div>
                                        </td>
                                    </tr>
                                </table>
                            </center>

                            <div class="width3">
                                <div id="display_adicionar_forum" style="display: none;">
                                    <br />
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <center>Basta buscar pelo tema que deseja seguir e clicar em adicionar, lembre-se que letras maiúsculas são diferentes das minúsculas [A / a].</center>
                                    </div>
                                    <center>
                                        <table>
                                            <tr>
                                                <td height="40" align="right" valign="middle"  class="style3"></td>
                                                <td colspan="3" valign="" >
                                                    <label for="label6"></label>
                                                    <div class="input_container">
                                                       <input type="text" class="email-form" value="" name="curso" placeholder=" Digite o tema que deseja seguir" size="60" id="country_id" onkeyup="autocomplet()">
                                                       <ul style="cursor: pointer; margin-top: -6px;" id="country_list_id"></ul>
                                                    </div>   
                                                </td>
                                                <td valign="top"><br />
                                                    <div style="margin-top: -10px;" class="btn btn-primary" id="adicionar_forum"><center>Adicionar</center></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </center>
                                </div>
                            </div><br />


                            <div class="width3">
                                <div id="display_criar_forum" style="display: none;">
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <center>Assim que você criar um fórum não terá mais controle do conteúdo postado nele, não poderá excluí-lo ou edita-lo, mas poderá parar de receber conteúdo dele quando quiser.</center>
                                    </div>
                                    <center>
                                        <table>
                                            <tr>
                                                <td colspan="3" valign="" >
                                                    <input type="text" class="email-form" value="" name="nome_forum" placeholder=" Nome do fórum" size="60" id="nome_forum">
                                                </td>
                                                <td width="10"></td>
                                                <td>
                                                    <div class="btn btn-primary" id="criar_forum"><center>Criar</center></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </center>
                                </div>
                            </div><br />

                            <div style="display: none;" id="aviso_forum_existente" class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <center>Esse fórum já existe, escolha outro nome ou basta fazer uma busca e segui-lo.</center>
                            </div>
                            
                            <table>
                                <tr>
                                    <td>
                                    <div id="retorno"></div>
                                        <?php 
                                            $sql = mysql_query ("SELECT fi.*, c.col_des_nome FROM tb_forum_interacoes fi, tb_curso c WHERE col_id_usuario = $ID AND c.col_id_dono <> $ID AND c.id = fi.col_id_curso ORDER BY c.id DESC");
                                            $contador = mysql_num_rows($sql);

                                            if ($contador > 0)
                                            {
                                                while($linha = mysql_fetch_array($sql))
                                                {
                                                    $nome_forum = $linha['col_des_nome'];
                                                    $id_forum = $linha['id'];

                                                    echo '
                                                        <div id="'.$id_forum.'" class="conteudo-forum" onClick="deletarForum(this.id);">
                                                            <br /><center>'.$nome_forum.'</center><br />
                                                        </div>
                                                    ';
                                                }
                                            }else{
                                                echo '<div id="info_configuracao"><img src="../images/configuracoes_inicio.png" width="100%"></div>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <br/>
                            <hr>
                            <table>
                                <tr>
                                    <td>
                                    <div id="retorno_foruns_meus"></div>
                                        <?php 
                                            $sql = mysql_query ("SELECT fi.*, c.col_des_nome FROM tb_forum_interacoes fi, tb_curso c WHERE col_id_usuario = $ID AND c.col_id_dono = $ID AND c.id = fi.col_id_curso ORDER BY c.id DESC");
                                            $contador = mysql_num_rows($sql);

                                            if ($contador > 0)
                                            {
                                                while($linha = mysql_fetch_array($sql))
                                                {
                                                    $nome_forum = $linha['col_des_nome'];
                                                    $id_forum = $linha['id'];

                                                    echo '
                                                        <div id="'.$id_forum.'" class="conteudo-forum" onClick="deletarForum(this.id);">
                                                            <br /><center>'.$nome_forum.'</center><br />
                                                        </div>
                                                    ';
                                                }
                                            }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <br/>

                            <button id="visualizar_informacoes" type="botton" class="btn btn-outline btn-info btn-lg btn-block">Visualizar minhas informações</button>
                            <div id="dados_usuario" style="display: none">
                                <center>
                                    <form method="post" action="include/AlterarFoto.php" enctype="multipart/form-data">
                                        <div id="imgfundo" class="">
                                        <input type="file" class="realupload" name="arquivo" onchange="this.form.fakeupload.value = this.value;" required arquivo=arquivo>
                                        </div>
                                        <input style="cursor:pointer;" class="btn btn-primary btn-lg" type="submit" value="Enviar Foto" />
                                    </form>
                                </center>

                                <br/>
                                <table>
                                    <tr>
                                        <td>
                                            <form class="" action="include/AtualizarDados.php" method="post" enctype="multipart/form-data" name="formatualizar">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td>&nbsp;&nbsp;</td> <!-- Afasta as bordas -->
                                                    <td width="100%">
                                                        <table class="atualizardados" align="center" width="100%" border="0"  cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td width="auto" height="40" align="right" valign="middle"  class="fonte_dados">E-mail:&nbsp;</td>
                                                                <td colspan="3" valign="middle" ><label for="label2"></label>
                                                                <input class="email-form"  name="email" type="text" id="label2" id="disabledInput" value="<?php echo ''.$EMAIL;''?>" size="40" maxlength="200" disabled/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="40" align="right" valign="middle"  class="fonte_dados">Pa&iacute;s:&nbsp;</td>
                                                                <td colspan="3" valign="middle" ><label for="label3"></label>
                                                                <input class="email-form" name="pais" type="text" id="label3" value="<?php echo ''.$PAIS;''?>" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="40" align="right" valign="middle"  class="fonte_dados">Estado:&nbsp;</td>
                                                                <td colspan="3" valign="middle" ><label for="label4"></label>
                                                                <input class="email-form" name="estado" type="text" id="label4" value="<?php echo ''.$ESTADO;''?>" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="40" align="right" valign="middle"  class="fonte_dados">Cidade:&nbsp;</td>
                                                                <td colspan="3" valign="middle" ><label for="label5"></label>
                                                                <input class="email-form" name="cidade" type="text" id="label5" value="<?php echo ''.$CIDADE;''?>" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="40" align="right" valign="middle"  class="fonte_dados">Nome:&nbsp;&nbsp;</td>
                                                                <td colspan="3" valign="middle" ><label for="label6"></label>
                                                                <input class="email-form" maxlength="20"  name="nome" type="text" id="label6" value="<?php echo  ''.$NOME;''?>" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="40" align="right" valign="middle"  class="fonte_dados">Curso:&nbsp;&nbsp;</td>
                                                                <td colspan="3" valign="middle" ><label for="label6"></label>
                                                                <input class="email-form" maxlength="25" name="curso" type="text" id="label7" value="<?php echo  ''.$CURSO;''?>" /></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table align="center" width="100%">
                                                <tr>
                                                    <td><span class="fontedescricao">Sobre voc&ecirc;</span>
                                                        <textarea cols="100" rows="10" class="textarea-perguntas" name="descricao" type="textarea" value=""><?php echo ''.$Sobre;''?></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="fontedescricao">Facebook [Link completo]:</span><br /><input class="email-form" name="facebook" type="text" value="<?php echo  ''.$FACEBOOK;''?>"  />
                                                        <span class="fontedescricao">Twitter [@yeebaplay]:</span><br /><input class="email-form" name="twitter" type="text" value="<?php echo  ''.$TWITTER;''?>" />
                                                        <br /><br />
                                                        <center>
                                                            <input style="cursor:pointer;" class="btn btn-primary" type="submit" name="atualizar" value="Atualizar" id="atualizar" />
                                                        </center>
                                                    </td>
                                                </tr>
                                            </table>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
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
