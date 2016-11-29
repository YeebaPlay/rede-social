<?php 

    function resumir($var, $limite)
    {
        // Se o texto for maior que o limite, ele corta o texto e adiciona 3 pontinhos.
        if (strlen($var) > $limite){
            echo substr_replace ($var, '...', $limite);
        }
        else
        {
            // Se não for maior que o limite, ele não adiciona nada.
            echo substr_replace ($var, '', $limite);
        }
    }
   
    $limite = 20; //Limite de post por página
    $total = mysql_query("SELECT ID FROM dados_usuarios WHERE Nome LIKE '%".$palavraBuscada."%'");
    $contadorTotal = mysql_num_rows($total);

    //Se existir a página ele mostra no link ?pg=1
    $pg = $_GET["pg"];
    if(isset($pg)) {
        $pg = $pg;
    } else {
        $pg = 1;
    }
    
    $start = ($pg - 1) * $limite; //iniciar a paginação no primeiro valor
    
    
    $sql = mysql_query ("SELECT * FROM dados_usuarios WHERE Nome LIKE '%".$palavraBuscada."%' LIMIT $start, $limite");
    $contador = 0;
    $contador = mysql_num_rows($sql);
    
    if ($contador > 0 && $palavraBuscada != "")
    {
        while($linha = mysql_fetch_array($sql))
        {
            $nome = $linha['Nome'];
            $id = $linha['ID'];
            $email = $linha['Email'];
            $curso = $linha['curso'];
            $foto = $linha['Foto'];
            $descricao_usuario = $linha['Sobre'];
           
            if($curso == "")
                $curso = "Fórum Geral";
            
            echo '
                    <table class="busca_geral" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="19%" height="68">&nbsp;&nbsp;&nbsp;
                                <img class="foto-perfil" src="../../uploads/fotos/'.$foto.'" width="50"  alt="" />
                            </td>
                            <td width="81%">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td><a class="linkdoMenuLeft" href="profile.php?id='.$id.'">' .$nome.'</a></td>
                                    </tr>
                                    <tr>
                                        <td class="font_curso_usuario">'.$curso.'</td>
                                    </tr>
                                    <tr>'; ?>
                                        <td class="font_descricao_usuario"><?php echo resumir(($descricao_usuario),70); ?></td>
                                        <?php echo '
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <a class="tooltipsbusca" href="profile.php?id='.$id.'"><img class="" src="../images/protifile.png" width="30"  alt="" /><span>Perfil</span></a>
                            </td>
                            <td>
                                &nbsp;&nbsp;
                            </td>
                        </tr>
                    </table>
            ';
            
        }//while

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