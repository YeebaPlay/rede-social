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
    <?php include "Config/config_sistema.php"; ?>

    <?php include "include/Menu.php"; ?>

    <section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Política de Privacidade</h1>
                    <p>Leia nossa política de privacidade</p>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li class="active">Privacy Policy</li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!--/#title--> 

    <section id="privacy-policy" class="container">
        <p> 
            Existem muitas maneiras diferentes pelas quais o usuário pode usar nossa rede – 
            pesquisar e compartilhar informações, comunicar-se com outras pessoas ou criar novo 
            conteúdo. Quando o usuário compartilha informações conosco, por exemplo, criando uma 
            conta com os dados fornecidos pelo Facebook isso vai trazer mais segurança pois não 
            vamos nem chegar perto de ter uma senha, toda altenticação é feita pelo Facebook
            , podemos tornar a rede ainda melhor, ajudá-lo a se conectar com pessoas ou tornar o 
            compartilhamento com outras pessoas mais rápido e fácil. Nós do Yeeba queremos ser claros quanto ao modo como estamos usando suas informações e ao 
            modo como o usuário pode proteger sua privacidade.
        </p>
    <h3>Segurança:</h3> 
    <p>
        Suas informações estão totalmente protegidas na rede, começando pelo acesso, utilizamos apenas
        a forma de cadastro do Facebook, de forma mais segura você vai compartilhar na rede sem se preocupar
        com seus dados.
    </p>

    <h3>Direito Autoral:</h3> 
    <p>
        Temos sempre que tomar cuidado com o que compartilhamos, por mais que queremos liberdado na hora de
        absorver conhecimento, temos que tomar cuidado com o direito autoral, suas apostilas poderão ser excluídas
        pelo site para manter o próprio site em pleno funcionamento.
    </p>

    <h3>Altarações na política</h3>
    <p>
        Nossa Política de Privacidade pode ser alterada de tempos em tempos. Nós não reduziremos os direitos do usuário nesta Política de Privacidade sem seu consentimento explícito. Publicaremos quaisquer alterações da política de privacidade nesta página e, se as alterações forem significativas, forneceremos um aviso com mais destaque (incluindo, para alguns serviços, notificação por e-mail das alterações da política de privacidade).
    </p>
    
    <h2>
        Mantemos as informações pessoais do usuário particulares, seguras e controladas.
    </h2>
</section><!--/#privacy-policy-->

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