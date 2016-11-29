<?php 
    $limite = 20; //Limite de post por página
    $SQL_COUNT = mysql_query("SELECT COUNT('id') FROM tb_post WHERE col_pergunta LIKE '%".$palavraBuscada."%' && col_status != 0"); //Contagem dos elementos do banco por id
    $SQL_RESUL = ceil(mysql_result($SQL_COUNT, 0) / $limite); //pega o resultado [ceil = quebra o valor para o maior numero inteiro]
    
    $total = mysql_query("SELECT id FROM tb_post WHERE col_pergunta LIKE '%".$palavraBuscada."%' AND col_status != 0");
    $contadorTotal = mysql_num_rows($total);
    
    //Se existir a página ele mostra no link ?pg=1
    $pg = $_GET["pg"];
    if(isset($pg)) {
        $pg = $pg;
    } else {
        $pg = 1;
    }
    
    $start = ($pg - 1) * $limite; //iniciar a paginação no primeiro valor 
    

    $sql = $sqlPostGeral = mysql_query ("SELECT p.*, du.Foto, du.Nome FROM tb_post p INNER JOIN dados_usuarios du ON du.ID = p.col_id_membro WHERE p.col_status = 1 AND p.col_pergunta LIKE '%".$palavraBuscada."%' ORDER BY p.id DESC LIMIT $start, $limite"); 
    //mysql_query ("SELECT * FROM tb_post WHERE p.col_pergunta LIKE '%".$palavraBuscada."%' && col_status != 0 ORDER BY id DESC LIMIT $start, $limite" );
    $contador = mysql_num_rows($sql);
    
    if ($contador > 0 && $palavraBuscada != "")
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
                                                        <td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
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
                                                        <td width="70" align="center"><img class="imagem-perfil" src="../../uploads/fotos/'.$fotoPergunta.'" width="50"/></td>
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
                                                        <img src="'.$imagem.'" width="100%" alt="" />
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