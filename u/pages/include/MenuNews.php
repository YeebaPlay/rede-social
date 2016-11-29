<?php 

    function resumirArquivos($var, $limite)
    {
        // Se o texto for maior que o limite, ele corta o texto e adiciona 3 pontinhos.
        if (strlen($var) > $limite){
            $notaPalavra = substr_replace ($var, '...', $limite);
        }
        else
        {
            // Se não for maior que o limite, ele não adiciona nada.
            $notaPalavra = substr_replace ($var, '', $limite);
        }

        return $notaPalavra;
    }
?>
<div class="col-lg-4">
    <!-- /.panel -->
    <div style="display: none;" class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> Donut Chart Example
        </div>
        <div class="panel-body">
            <div id="morris-donut-chart"></div>
            <a href="#" class="btn btn-default btn-block">View Details</a>
        </div>
        <!-- /.panel-body -->
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Painel informativo
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Novas Apostilas</a>
                </li>
                <li><a href="#profile" data-toggle="tab">Novos Yeebas</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="home">
                <br />
                    <p>
                        <?php
                            $sql = mysql_query ("SELECT * FROM adicionar_arquivos WHERE status != 0 AND tamanho_arquivo != 0 ORDER BY id_arquivo DESC LIMIT 8" );
                            
                            while($linha = mysql_fetch_array($sql))
                            {
                                $nome = $linha['nome_arquivo'];
                                $link = $linha['link_arquivo'];
                                $tamanho = $linha['tamanho_arquivo'];
                                $tipo = $linha['tipo_arquivo'];
                                $nome = resumirArquivos($nome, 20);
                                
                                if($tipo == "pdf")
                                {
                                    echo '
                                        <a target="_blank" href="../../uploads/'.$link.'" class="list-group-item">
                                            <img src="../images/arquivo/pdf.png" width="15"/></i> '.$nome.'
                                            <span class="pull-right text-muted small"><em>'.$tamanho.'Kb</em>
                                            </span>
                                        </a>
                                    ';
                            
                                }else{
                                    
                                    if($tipo == "png" || $tipo == "jpg" || $tipo == "gif")
                                    { 
                                        
                                        echo '
                                            <a href="../../uploads/'.$link.'" class="list-group-item">
                                                <img src="../images/arquivo/fotos.png" width="15"/></i> '.$nome.'
                                                <span class="pull-right text-muted small"><em>'.$tamanho.'Kb</em>
                                                </span>
                                            </a>
                                        ';
                                    }else{
                                        if($tipo == "docx" || $tipo == "doc")
                                        {
                                            echo '
                                                <a href="../../uploads/'.$link.'" class="list-group-item">
                                                    <img src="../images/arquivo/word.png" width="15"/></i> '.$nome.'
                                                    <span class="pull-right text-muted small"><em>'.$tamanho.'Kb</em>
                                                    </span>
                                                </a>
                                            ';  
                                        }else{
                                            if($tipo == "zip")
                                            {
                                                
                                                echo '
                                                    <a href="../../uploads/'.$link.'" class="list-group-item">
                                                        <img src="../images/arquivo/zip.png" width="15"/></i> '.$nome.'
                                                        <span class="pull-right text-muted small"><em>'.$tamanho.'Kb</em>
                                                        </span>
                                                    </a>
                                                ';
                                                    
                                            }else{
                                                    
                                                if($tipo == "rar")
                                                {
                                                    
                                                    echo '
                                                        <a href="../../uploads/'.$link.'" class="list-group-item">
                                                            <img src="../images/arquivo/rar.png" width="15"/></i> '.$nome.'
                                                            <span class="pull-right text-muted small"><em>'.$tamanho.'Kb</em>
                                                            </span>
                                                        </a>
                                                    ';  
                                                }           
                                            }       
                                        }   
                                    }
                                }//fim do else
                            } 
                        ?>
                    </p>
                    <a href="ultimasapostilas.php" class="btn btn-default btn-block">Ver mais</a>
                </div>
                <div class="tab-pane fade" id="profile">
                        <?php 
                            $sql = mysql_query ("SELECT * FROM dados_usuarios  ORDER BY ID DESC LIMIT 6");
                            echo '<a href="profile.php?id='.$id_adicionado.'"></a>';
                            while($linha = mysql_fetch_array($sql))
                            {
                                $nome = $linha['Nome'];
                                $id_adicionado = $linha['ID'];
                                $foto = $linha['Foto'];
                                $curso = $linha['Curso'];
                                $nome = resumirArquivos($nome, 25);

                                if($curso == ""){$curso = "Fórum Geral";}
                               
                                echo '
                                        <a href="profile.php?id='.$id_adicionado.'">
                                            <table class="conteudo-perfil-ultimos" width="200" border="0">
                                              <tr>
                                                <td align="left" width="63"><img class="foto-perfil" src="../../uploads/fotos/'.$foto.'" width="60" height="60" alt="" /></td>
                                                <td><table width="100%" border="0">
                                                  <tr>
                                                    <td align="left" class="fonte13">
                                                        <div class="font-nome-perfil">'.$nome.'</div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td class="font-curso-perfil">'.$curso.'</td>
                                                  </tr>
                                                </table></td>
                                              </tr>
                                            </table>
                                        </a>            
                                ';
                            }//fim do while
                        ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.panel-body -->

     <!-- /.panel -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-comments fa-fw"></i>
            Publicidade
            
        </div>
        <!-- /.panel-heading -->
       <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Yeeba Lateral -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-9658387091082453"
                 data-ad-slot="2167640927"
                 data-ad-format="auto"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    <!-- /.panel .chat-panel -->

</div>
<!-- /.col-lg-4 -->