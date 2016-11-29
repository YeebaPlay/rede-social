<!-- <script>
if (screen.width==640||screen.height==480)
window.location.assign("b.php")
else if (screen.width==800||screen.height==600)
window.location.assign("b.php")
else if (screen.width==1024||screen.height==768)
window.location.assign("b.php")
else if (screen.width==1152||screen.height==864)
window.location.assign("b.php")
else //if all else
alert("A resolução da tela do seu monitor é desconhecida. Para ter uma visão total do site é recomendavel 800x600.")
</script> -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53612539-1', 'auto');
  ga('send', 'pageview');
</script>

<?php
error_reporting(0);
?>

<html>
<head>
<title>Yeeba.Me</title>


<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/prism.css" rel="stylesheet" type="text/css" />

<meta name="description" content="Yeeba.me vive de apostilas, é um site para estudantes, crie grupos para trocar trabalhos e avisos com sua turma, envie mensagens, adicione amigos.">
<meta name="keywords" content="humor, videos, tirinhas, videos engraçados, engraçado, comédia, yeebaplay, yeeba, yeebagames, entretenimento, risos, passa tempo na internet, videos de comedia, tirinhas engraçadas">
<meta name="author" content="Vinicius" >

</head>
<?php flush(); ?>
<body>

<div id="wrap" class="wrap">
<div id="topframe1" class="topframe1">
    <div id="wrap_internal" class="wrap_internal">
        <?php include("paginas/topframe1.php");?>
    </div>
</div>

<div>
    <?php //include("logaraqui.php");?>
</div>

<div>
    <?php include("home.php");?>
</div>




</div>

</body>
</html>
