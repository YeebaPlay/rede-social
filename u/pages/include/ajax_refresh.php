

<?php
error_reporting(0);
// PDO connect *********
function connect() {
    return new PDO('mysql:host=localhost;dbname=BANCO_DADOS', 'USUARIO', 'SENHA', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT col_des_nome FROM tb_curso WHERE col_des_nome  LIKE (:keyword) ORDER BY id ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['col_des_nome']);
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['col_des_nome']).'\')">'.$country_name.'</li>';
}