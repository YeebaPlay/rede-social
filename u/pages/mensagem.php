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
                            <i class="fa fa-comment fa-fw"></i>
                        </div>
                        <!-- /.Aqui fica o código das postagens -->
                        <div class="panel-body">
                            <div id="formularioEmail">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
                                    <tr>
                                        <td><center><textarea class="textarea-perguntas" id="email_mensagem"  name="email_mensagem" placeholder=" Deixe uma mensagem [500 caracteres]" rows="5" cols="75" maxlength="500" required msg=msg></textarea></center></td>
                                    </tr>
                                    <tr class="status">
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td width="8%">
                                                        <button type="button" class="btn btn-info btn-circle" name="email_envia" id="email_envia"><i class="fa fa-send"></i></button>
                          
                                                    </td>
                                                    <td width="92%">
                                                        <input class="form-control" type="text" name="id_destino" id="id_destino" placeholder=" Email do destin&aacute;tario" size="" maxlength="40" required destino=destino />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>                         
                             </div>
                            <div id="carregando_form" style="text-align:center; display:none;"><img src="loading_ajax.gif" width="100" /></div>
                            <div id="retorno" style="font-family:Calibri, 'Trebuchet MS', Verdana; font-size: 15px; border: 2px solid #000000; background: #0085B2; text-align: center; display:none; padding: 10px 10px 10px 10px; color: #FFFFFF;"><br /></div>

                            <br />

                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Envie mensagem utilizando o e-mail de destino ou através do perfil do usuário.
                            </div>

                            <br />
                            <?php 
                                
                                
                                include "include/Function.php";
                                
                                $sql = mysql_query ("SELECT mn.*, du.Foto FROM tb_mensagem_nome mn INNER JOIN dados_usuarios du ON mn.col_id_destino = du.id WHERE 
                                col_email_destino = '$EMAIL' OR col_id_remetente = '$ID' ORDER BY id DESC");
                                $contador = mysql_num_rows($sql);

                                
                                if ($contador > 0)
                                {
                                    while($linha = mysql_fetch_array($sql))
                                    {
                                        // capitura as variaveis do banco de dados para serem imprimidas
                                        $col_nome_remetente = $linha['col_nome_remetente'];
                                        $col_nome_destino = $linha['col_nome_destinatario'];
                                        $col_data = $linha['col_data'];
                                        $col_hora = $linha['col_hora'];
                                        $col_mensagem = $linha['col_mensagem'];
                                        $idT = $linha['id'];
                                        $col_id_remetente = $linha['col_id_remetente'];
                                        $col_id_destino = $linha['col_id_destino'];
                                        $foto_user = $linha['Foto'];
                                        $col_ultimo_envio = $linha['col_ultimo_envio'];
                                        $col_mensagem_apagada_destino = $linha['col_mensagem_apagada_destino'];
                                        $col_mensagem_apagada_remetente = $linha['col_mensagem_apagada_remetente'];

                                        //Se eu sou o remetente da mensagem a foto do outro vai ser mostrada, esse tratamento é necessário para mostrar
                                        //sempre a foto do outro usuário.
                                        if($col_id_remetente != $ID)
                                        {
                                            $sqlFoto = mysql_query("SELECT Foto FROM dados_usuarios WHERE ID = '$col_id_remetente'");
                                            $contador = mysql_num_rows($sqlFoto);
                                            if ($contador > 0)
                                            {
                                                while($linha = mysql_fetch_array($sqlFoto))
                                                {
                                                    $foto_user = $linha['Foto'];
                                                }
                                            }
                                        }

                                        $sqlMSG = mysql_query("SELECT id FROM tb_mensagem_respostas WHERE col_id_mensagem = '$idT' AND col_mensagem_nao_lida = 1");
                                        $contadorMSG = mysql_num_rows($sqlMSG); 
                                        
                                        //Caso passe de 99 mensagens mostrará 99+
                                        if($contadorMSG > 99)
                                        {
                                            $contadorMSG = '99+';
                                        }

                                        //Quem enviou á última mensagem
                                        if($col_ultimo_envio == $ID)
                                        {
                                            $contadorMSG = 0;
                                        }
                                        
                                        //Verificar se a mensagem não foi apagada [1 representa apagada]
                                        if($col_id_remetente == $ID && $col_mensagem_apagada_remetente != 1)
                                        {
                                            echo '
                                                <a href="mensagem_view.php?id='.$idT.'"><div class="mensagem-recebidas">
                                                    <center>            
                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                          <tr>
                                                            <td width="50" valign="middle">
                                                                <img class="foto-mensagem" src="../../uploads/fotos/'.$foto_user.'"/>
                                                            </td>
                                                            <td width="35">
                                                                <div class="circle">
                                                                '.$contadorMSG.'
                                                                </div>
                                                            </td>
                                                            <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                              <tr>'; ?>
                                                                <td class="font-mensagem-nome"><?php if ($col_id_remetente == $ID){echo $col_nome_destino;}else{echo $col_nome_remetente;}?></td>
                                                              <?php echo '
                                                              </tr>
                                                              <tr>
                                                                <td class="font-mensagem-data">'.$col_data.' '.$col_hora.'</td>
                                                              </tr>
                                                            </table></td>
                                                            <td width="250" class="font-mensagem-nome">'; ?>
                                                            <?php echo resumir(($col_mensagem),25) ?>
                                                          <?php  echo '</td>
                                                          <td width="25" class="verticaldelete">
                                                            <form action="include/MensagemDeletar.php" method="POST">
                                                                <input type="hidden" name="codigo" value="'.$idT.'">
                                                                <input type="hidden" name="tipo" value="1">
                                                                <input width="25" type="image" src="../images/delete.png" />
                                                            </form>
                                                          </td>
                                                          </tr>
                                                        </table>
                                                    </center>
                                                </div></a>

                                            ';

                                        }else if($col_id_destino == $ID && $col_mensagem_apagada_destino != 1){

                                            echo '
                                                <a href="mensagem_view.php?id='.$idT.'"><div class="mensagem-recebidas">
                                                    <center>            
                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                          <tr>
                                                            <td width="50" valign="middle">
                                                                <img class="foto-mensagem" src="../../uploads/fotos/'.$foto_user.'" />
                                                            </td>
                                                            <td width="35">
                                                                <div class="circle">
                                                                '.$contadorMSG.'
                                                                </div>
                                                            </td>
                                                            <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                              <tr>'; ?>
                                                                <td class="font-mensagem-nome"><?php if ($col_id_remetente == $ID){echo $col_nome_destino;}else{echo $col_nome_remetente;}?></td>
                                                              <?php echo '
                                                              </tr>
                                                              <tr>
                                                                <td class="font-mensagem-data">'.$col_data.' '.$col_hora.'</td>
                                                              </tr>
                                                            </table></td>
                                                            <td width="250" class="font-mensagem-nome">'; ?>
                                                            <?php echo resumir(($col_mensagem),25) ?>
                                                          <?php  echo '</td>
                                                          <td width="25" class="verticaldelete">
                                                            <form action="include/MensagemDeletar.php" method="POST">
                                                                <input type="hidden" name="codigo" value="'.$idT.'">
                                                                <input type="hidden" name="tipo" value="0">
                                                                <input width="25" type="image" src="../images/delete.png" />
                                                            </form>
                                                          </td>
                                                          </tr>
                                                        </table>
                                                    </center>
                                                </div></a>

                                            ';
                                        }
                                        

                                    }//fim do while
                                }

                            ?>
                            <div style="display: none;" id="morris-area-chart"></div>
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
