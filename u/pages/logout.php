<?php
// Deleta o cookie definido anteriormente
setcookie('login_usuario');
setcookie('senha_usuario');
unset($_COOKIE['login_usuario']);
unset($_COOKIE['senha_usuario']);

// redireciona o link para a home page 
echo '<script>window.location.assign("../../index.php")</script>';
?>