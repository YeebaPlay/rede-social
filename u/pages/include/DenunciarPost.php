<?php 
    
    include "../../../Config/config_sistema.php";

    date_default_timezone_set('America/Sao_Paulo');
    $ID = $_COOKIE['ID'];
    $curso = $_COOKIE['CURSO'];
    $FOTO = $_COOKIE['FOTO'];
    $Sobre = $_COOKIE['SOBRE'];
    $PONTOS = $_COOKIE['PONTOS'];

    $idPost = $_REQUEST['id'];

    $data = date("d/m/Y");
    $hora = date("H:i");

    $strSQL = "INSERT INTO tb_denuncias_post(col_id_da_denuncia, col_id_do_usuario, col_hora, col_data)
    VALUES('$idPost', '$ID', '$hora', '$data')";
    mysql_query($strSQL) or die(mysql_error());

    echo '<script>window.location.assign("../index.php?info=denunciado")</script>';
?>