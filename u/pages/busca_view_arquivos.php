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

    $idApostila = base64_decode($_GET["id"]);
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
                <div class="col-lg-12">
                    
                     <div class="panel panel-default">
                        <!-- /.Aqui fica o código das postagens -->
                        <div class="panel-body">
                            <!-- Modal -->
                            <?php include"include/Modal.php";?>
                            <!-- Incluir busca de arquivos -->
                            <?php 
                                $sql = mysql_query ("SELECT * FROM adicionar_arquivos WHERE status <> 0 AND id_arquivo = $idApostila" );
                                
                                    while($linha = mysql_fetch_array($sql))
                                    {
                                        $idApostilaSelecionada = ['id_arquivo'];
                                        $nome = $linha['nome_arquivo'];
                                        $link = $linha['link_arquivo'];
                                        $data = $linha['data_arquivo'];
                                        $tamanho = $linha['tamanho_arquivo'];
                                        $tipo = $linha['tipo_arquivo'];
                                    
                                        $sqlCurtida = mysql_query ("SELECT id FROM tb_curtir_arquivo WHERE col_id_usuario = $ID AND col_id_apostila = $idApostila" );
                                        $contadorCurtidas = mysql_num_rows($sqlCurtida);
                                        
                                        if ($contadorCurtidas > 0)
                                        {
                                            echo '
                                                <table>
                                                    <tr>
                                                        <td width="30">
                                                            <div><a target="_blank" href="../../uploads/'.$link.'"><img src="../images/download.png" width="20"></a></div>
                                                        </td>
                                                        <td width="30">
                                                            <div id="descurtir" style="cursor:pointer;"><img src="../images/coracaocurtido.png" width="22"></div>
                                                            <div id="curtir" style="cursor:pointer; display:none;"><img src="../images/coracao.png" width="22"></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            ';
                                        }else{
                                            echo '
                                                <table>
                                                    <tr>
                                                        <td width="30">
                                                            <div><a target="_blank" href="../../uploads/'.$link.'"><img src="../images/download.png" width="20"></a></div>
                                                        </td>
                                                        <td width="30">
                                                            <div id="curtir" style="cursor:pointer;"><img src="../images/coracao.png" width="22"></div>
                                                            <div style="display:none; cursor:pointer;" id="descurtir"><img src="../images/coracaocurtido.png" width="22"></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            ';
                                        }
                                    

                                        if($tipo == "pdf")
                                        {

                                        echo '
                                            <br /><iframe src="http://docs.google.com/gview?url=http://yeeba.me/uploads/'.$link.'&embedded=true" style="width:100%; height:800px;" frameborder="0"></iframe>
                                        ';
                                    
                                        }else{
                                            
                                            if($tipo == "png" || $tipo == "jpg" || $tipo == "gif")
                                            { 
                                                
                                                echo '
                                    
                                    
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                            <table class="buscador">
                                                                <tr>
                                                                    <td width="15%"><img src="../images/arquivo/nada.png" width="40" height="40"/></td>
                                                                    <td width="60%">'.$nome.'</td>
                                                                    <td width="10%">'.$tamanho.'Kb</td>
                                                                    <td width="10%"><center>'.$data.'&nbsp;&nbsp;&nbsp;</td>
                                                                    <td width="5%"><a target="_blank" href="../../uploads/'.$link.'"><img height="30" src="../imagens/baixar_apostila.png"></a></td>
                                                                </tr>
                                                            </table>
                                                    </table>

                                    
                                                ';
                                                
                                                    
                                            }else{
                                                if($tipo == "docx" || $tipo == "doc")
                                                {
                                                    echo '<br />
                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                                <table class="busca_geral">
                                                                    <tr>
                                                                        <td width="15%"><img src="../images/arquivo/word.png" width="40" height="40"/></td>
                                                                        <td width="60%">'.$nome.'</td>
                                                                        <td width="10%">'.$tamanho.'Kb</td>
                                                                        <td width="10%"><center>'.$data.'&nbsp;&nbsp;&nbsp;</td>
                                                                        <td width="5%"></td>
                                                                    </tr>
                                                                </table>
                                                        </table>
                                                    ';  
                                                }else{
                                                    if($tipo == "zip")
                                                    {
                                                        
                                                        echo '
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                    <table class="busca_geral">
                                                                        <tr>
                                                                            <td width="15%"><img src="../images/arquivo/zip.png" width="40" height="40"/></td>
                                                                            <td width="60%">'.$nome.'</td>
                                                                            <td width="10%">'.$tamanho.'Kb</td>
                                                                            <td width="10%"><center>'.$data.'&nbsp;&nbsp;&nbsp;</td>
                                                                            <td width="5%"></td>
                                                                        </tr>
                                                                    </table>
                                                            </table>
                                                        ';
                                                        
                                                    }else{
                                                        
                                                        if($tipo == "rar")
                                                        {
                                                            
                                                            echo '
                                                                <table border="0" cellspacing="0" cellpadding="0">
                                                                        <table class="busca_geral">
                                                                            <tr>
                                                                                <td width="15%"><img src="../images/arquivo/rar.png" width="40" height="40"/></td>
                                                                                <td width="60%">'.$nome.'</td>
                                                                                <td width="10%">'.$tamanho.'Kb</td>
                                                                                <td width="10%"><center>'.$data.'&nbsp;&nbsp;&nbsp;</td>
                                                                                <td width="5%"></td>
                                                                            </tr>
                                                                        </table>
                                                                </table>
                                                                ';
                                                                
                                                        }else
                                                        {
                                                            echo '
                                                                <table border="0" cellspacing="0" cellpadding="0">
                                                                        <table class="busca_geral">
                                                                            <tr>
                                                                                <td width="15%"><img src="../images/arquivo/nada.png" width="50" height="50"/></td>
                                                                                <td width="60%">'.$nome.'</td>
                                                                                <td width="10%">'.$tamanho.'Kb</td>
                                                                                <td width="10%"><center>'.$data.'&nbsp;&nbsp;&nbsp;</td>
                                                                                <td width="5%"></td>
                                                                            </tr>
                                                                        </table>
                                                                </table>
                                                            ';
                                                        }
                                                        
                                                    }
                                                    
                                                }
                                                
                                            }
                                        
                                        }//fim do else
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

    <script type="text/javascript">

        $("#curtir").click(function(){
            $("#curtir").hide("slow");
            $("#descurtir").show("slow");
            //Pegando os valores que foram digitados no formulário e colocando nas variáveis nome e email.
            var idApostilaSelecionada = "<?php echo $idApostila; ?>";
            //Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
            $.post("include/ApostilaCurtir.php", { idApostilaSelecionada:idApostilaSelecionada }, function(get_retorno) {
            
            });
        });

    
        $("#descurtir").click(function(){
            $("#descurtir").hide("slow");
            $("#curtir").show("slow");
            //Pegando os valores que foram digitados no formulário e colocando nas variáveis nome e email.
            var idApostilaSelecionada = "<?php echo $idApostila; ?>";
            //Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
            $.post("include/ApostilaDescurtir.php", { idApostilaSelecionada:idApostilaSelecionada }, function(get_retorno) {

            });
        });

    </script>


</body>
</html>
