<html>
<head>
<title>YeebaPlay</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<meta name="description" content="Yeebaplay é um site de entretenimento com vídeos, tirinhas, textos etc. Nosso objetivo é reunir o melhor conteúdo da internet em um só lugar, fazendo com que suas buscas por horas na internet diminuam.>
<meta name="keywords" content="humor, videos, tirinhas, videos engraçados, engraçado, comédia, yeebaplay, yeeba, yeebagames, entretenimento, risos, passa tempo na internet, videos de comedia, tirinhas engraçadas">
<meta name="author" content="Vinícius" >


<script type="text/javascript">
function loadPHPDCO(filePHP){
    jQuery("#videos").load(filePHP);
};
</script>


</head>
<body>

<div id="wrap" class="wrap">
<div id="topframe1" class="topframe1">
    <div id="wrap_internal" class="wrap_internal">
        <?php include("perguntas/perguntastop.php");?>
    </div>
</div>



<div id="sub_wrap" class="sub_wrap">

<div id="topframe2" class="topframe2">
    <?php include("perguntas/perguntasmenu.php");?>
</div>
<div class="divisao"></div>

<div id="home" class="home">
    <?php include("perguntas/sobreyeeba.php");?>
</div>



</div>
</div>
<div id="bottomframe" class="bottomframe">

    <?php include("paginas/bottomframe.php");?>
</div>
</body>
</html>
