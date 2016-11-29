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

    error_reporting(0);
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
        
        <div id="page-wrapper"><br />
           
            <div class="row">
                <div class="panel-body">
                <!-- Modal -->
                <?php include"include/Modal.php";?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Tamanho</th>
                                    <th>Abrir</th>
                                    <th>Deletar</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php 
                                    $limite = 50;
                                    //$SQL_COUNT = mysql_query("SELECT COUNT('id_arquivo') FROM adicionar_arquivos WHERE id_membro='$ID'"); //Contagem dos elementos do banco por id
                                    //$SQL_RESUL = ceil(mysql_result($SQL_COUNT, 0) / $limite); //pega o resultado [ceil = quebra o valor para o maior numero inteiro]
                                    $total = mysql_query("SELECT id_arquivo FROM adicionar_arquivos WHERE id_membro='$ID' AND tamanho_arquivo <> 0");
                                    $contadorTotal = mysql_num_rows($total);

                                    //Se existir a página ele mostra no link ?pg=1
                                    $pg = $_GET["pg"];
                                    if(isset($pg)) {
                                        $pg = $pg;
                                    } else {
                                        $pg = 1;
                                    }
                                    $start = ($pg - 1) * $limite; //iniciar a paginação no primeiro valor
                                    
                                    
                                    $sql = mysql_query ("SELECT * FROM adicionar_arquivos WHERE id_membro='$ID' AND tamanho_arquivo <> 0 ORDER BY id_arquivo DESC LIMIT $start, $limite");
                                    $contador = mysql_num_rows($sql);
                                    
                                    
                                    if ($contador > 0)
                                    {
                                        while($linha = mysql_fetch_array($sql))
                                        {
                                            $id_do_arquivo = $linha['id_arquivo'];
                                            $nome_arquivo = $linha['nome_arquivo'];
                                            $tamanho_arquivo = $linha['tamanho_arquivo'];
                                            $tipo_arquivo = $linha['tipo_arquivo'];
                                            $link_arquivo = $linha['link_arquivo'];
                                            $data = $linha['data_arquivo'];
                                            $hora = $linha['hora_arquivo'];
                                            $id_membro = $linha['id_membro'];
                                            
                                            if($id_membro == $ID)
                                            {
                                                
                                            ?>
                                                <tr>
                                                    <th><?php echo $nome_arquivo; ?><br /><span style="font-size: 11px;"><?php echo "Data de upload: " . $data .  " Tipo de arquivo:  ". $tipo_arquivo;?></span></th>
                                                    <th><?php echo $tamanho_arquivo; ?>Kb</th>
                                                    <th><center><a class="tooltipsbusca" href="busca_view_arquivos.php?id=<?php echo base64_encode($id_do_arquivo); ?>"><img height="30" src="../images/baixar_apostila.png"><span>Donwload</span></a></center></th>
                                                    <th><center><form action="include/ArquivoDeletar.php" method="POST"><input type="hidden" name="codigo" value="<?php echo $id_do_arquivo; ?>"><input class="lixeiraajusta" type="image" height="30" src="../images/delete.png" value="X" /></form></center></th>
                                                </tr>
                                <?php
                                            
                                            }
                                            
                                            
                                        }//fim do while

                                    }else{
                                        echo '
                                            <div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <center>Você ainda não enviou nenhuma apostila, ajude-nos compartilhando com milhares de estudantes.</center>
                                            </div>
                                        ';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                    <div class="panel-body">
                        <table class="contador" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <div class="dataTables_paginate paging_simple_numbers">
                                        <u class="pagination">
                                            <?php
                                                // Calculando pagina anterior
                                                $menos = $pg - 1;
                                                // Calculando pagina posterior
                                                $mais = $pg + 1;

                                                $pgs = ceil($contadorTotal / $limite);
                                                
                                                if($pgs > 1 ) 
                                                {
                                                    if($menos>0){
                                                        echo "<li class='paginate_button'>
                                                                <a href='?pg=$menos'>Anterior</a> 
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
                                                            <a href='?pg=$mais'>Proxima</a>
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
                    </div>
                <!-- /.panel -->
            </div>
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

    
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Padrao JavaScript -->
    <script src="../dist/js/functions.js"></script>


</body>
</html>
