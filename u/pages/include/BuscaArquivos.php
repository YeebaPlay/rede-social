<?php 
    $limite = 40; //Limite de post por página
    $SQL_COUNT = mysql_query("SELECT COUNT('id_arquivo') FROM adicionar_arquivos WHERE nome_arquivo LIKE '%".$palavraBuscada."%' && status != 0"); //Contagem dos elementos do banco por id
    $SQL_RESUL = ceil(mysql_result($SQL_COUNT, 0) / $limite); //pega o resultado [ceil = quebra o valor para o maior numero inteiro]
    
    $total = mysql_query("SELECT id_arquivo FROM adicionar_arquivos WHERE nome_arquivo LIKE '%".$palavraBuscada."%' AND status != 0");
    $contadorTotal = mysql_num_rows($total);
    
    //Se existir a página ele mostra no link ?pg=1
    $pg = $_GET["pg"];
    if(isset($pg)) {
        $pg = $pg;
    } else {
        $pg = 1;
    }
    
    $start = ($pg - 1) * $limite; //iniciar a paginação no primeiro valor
    

    $sql = mysql_query ("SELECT * FROM adicionar_arquivos WHERE nome_arquivo LIKE '%".$palavraBuscada."%' && status != 0 ORDER BY id_arquivo DESC LIMIT $start, $limite" );
    $contador = mysql_num_rows($sql);
    
    if ($contador > 0 && $palavraBuscada != "")
    {
        while($linha = mysql_fetch_array($sql))
        {
            $idApostila = $linha['id_arquivo'];
            $nome = $linha['nome_arquivo'];
            $link = $linha['link_arquivo'];
            $data = $linha['data_arquivo'];
            $tamanho = $linha['tamanho_arquivo'];
            $tipo = $linha['tipo_arquivo'];
            
            
            
            if($tipo == "pdf")
            {

            echo '
                <table class="busca_geral" width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="19%" height="68">&nbsp;&nbsp;&nbsp;
                            <img class="" src="../images/arquivo/pdf.png" width="50"/>
                        </td>
                        <td width="81%">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>' .$nome.'</td>
                                </tr>
                                <tr>
                                    <td class="font_curso_usuario">Tamanho: '.$tamanho.' kb</td>
                                </tr>
                                <tr>
                                    <td class="font_descricao_usuario">
                                        '.$data.'
                                    </td>
                                    
                                </tr>
                            </table>
                        </td>
                        <td>
                            <a class="tooltipsbusca" href="busca_view_arquivos.php?id='.base64_encode($idApostila).'"><img height="30" src="../images/baixar_apostila.png"><span>Donwload</span></a>
                        </td>
                        <td>
                            &nbsp;&nbsp;
                        </td>
                    </tr>
                </table>

            
            ';
        
            }else{
                
                    if($tipo == "png" || $tipo == "jpg" || $tipo == "gif")
                    { 
                        
                        echo '
            
            
                            <table class="busca_geral" width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="19%" height="68">&nbsp;&nbsp;&nbsp;
                                        <img class="" src="../images/arquivo/fotos.png" width="50"/>
                                    </td>
                                    <td width="81%">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>' .$nome.'</td>
                                            </tr>
                                            <tr>
                                                <td class="font_curso_usuario">Tamanho: '.$tamanho.' kb</td>
                                            </tr>
                                            <tr>
                                                <td class="font_descricao_usuario">
                                                    '.$data.'
                                                </td>
                                                
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <a class="tooltipsbusca" target="_blank" href="../../uploads/'.$link.'"><img height="30" src="../images/baixar_apostila.png"><span>Donwload</span></a>
                                    </td>
                                    <td>
                                        &nbsp;&nbsp;
                                    </td>
                                </tr>
                            </table>

            
                        ';
                        
                            
                    }else{
                            if($tipo == "docx" || $tipo == "doc")
                            {
                                echo '
                
                
                                <table class="busca_geral" width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="19%" height="68">&nbsp;&nbsp;&nbsp;
                                            <img class="" src="../images/arquivo/word.png" width="50"/>
                                        </td>
                                        <td width="81%">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td>' .$nome.'</td>
                                                </tr>
                                                <tr>
                                                    <td class="font_curso_usuario">Tamanho: '.$tamanho.' kb</td>
                                                </tr>
                                                <tr>
                                                    <td class="font_descricao_usuario">
                                                        '.$data.'
                                                    </td>
                                                    
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <a class="tooltipsbusca" target="_blank" href="../../uploads/'.$link.'"><img height="30" src="../images/baixar_apostila.png"><span>Donwload</span></a>
                                        </td>
                                        <td>
                                            &nbsp;&nbsp;
                                        </td>
                                    </tr>
                                </table>
    
                
                                ';  
                            }else{
                                    if($tipo == "zip")
                                    {
                                        
                                echo '
                                <table class="busca_geral" width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="19%" height="68">&nbsp;&nbsp;&nbsp;
                                                <img class="" src="../images/arquivo/zip.png" width="50"/>
                                            </td>
                                            <td width="81%">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td>' .$nome.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font_curso_usuario">Tamanho: '.$tamanho.' kb</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font_descricao_usuario">
                                                            '.$data.'
                                                        </td>
                                                        
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <a class="tooltipsbusca" target="_blank" href="../../uploads/'.$link.'"><img height="30" src="../images/baixar_apostila.png"><span>Donwload</span></a>
                                            </td>
                                            <td>
                                                &nbsp;&nbsp;
                                            </td>
                                        </tr>
                                    </table>
                                ';
                                        
                                    }else{
                                        
                                            if($tipo == "rar")
                                            {
                                                
                                                echo '
                                                    <table class="busca_geral" width="100%" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td width="19%" height="68">&nbsp;&nbsp;&nbsp;
                                                                <img class="" src="../images/arquivo/rar.png" width="50"/>
                                                            </td>
                                                            <td width="81%">
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td>' .$nome.'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="font_curso_usuario">Tamanho: '.$tamanho.' kb</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="font_descricao_usuario">
                                                                            '.$data.'
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <a class="tooltipsbusca" target="_blank" href="../../uploads/'.$link.'"><img height="30" src="../images/baixar_apostila.png"><span>Donwload</span></a>
                                                            </td>
                                                            <td>
                                                                &nbsp;&nbsp;
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    ';
                                                    
                                            }else
                                            {
                                                echo '
                                                    <table class="busca_geral" width="100%" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td width="19%" height="68">&nbsp;&nbsp;&nbsp;
                                                                <img class="" src="../images/arquivo/nada.png" width="50"/>
                                                            </td>
                                                            <td width="81%">
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td>' .$nome.'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="font_curso_usuario">Tamanho: '.$tamanho.' kb</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="font_descricao_usuario">
                                                                            '.$data.'
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <a class="tooltipsbusca" target="_blank" href="../../uploads/'.$link.'"><img height="30" src="../images/baixar_apostila.png"><span>Donwload</span></a>
                                                            </td>
                                                            <td>
                                                                &nbsp;&nbsp;
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    ';
                                            }
                                        
                                        }
                                
                                }
                        
                        }
                
                }//fim do else
            
            
            
        }

    }else{
        
        echo'<br /><br /><center><img src="../images/erro_de_busca.png" width="500" height="400" /></center>';
        $SQL_RESUL = 0;
        
        }
?>

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
                                        <a href='?pg=$menos&b=$palavraBuscada&tipo=$tipoBusca' class='texto_paginacao'>Anterior</a> 
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
                                    echo "<li class='paginate_button active'> 
                                            <a href=\"?pg=".($i)."&b=".($palavraBuscada)."&tipo=".($tipoBusca)."\" >$i</a>
                                          </li>
                                         ";
                                }else{
                                    echo "<li class='paginate_button'>
                                            <a href=\"?pg=".($i)."&b=".($palavraBuscada)."&tipo=".($tipoBusca)."\" >$i</a>
                                          </li>
                                         ";
                                }
                            }
                            if($mais <= $pgs) {
                            echo "<li class='paginate_button'> 
                                    <a href=\"?pg=$mais&b=$palavraBuscada&tipo=$tipoBusca\" class='texto_paginacao'>Proxima</a>
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