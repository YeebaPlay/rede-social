
<!-- /.navbar-top-links -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            
            <table width="100%">
                <tr>
                    <td width="10"></td>
                    <td width="60">
                        <center><img class="foto-perfil-home" width="100%" src="../../uploads/fotos/<?php echo $_COOKIE['FOTO']; ?>"></center> 
                    </td>
                    <td align="left">
                        <span><?php echo "<br /> ".$_COOKIE['NOME'] .'<br /><span style="font-size: 11px;">'.$_COOKIE['EMAIL']."</span>"; ?></span>
                    </td>
                </tr>
            </table>

            <div class="panel-body">
            <center>
                 <a href="curtidas.php"><div type="button" class="btn btn-default btn-circle"><i class="fa fa-pencil-square-o"></i></div></a>
                <a href="contatos.php"><div type="button" class="btn btn-success btn-circle"><i class="fa fa-users"></i></div></a>
                <a target="_blank" href="../../about-us.php"><div type="button" class="btn btn-info btn-circle"><i class="fa fa-quote-left"></i></div></a>
                
                <a href="javascript: void(0);"
                onclick="window.open('http://www.facebook.com/sharer.php?u=http://yeeba.me','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');">
                <div type="button" class="btn btn-warning btn-circle"><i class="fa fa-facebook-square"></i>
                </div></a>

                <a href="favorito.php"><div type="button" class="btn btn-danger btn-circle"><i class="fa fa-heart"></i></div></a>
            </center>
            </div>
            
            <li>
                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
            </li>
            <li>
                <a href="notas.php"><i class="fa fa-book fa-fw"></i> Anotações</a>
            </li>
            <li style="display: none;">
                <a href="#"><i class="fa fa-group fa-fw"></i> Turmas<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="flot.html">Minhas turmas</a>
                    </li>
                    <li>
                        <a href="morris.html">Turmas que eu sigo</a>
                    </li>
                    <li>
                        <a href="morris.html">Gerenciar turmas</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="arquivo.php"><i class="fa fa-download fa-fw"></i> Arquivos</a>
            </li>
            <li>
                <a href="meusposts.php"><i class="fa fa-edit fa-fw"></i> Publicações</a>
            </li>
             <li>
                <a href="mensagem.php"><i class="fa fa-comments fa-fw"></i> Mensagens</a>
            </li>
            
            <li>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Button trigger modal -->
                    <center>
                    <button class="btn btn-outline btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">
                        Upload Apostilas
                    </button>
                    </center>
                </div>
                <!-- .panel-body -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
</nav>