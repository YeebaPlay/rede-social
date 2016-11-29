<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Yeeba.me</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
    <!-- Menu Superior -->
    <?php include "include/Menu.php"; ?>

    <section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Sobre o Yeeba.me</h1>
                    <p>Tentamos não ser apenas mais uma rede social, buscamos nos diferenciar das demais baseadas na opnião dos usuários. O que você precisa nós criamos.</p>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Sobre nós</li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!--/#title-->

    <section id="about-us" class="container">
        <div class="row">
            <div class="col-sm-6">
                <h2>O que é o Yeeba.me?</h2>
                <p>
                    Yeeba.me é uma rede social acadêmica, com intuito de aproximar estudantes com interesses
                    em comum, é por esse motivo que nosso foco não é em seguir pessoas, mas seguir temas, nem
                    sempre as pessoas falam algo que você queira saber caso essa pessoa fale sobre assuntos que lhe interessa
                    nós iremos te mostrar, sem nenhuma restrição quanto a quem e quantas pessoas você vai se comunicar.
                    <br /><br />
                    A rede social está crescendo cada dia mais graças a opniões de usuários, compartilhamento de conteúdo e
                    arquivos acadêmicos.
                    <br /><br />
                    Organize sua turma aqui no Yeeba.me compartilhando apostilas, criando conteúdo e disponibilizando para toda comunidade de estudantes e professores.
                </p>
                </div><!--/.col-sm-6-->
            <div class="col-sm-6">
                <h2>Gameficação</h2>
                <p>Tudo isso vale ponto, temos um pequeno game para ver seu nível de estudante dentro da rede, a ideia é incentivá-lo a colaborar, ajudando mais estudantes.</p>
                <div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                            <span>Publicar conteúdo</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
                            <span>Trocar mensagens</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                            <span>Fazer amigos</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
                            <span>Enviar arquivos</span>
                        </div>
                    </div>
                </div>
            </div><!--/.col-sm-6-->
        </div><!--/.row-->

        <div class="gap"></div>
        <h1 class="center">Você pode ajudar</h1>
        <p class="lead center">Para ajudar o Yeeba.me crescer é fácil, preciso de sua opnião e sugestão, envie um e-mail para suporte@yeeba.me e ajude no crescimento da plataforma.</p>
        <div class="gap"></div>

    </section><!--/#about-us-->

    <!-- Rodape -->
    <?php include "include/Rodape.php";?>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>

    <script type="text/javascript">

    $(function(){
        //Função que ao clicar no botão, irá fazer.
        $("#fazer_login").click(function(){
        $("#login").show("slow");
        $("#fazer_login").hide("fast");

        });
    });
 
    </script>
</body>
</html>