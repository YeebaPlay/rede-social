<?php include "Config/config_sistema.php"; ?>

<!DOCTYPE html>

<html lang="pt-br">

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



    <?php include "Config/config_sistema.php"; ?>

    <?php

        //Tratamento de erro

        if(isset($_GET['e'])){

            if($_GET['e'] == '_erro'){

                echo'<div id="retorno" style="font-family:Calibri, Verdana; font-size: 15px; border: 2px solid #000000; background: #B20000; text-align: center; padding: 10px 10px 10px 10px; color: #FFFFFF;">Seu e-mail j&aacute; est&aacute; cadastrado, mas n&atilde;o pelo Facebook.</div>';

            }else if($_GET['e'] == '_errof'){

                echo'<div id="retorno" style="font-family:Calibri, Verdana; font-size: 15px; border: 2px solid #000000; background: #B20000; text-align: center; padding: 10px 10px 10px 10px; color: #FFFFFF;">Erro de conex&atilde;o com Facebook.</div>';

            }else if($_GET['e'] == '_errol'){

                echo'<div id="retorno" style="font-family:Calibri, Verdana; font-size: 15px; border: 2px solid #000000; background: #B20000; text-align: center; padding: 10px 10px 10px 10px; color: #FFFFFF;">Login incorreto.</div>';

            }

        }

    ?>

    <?php include "include/Menu.php"; ?>

    

    <section id="main-slider" class="no-margin">

        <div class="carousel slide wet-asphalt">

            <ol class="carousel-indicators">

                <li data-target="#main-slider" data-slide-to="0" class="active"></li>

                <li data-target="#main-slider" data-slide-to="1"></li>

                <li data-target="#main-slider" data-slide-to="2"></li>

            </ol>

            <div class="carousel-inner">

                <div class="item active" style="background-image: url(images/slider/bg1.jpg)">

                    <div class="container">

                        <div class="row">

                            <div class="col-sm-12">

                                <div class="carousel-content center centered">

                                    <h2 class="boxed animation animated-item-1">Cadastre-se agora e comece a compartilhar!!!</h2>

                                    <p class="boxed animation animated-item-2">Junte-se a nossa comunidade de estudantes, compartilhe o que você sabe com os outros.</p>

                                    <br>

                                    <a class="btn btn-md animation animated-item-3" href="https://www.facebook.com/dialog/oauth?client_id=373538102706671&redirect_uri=http://yeebaplay.com.br/src/cadastra_usuario.php&scope=email,user_website,user_location">CADATRE-SE</a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div><!--/.item-->

                <div class="item" style="background-image: url(images/slider/bg2.jpg)">

                    <div class="container">

                        <div class="row">

                            <div class="col-sm-12">

                                <div class="carousel-content center centered">

                                    <h2 class="boxed animation animated-item-1">Compartilhe apostila com milhares de estudantes</h2>

                                    <p class="boxed animation animated-item-2">A melhor forma de aprender e comparitlhar conhecimento com outros estudantes é aqui no Yeeba.</p>

                                    <br>

                                    <a class="btn btn-md animation animated-item-3" href="about-us.php">Sobre Nós</a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div><!--/.item-->

                <div class="item" style="background-image: url(images/slider/bg3.jpg)">

                    <div class="container">

                        <div class="row">

                            <div class="col-sm-6">

                                <div class="carousel-content centered">

                                    <h2 class="animation animated-item-1">Fórum em forma de postagens, familiarizando com o que você já conhece nas redes sociais.</h2>

                                    <p class="animation animated-item-2">Cada postagem feita no Yeeba deve ser feita compartilhando algo que vá agregar alguma coisa a outras pessoas.</p>

                                    <a class="btn btn-md animation animated-item-3" href="about-us.php">Leia Mais</a>

                                </div>

                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">

                                <div class="centered">

                                    <div style="display: none;" class="embed-container">

                                        <iframe src="//player.vimeo.com/video/69421653?title=0&amp;byline=0&amp;portrait=0&amp;color=a22c2f" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div><!--/.item-->

            </div><!--/.carousel-inner-->

        </div><!--/.carousel-->

        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">

            <i class="icon-angle-left"></i>

        </a>

        <a class="next hidden-xs" href="#main-slider" data-slide="next">

            <i class="icon-angle-right"></i>

        </a>

    </section><!--/#main-slider-->



    <section id="services" class="emerald">

        <div class="container">

            <div class="row">

                <div class="col-md-4 col-sm-6">

                    <div class="media">

                        <div class="pull-left">

                            

                        </div>

                        <div class="media-body">

                            <h3 class="media-heading">Compartilhamento de conteúdo</h3>

                            <p>Tentamos juntar o que a forma tradicional de rede social vem trazendo, o formato de feed de noticías, mas com um diferencial, você não seguirá nenhuma pessoa, mas seguirá temas que mais te interessa, são esses tipos de conteúdo que você verá em seu feed.</p>

                        </div>

                    </div>

                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6">

                    <div class="media">

                        <div class="pull-left">

                          

                        </div>

                        <div class="media-body">

                            <h3 class="media-heading">Fórum divido por área de atuação</h3>

                            <p>Se você faz Ciência da Computação não seria legal ver em seu feed algo sobre moda por exemplo, é por isso que não seguimos pessoas e sim temas, terá sempre o que quer em seu feed, podendo mudar de ideia a qualquer momento.</p>

                        </div>

                    </div>

                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6">

                    <div class="media">

                        <div class="pull-left">

                            

                        </div>

                        <div class="media-body">

                            <h3 class="media-heading">Anotações</h3>

                            <p>Com os dias corridos fica difícil lembrar de tudo, então criamos com objetivo de te ajudar lembrar das matérias, temas, horario de provas, objetivos e muito mais, um bloco de notas perfeito pra você se organizar.</p>

                        </div>

                    </div>

                </div><!--/.col-md-4-->

            </div>

        </div>

    </section><!--/#services-->

    <div>

        <img src="images/capa-da-frente.jpg" width="100%">

    </div>

    <section style="display: none;" id="recent-works">

        <div class="container">

            <div class="row">

                <div class="col-md-3">

                    <h3>Nosso trabalho</h3>

                    <p>Veja algumas telas do site antes de realmente entrar na rede, você é importante para rede caso queira compartilhar conteúdo relevante, seja um criador de conteúdos.</p>

                    <div class="btn-group">

                        <a class="btn btn-danger" href="#scroller" data-slide="prev"><i class="icon-angle-left"></i></a>

                        <a class="btn btn-danger" href="#scroller" data-slide="next"><i class="icon-angle-right"></i></a>

                    </div>

                    <p class="gap"></p>

                </div>

                <div class="col-md-9">

                    <div id="scroller" class="carousel slide">

                        <div class="carousel-inner">

                            <div class="item active">

                                <div class="row">

                                    <div class="col-xs-4">

                                        <div class="portfolio-item">

                                            <div class="item-inner">

                                                <img class="img-responsive" src="images/portfolio/recent/item1.png" alt="">

                                                <h5>

                                                    Nova - Corporate site template

                                                </h5>

                                                <div class="overlay">

                                                    <a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>

                                                </div>

                                            </div>

                                        </div>

                                    </div>                            

                                    <div class="col-xs-4">

                                        <div class="portfolio-item">

                                            <div class="item-inner">

                                                <img class="img-responsive" src="images/portfolio/recent/item3.png" alt="">

                                                <h5>

                                                    Fornax - Apps site template

                                                </h5>

                                                <div class="overlay">

                                                    <a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>

                                                </div>

                                            </div>

                                        </div>

                                    </div>                            

                                    <div class="col-xs-4">

                                        <div class="portfolio-item">

                                            <div class="item-inner">

                                                <img class="img-responsive" src="images/portfolio/recent/item2.png" alt="">

                                                <h5>

                                                    Flat Theme - Business Theme

                                                </h5>

                                                <div class="overlay">

                                                    <a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div><!--/.row-->

                            </div><!--/.item-->

                            <div class="item">

                                <div class="row">

                                    <div class="col-xs-4">

                                        <div class="portfolio-item">

                                            <div class="item-inner">

                                                <img class="img-responsive" src="images/portfolio/recent/item2.png" alt="">

                                                <h5>

                                                    Flat Theme - Business Theme

                                                </h5>

                                                <div class="overlay">

                                                    <a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xs-4">

                                        <div class="portfolio-item">

                                            <div class="item-inner">

                                                <img class="img-responsive" src="images/portfolio/recent/item1.png" alt="">

                                                <h5>

                                                    Nova - Corporate site template

                                                </h5>

                                                <div class="overlay">

                                                    <a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>

                                                </div>

                                            </div>

                                        </div>

                                    </div>                            

                                    <div class="col-xs-4">

                                        <div class="portfolio-item">

                                            <div class="item-inner">

                                                <img class="img-responsive" src="images/portfolio/recent/item3.png" alt="">

                                                <h5>

                                                    Fornax - Apps site template

                                                </h5>

                                                <div class="overlay">

                                                    <a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div><!--/.item-->

                        </div>

                    </div>

                </div>

            </div><!--/.row-->

        </div>

    </section><!--/#recent-works-->



    <section id="testimonial" class="alizarin">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="center">

                        <h2>O que nossos usuários dizem</h2>

                        <p>Você poderá aparecer aqui, basta twittar para @yeebaplay, vou anotar seu twitter aqui e seu comentário sobre a rede (Seja educado).</p>

                    </div>

                    <div class="gap"></div>

                    <div class="row">

                        <div class="col-md-6">

                            <blockquote>

                                <p>Deixei de jogar Dota e passei a estudar mais com o Yeeba.me.</p>

                                <small>Dentro do site: <cite title="Source Title">Erick</cite></small>

                            </blockquote>

                            <blockquote>

                                <p>Desejo sucesso! E mais sucesso que o meu!.</p>

                                <small>Site Twitter: <cite title="Source Title">@marcogomes</cite></small>

                            </blockquote>

                        </div>

                        <div class="col-md-6">

                            <blockquote>

                                <p>Olá, a equipe Tecmundo agradece sua dedicação ao criar essa rede social acadêmica, nós acreditamos que somente a partir da educação poderemos alcançar nossos sonhos, e que com jovens como vocês poderemos mudar não só nosso país mais também mundo. Desejamos todo o sucesso a esse site e a carreira profissional dos fundadores. Att, Equipe NZN.</p>

                                <small>Dentro do site: <cite title="Source Title">Equipe Tecmundo</cite></small>

                            </blockquote>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section><!--/#testimonial-->



   

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