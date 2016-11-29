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
    $ID_Logado = $ID;
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
                            error_reporting(0);
                            $idMensagem = $_GET['id'];

                            $sql = mysql_query ("SELECT * FROM tb_mensagem_nome WHERE id = '$idMensagem' LIMIT 1");
                            $contador = mysql_num_rows($sql);

                            if ($contador > 0)
                            {
                                while($linha = mysql_fetch_array($sql))
                                {
                                    // capitura as variaveis do banco de dados para serem imprimidas
                                    $col_nome_remetente = $linha['col_nome_remetente'];
                                    $col_data = $linha['col_data'];
                                    $col_hora = $linha['col_hora'];
                                    $col_mensagem = $linha['col_mensagem'];
                                    $idT = $linha['id'];
                                    $col_email_destino = $linha['col_email_destino'];
                                    $col_id_remetentePermissao = $linha['col_id_remetente'];
                                    $col_id_destinoPermissao = $linha['col_id_destino'];
                                    $col_ultimo_envio = $linha['col_ultimo_envio'];
                                    $col_mensagem_apagada_destino = $linha['col_mensagem_apagada_destino'];
                                    $col_mensagem_apagada_remetente = $linha['col_mensagem_apagada_remetente'];

                                    
                                    if($col_ultimo_envio != $ID){

                                        $sql = mysql_query ("UPDATE tb_mensagem_respostas SET  col_mensagem_nao_lida = 0 WHERE col_id_mensagem = '$idMensagem'");
                                    }
                                    
                            
                                    if($col_id_destinoPermissao == $ID || $col_id_remetentePermissao == $ID)    {
                                            echo '
                                                    <center>            
                                                        <table class="msg-assunto" width="100%" border="0" cellpadding="0" cellspacing="0">
                                                          <tr>
                                                            <td width="3">
                                                            </td>
                                                            <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                              <tr>
                                                                <td class="font-mensagem-nome">'.$col_nome_remetente.'</td>
                                                              </tr>
                                                              <tr>
                                                                <td class="font-mensagem-data">'.$col_data.' '.$col_hora.'</td>
                                                              </tr>
                                                            </table></td>
                                                            <tr>
                                                                <td></td>
                                                                <td width="200" class="font-mensagem-nome">
                                                                '.$col_mensagem.'
                                                            </td>
                                                            </tr>
                                                          </tr>
                                                        </table>
                                                    </center>
                                                

                                            ';
                                    } //fim do if
                                }//fim do while
                            }

                            
                            $sql = mysql_query ("
                                                SELECT DISTINCT
                                                    mr.col_id_remetente,
                                                    du.Foto
                                                FROM 
                                                    tb_mensagem_respostas mr INNER JOIN dados_usuarios du ON 
                                                        mr.col_id_remetente = du.id
                                                WHERE
                                                    mr.col_id_mensagem = $idMensagem AND
                                                    mr.col_id_remetente != $ID
                                                ");

                            while($linha = mysql_fetch_array($sql))
                            {
                                $col_id_remetente = $linha['col_id_remetente'];
                                $foto_user = $linha['Foto'];
                            }

                            
                            
                            $sql = mysql_query ("SELECT * FROM tb_mensagem_respostas WHERE col_id_mensagem ='$idMensagem' ORDER BY id ASC");
                            $contador = mysql_num_rows($sql);

                                
                                while($linha = mysql_fetch_array($sql))
                                {
                                    // capitura as variaveis do banco de dados para serem imprimidas
                                    $col_nome_remetente = $linha['col_nome_remetente'];
                                    $col_mensagem_resposta = $linha['col_mensagem_resposta'];
                                    $col_data = $linha['col_data'];
                                    $col_hora = $linha['col_hora'];
                                    $col_id_remetente = $linha['col_id_remetente'];
                                    
                                    //As variaveis de permissão estão localizada na consulta acima,´tem a função de verificar quem acessa a mensagem    
                                    if($col_id_destinoPermissao == $ID || $col_id_remetentePermissao == $ID)
                                    {
                                        if($col_id_remetente != $ID_Logado){
                                            echo '
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                        <table class="batepapo">
                                                            <tr>
                                                                <td width="0"></td>
                                                                <td align="right">'.$col_nome_remetente.'</td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="1"></td>
                                                                <td width="88%" class="balao-destinatario">'.$col_mensagem_resposta.'<br/><apan class="fonteDataMensagem">'.$col_data.' ás '.$col_hora.'</span></td>
                                                                <td width="2%"></td>
                                                                <td width="5%" valign="top" ><img class="foto-mensagem" src="../../uploads/fotos/'.$foto_user.'" width="30" height="30"/></td>
                                                            </tr>
                                                        </table>
                                                </table>
                                            ';
                                        }else{

                                            echo '
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                        <table class="batepapo">
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td>'.$col_nome_remetente.'</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%" valign="top" ><img class="foto-mensagem" src="../../uploads/fotos/'.$FOTO.'" width="30" height="30"/></td>
                                                                <td width="2%"></td>
                                                                <td width="88%" class="balao-remetente">'.$col_mensagem_resposta.'<br/><apan class="fonteDataMensagem">'.$col_data.' ás '.$col_hora.'</span></td>
                                                                
                                                            </tr>
                                                        </table>
                                                </table>
                                            ';
                                        }
                                    }
                                }//fim do while

                        ?>
                        <div id="retorno_bate_papo"></div>
                        <?php
                            
                            if($col_mensagem_apagada_destino == 1 || $col_mensagem_apagada_remetente == 1){

                                echo '
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <center>Seu parceiro de conversa não quer mais receber mensagens sobre esse assunto.</center>
                                    </div>
                                ';
                                }else{
                                    if($col_id_destinoPermissao == $ID || $col_id_remetentePermissao == $ID){
                        ?>
                                        <br/>
                                        <div id="formularioEmail">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
                                                <tr>
                                                    <td><center><textarea class="textarea-perguntas" name="email_mensagem" id="email_mensagem" placeholder=" Deixe uma mensagem" rows="8" cols="75" maxlength="1000" required msg=msg></textarea></center></td>
                                                </tr>
                                                <tr class="status">
                                                    <td>
                                                        <input style="cursor: pointer;" class="btn btn-primary" type="submit" name="email_envia_resposta" id="email_envia_resposta" value="Responder">
                                                        <input type="hidden" name="id_destino" id="id_destino" value="<?php echo $col_email_destino; ?>">
                                                        <input type="hidden" name="id_mensagem" id="id_mensagem" value="<?php echo $idMensagem; ?>">
                                                    </td>
                                                </tr>
                                            </table>                         
                                        </div>
                                        <div id="carregando_form" style="text-align:center; display:none;"><img src="loading_ajax.gif" width="100" /></div>
                                        <div id="retorno" style="font-family:Calibri, 'Trebuchet MS', Verdana; font-size: 15px; border: 2px solid #000000; background: #0085B2; text-align: center; display:none; padding: 10px 10px 10px 10px; color: #FFFFFF;"><br /></div>
                                        
                        <?php 
                                    }else{ 
                                        echo '
                                            <div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <center>Você não pode ver essa conversa.</center>
                                            </div>
                                        ';
                                    }

                            }//Fim do primeiro if

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
