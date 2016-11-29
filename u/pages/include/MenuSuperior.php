<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53612539-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Navigation termina no arquivo MenuLateral -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
           <form class="form-inline" action="busca.php" method="GET">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="../../images/logo_preta.png" alt="logo"></a>
            </div>
            <!-- /.navbar-header -->
            <div style="margin-top: 9px; width: 60%; margin-left: 29px;" class="input-group custom-search-form">
                <input type="text" id="b" name="b" class="form-control" placeholder="Buscar...">
                <input type="hidden" name="tipo" value="arquivo">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            <!-- /input-group -->
            
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                    <?php 
                    
                        $sql = mysql_query ("SELECT mn.*, du.Nome FROM tb_mensagem_nome mn INNER JOIN dados_usuarios du ON mn.col_id_destino = du.id WHERE 
                                col_email_destino = '{$_COOKIE['EMAIL']}' OR col_id_remetente = '{$_COOKIE['ID']}' ORDER BY id DESC LIMIT 5");
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
                                    
                                    $col_mensagem_apagada_destino = $linha['col_mensagem_apagada_destino'];
                                    $col_mensagem_apagada_remetente = $linha['col_mensagem_apagada_remetente'];
                                    $col_id_remetente = $linha['col_id_remetente'];
                                    $col_id_destino = $linha['col_id_destino'];

                                    //Verificar se a mensagem não foi apagada [1 representa apagada]
                                    if($col_id_remetente == $ID && $col_mensagem_apagada_remetente != 1)
                                    {
                                         echo '
                                            <li>
                                                <a href="mensagem_view.php?id='.$idT.'">
                                                    <div>
                                                        <strong>'.$col_nome_destino.'</strong>
                                                        <span class="pull-right text-muted">
                                                            <em>'.$col_data. ' ' .$col_hora.' </em>
                                                        </span>
                                                    </div>
                                                    <div>'.$col_mensagem.'</div>
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                        ';
                                    }else if($col_id_destino == $ID && $col_mensagem_apagada_destino != 1)
                                    {
                                        echo '
                                            <li>
                                                <a href="mensagem_view.php?id='.$idT.'">
                                                    <div>
                                                        <strong>'.$col_nome_destino.'</strong>
                                                        <span class="pull-right text-muted">
                                                            <em>'.$col_data. ' ' .$col_hora.' </em>
                                                        </span>
                                                    </div>
                                                    <div>'.$col_mensagem.'</div>
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                        ';
                                    }
                                }
                            }else{

                                echo "Nenhuma Mensagem";
                            }
                    ?>  
                        
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="mensagem.php">
                                <strong>Ver todas as mensagens</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                    <?php 
                        $cont = $_COOKIE['PONTOS'];
                        if($cont >= 0 && $cont <= 1000)
                        {
                            //Nivel maximo 10
                            $quantMaxima = 1000;
                            $quantAtual = $cont;
                            $v1 = $quantAtual * 100;
                            $resultadoFinal = ($v1 / $quantMaxima);
                            
                        }else if ($cont > 1000 && $cont <= 4000)
                        { 
                            //Nivel maximo 40
                            $quantMaxima = 3000; //Valor de 10 a 40 [diferença é 30]
                            $quantAtual = $cont - 1000; //Pega o valor atual do $cont e elimina o nivel anterior 10
                            $v1 = $quantAtual * 100;
                            $resultadoFinal = $v1 / $quantMaxima;
                            
                        }else if ($cont > 4000 && $cont <= 8000)
                        {
                            //Nivel maximo 80
                            $quantMaxima = 4000; //Valor de 40 a 80 [diferença é 40]
                            $quantAtual = $cont - 4000; //Pega o valor atual do $cont e elimina o nivel anterior 40
                            $v1 = $quantAtual * 100;
                            $resultadoFinal = ($v1 / $quantMaxima);
                            
                        }else if($cont > 8000 && $cont <= 13000)
                        {
                            //Nivel maximo 130
                            $quantMaxima = 5000; //Valor de 80 a 130 [diferença é 50]
                            $quantAtual = $cont - 8000; //Pega o valor atual do $cont e elimina o nivel anterior 80
                            $v1 = $quantAtual * 100;
                            $resultadoFinal = ($v1 / $quantMaxima);
                            
                        }else if($cont > 13000 && $cont <= 18000)
                        {
                            //Nivel maximo 180
                            $quantMaxima = 5000; //Valor de 130 a 180 [diferença é 50]
                            $quantAtual = $cont - 13000; //Pega o valor atual do $cont e elimina o nivel anterior 130
                            $v1 = $quantAtual * 100;
                            $resultadoFinal = ($v1 / $quantMaxima);
                            
                        }else if($cont > 18000 && $cont <= 23000)
                        {
                            //Nivel maximo 230
                            $quantMaxima = 5000; //Valor de 180 a 230 [diferença é 50]
                            $quantAtual = $cont - 18000; //Pega o valor atual do $cont e elimina o nivel anterior 180
                            $v1 = $quantAtual * 100;
                            $resultadoFinal = ($v1 / $quantMaxima);
                            
                        }else if($cont > 23000 && $cont <= 25000)
                        {
                            //Nivel maximo 250
                            $quantMaxima = 2000; //Valor de 230 a 250 [diferença é 20]
                            $quantAtual = $cont - 23000; //Pega o valor atual do $cont e elimina o nivel anterior 230
                            $v1 = $quantAtual * 100;
                            $resultadoFinal = ($v1 / $quantMaxima); 
                            
                        }else if($cont > 25000)
                        {
                            //Nivel maximo 300
                            $resultadoFinal = 100;
                        }

                        $resultadoFinal = number_format($resultadoFinal, 2, '.', ' ');
                    
                    ?>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Para subir de nível</strong>
                                        <span class="pull-right text-muted"><?php echo $resultadoFinal;?> Completos</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $resultadoFinal;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $resultadoFinal;?>%">
                                            <span class="sr-only"><?php echo $resultadoFinal;?>Completos</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Como funciona a pontuação?</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $_COOKIE['ID']; ?>">
                        <?php 
                             $sqlContador = mysql_query ("SELECT * FROM notificacoes WHERE id_destino = '$ID' && notifica = 1");
                            $contadorNotificacao = mysql_num_rows($sqlContador);

                            if ($contadorNotificacao > 0) {
                                echo ' <i id="notificacoes" class="fa fa-bell fa-2x"></i>  <i class="fa fa-caret-down"></i>';
                            }else{
                                echo ' <i id="notificacoes" class="fa fa-bell fa-1x"></i>  <i class="fa fa-caret-down"></i>';
                            }
                        ?>
                       
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <?php 
                            $sql = mysql_query ("SELECT n.*, du.Foto FROM notificacoes n INNER JOIN dados_usuarios du ON n.id_remetente = du.id WHERE id_destino='$ID' ORDER BY id DESC LIMIT 6");
                            
                            $contador = mysql_num_rows($sql);
                            $limite = 0; //Contagem de limite de notificações
                            
                            if ($contador > 0)
                            {
                                
                                while($linha = mysql_fetch_array($sql))
                                {
                                    // capitura as variaveis do banco de dados para serem imprimidas
                                    $mensagem = $linha['mensagem'];
                                    $hora = $linha['hora'];
                                    $foto = $linha['Foto'];
                                    $id_remetente = $linha['id_remetente'];
                                    $tipo = $linha['tipo'];
                                    $id_grupo = $linha['id_grupo'];
                                    
                                   
                                    //acrescenta ao limite de vez que mostra as notificações
                                   
                                        if($tipo != "grupo")
                                        {
                                            echo'
                                                  <li>
                                                    <a href="profile.php?id='.$id_remetente.'">
                                                        <div>
                                                            <img src="../../uploads/fotos/'.$foto.'" class="msg-photo" alt="Seu avatar" /> 
                                                            <span class="blue">'.$_COOKIE['NOME'].':</span> '.$mensagem.'
                                                            <span class="pull-right text-muted small">&agrave;s: '.$hora.'</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                 <li class="divider"></li>
                                            ';
                                        }
                                }
                            }
                        ?>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-bell fa-fw"></i> <?php echo $contadorNotificacao; ?> Notificações
                                    <span class="pull-right text-muted small"></span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="todasnotificacoes.php">
                                <strong>Ver 50 últimas notificações</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li> <a href="profile.php?id= <?php echo $_COOKIE['ID']; ?>"> <i class="fa fa-user fa-fw"></i> Perfil</a>
                        </li>
                        <li><a href="config.php"><i class="fa fa-gear fa-fw"></i> Configurações</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            </form>