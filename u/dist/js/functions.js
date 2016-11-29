//========================== HOME ===================================
$(document).ready(function() {
    $ ('#pergunta').focus(function(){
        $ ('#pergunta').css("height", "150px");
        $('#rodape_publicacao').show('slow');
    });
    //$ ( '#pergunta' ). blur ( function ()  {
    //    window.setTimeout(function() {
    //       $ ( '#pergunta' ). css ( "height" ,  "50px" );
    //    }, 8000);
    //});
});

//Aparecer campos
$(function(){
    //Função que ao clicar no botão, irá fazer.
    $("#video").click(function(){
        //Aparecer o campo de texto
        $("#video_text").css('display', 'block');
        $("#imagem_text").css('display', 'none');
    });
});

$(function(){
    //Função que ao clicar no botão, irá fazer.
    $("#imagem").click(function(){
        //Aparecer o campo de texto
        $("#imagem_text").css('display', 'block');
        $("#video_text").css('display', 'none');
    });
});

  $(function(){
        $("#btn_adicionar_forum").click(function(){
            $("#display_adicionar_forum").show("slow");   
            $("#display_criar_forum").hide("slow");  
        });
    });

  $(function(){
        $("#btn_criar_forum").click(function(){
            $("#display_criar_forum").show("slow"); 
            $("#display_adicionar_forum").hide("slow");    
        });
    });


function like(postid){
    $.post("include/PostagemCurtir.php", { postid:postid }, function(get_retorno) {
        if(get_retorno != "votou")
        {
            var div = "#"+postid;
            var valorDaDiv = $(div).text();
            valorDaDiv = parseInt(valorDaDiv) + 1;
            $(div).hide("fast").text("");
            $(div).show("slow").text(valorDaDiv);
        }
    });
    $("#postid").hide("slow");
    
};

$(function(){
    window.setTimeout(function() {
    $("#avisoCaixaDeMensagemAviso").hide("slow");
    }, 8000);
});


//Função que ao clicar no botão, irá enviar a postagem
$("#submit-btn-post").click(function(){
    var $post = jQuery.noConflict();
    $post(document).ready(function() { 

    beforeSubmit();
    var opts = {
        url: 'include/PostagemPublicar.php',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            alert(data);
        }
    };
    if(data.fake) {
        // Make sure no text encoding stuff is done by xhr
        opts.xhr = function() { var xhr = jQuery.ajaxSettings.xhr(); xhr.send = xhr.sendAsBinary; return xhr; }
        opts.contentType = "multipart/form-data; boundary="+data.boundary;
        opts.data = data.toString();
    }
    jQuery.ajax(opts);
    afterSuccess(); 

    //after succesful upload
    function afterSuccess()
    {
        $post('#submit-btn-post').show(); //hide submit button
        $post('#loading-img-post').hide(); //hide submit button
        $post('#forum_selecionado').show();
        $post('#video').show();
        $post('#imageInputPost').show();
    }

    //function to check file size before uploading.
    function beforeSubmit(){
        //check whether browser fully supports all File API
       if (window.File && window.FileReader && window.FileList && window.Blob)
        {
            if( !$post('#imageInputPost').val()) //check empty input filed
            {
                $post("#output").html("Voc&ecirc; est&aacute; brincando comigo? [Selecione o arquivo]");
                return false
            }
            
            var fsize = $post('#imageInputPost')[0].files[0].size; //get file size
            var ftype = $post('#imageInputPost')[0].files[0].type; // get file type

            //allow only valid image file types 
            switch(ftype)
            {
                case 'image/jpeg' : 
                case 'image/gif' : 
                case 'image/png' :
                   break;
                default:
                    $post("#output").html("<b>"+ftype+"</b> Tipo de arquivo n&atilde;o suportado!");
                    return false
            }
            
            //Allowed file size is less than 50 MB (209715200)
            if(fsize > 8388608)
            {
                $post("#output").html("<b>"+bytesToSize(fsize) +"</b> O arquivo &eacute; muito grande.");
                return false
            }
                
            $post('#submit-btn-post').hide(); //hide submit button
            $post('#forum_selecionado').hide();
            $post('#video').hide();
            $post('#imageInputPost').hide();
            $post('#loading-img-post').show(); //hide submit button
            $post("#outputPost").html("");  
        }
        else
        {
            //Output error to older unsupported browsers that doesn't support HTML5 File API
            $post("#outputPost").html("Por favor, atualize seu navegador, porque o seu navegador atual carece de algumas novas funcionalidades que precisamos!");
            return false;
        }
    }

    //function to format bites bit.ly/19yoIPO
    function bytesToSize(bytes) {
       var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
       if (bytes == 0) return '0 Bytes';
       var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
       return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }

    }); 

    //Pegando os valores que foram digitados no formulário e colocando nas variáveis nome e email.
    var forum_selecionado = $("#forum_selecionado").val();
    var pergunta = $("#pergunta").val();
    var video_text = $("#video_text").val();

});

//========================== CARREGAR POSTAGEM ===================

$(function(){

    carregar(0, 15, '../pages/include/CarregarPostagem.php');

    $("#clique").click(function(evento){
        evento.preventDefault();
        var init = $(".post-count").length;
        carregar(init, 5, '../pages/include/CarregarPostagem.php');

    });

    function carregar(init, max, url){
        $("#gif_carregamento").show("fast");
        $("#clique").hide("slow");
        //requisição ajax para selecionar postagens
        $.ajax({
           url: url, //Página PHP que seleciona postagens
           type:'POST', // método post, GET ...
           data: {init:init, max:max}, //seus paramêtros
           success: function(data){ // sucesso de retorno executar função
                if(data == "fim") //retorna do PHP a frase
                {
                    $("#clique").hide("slow");//Apaga o texto que carre mais posts
                    $('#conteudo').append("<p><pre><center>Desculpe, não temos mais posts!</center></pre></p>");
                    $("#gif_carregamento").hide("fast");
                }else{
                    $("#gif_carregamento").hide("fast");
                    $('#conteudo').append("<p>"+data+"</p>");
                    $("#clique").show("slow");
                }
           } // fim success
        }); // fim ajax
    }//FIm da função carregar
});

//=================================== Enviar mensagem  ============================================
$(function(){
//Função que ao clicar no botão, irá fazer.
$("#email_envia").click(function(){
    //Aqui diz que antes de enviar, irá aparecer a div carregando_form, com efeito slow.
    beforeSend:$("#carregando_form").show("slow");
    //Pegando os valores que foram digitados no formulário e colocando nas variáveis nome e email.
    var id_destino = $("#id_destino").val();
    var email_mensagem = $("#email_mensagem").val();
    //Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
    $.post("include/MensagemEnviar.php", { id_destino:id_destino, email_mensagem:email_mensagem }, function(get_retorno) {
        //Depois que foi completado o cadastro e tem a mensagem de retorno, esconde a div carregando_form que tem a barra de carregamento.
        complete:$("#carregando_form").hide("slow");
        //Aqui coloca o valor que retono na função get_retorno dentro da div retorno, e mostra a div com efeito em slow.
        window.location.assign("mensagem.php");
    });
});

window.setTimeout(function() {
    $("#avisoCaixaDeMensagem").hide("slow");
    }, 3000);
});


//================================== Responder Mensagens ==============================================

$(function(){
    //Função que ao clicar no botão, irá fazer.
    $("#email_envia_resposta").click(function(){
    //Aqui diz que antes de enviar, irá aparecer a div carregando_form, com efeito slow.
    beforeSend:$("#carregando_form").show("slow");
    //Pegando os valores que foram digitados no formulário e colocando nas variáveis nome e email.
    var id_destino = $("#id_destino").val();
    var email_mensagem = $("#email_mensagem").val();
    var id_mensagem = $("#id_mensagem").val();
    //Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
    $.post("include/MensagemResposta.php", { id_destino:id_destino, email_mensagem:email_mensagem, id_mensagem:id_mensagem }, function(get_retorno) {
            //Depois que foi completado o cadastro e tem a mensagem de retorno, esconde a div carregando_form que tem a barra de carregamento.
            complete:$("#carregando_form").hide("slow");
            //Aqui coloca o valor que retono na função get_retorno dentro da div retorno, e mostra a div com efeito em slow.
            document.getElementById("email_mensagem").value = "";
            if(get_retorno == "Nenhuma mensagem foi escrita.")
            {
                $("#retorno").show("slow").text(get_retorno);
            }else{
                $("#retorno_bate_papo").show("slow").append(get_retorno);
            }
        });
    });
});

//================================== NOTAS ==================================================

$(function(){
    //Função que ao clicar no botão, irá fazer.
    $("#envia_notas").click(function(){

    //Pegando os valores que foram digitados no formulário e colocando nas variáveis nome e email.
    var nota = CKEDITOR.instances.nota_b.getData();
    var titulo = $("#titulo").val();
    var ID = $("#ID").val();

    //Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
    $.post("include/NotasAdicionar.php", { nota:nota, titulo:titulo, ID:ID }, function(get_retorno) {
        //Antes de começar qualquer teste, apaga o que tempnam
        $("#retornoAviso").hide("slow");
        //Aqui coloca o valor que retono na função get_retorno dentro da div retorno, e mostra a div com efeito em slow.
        if(get_retorno == "<pre><b><center>Não consegui ver nenhuma nota escrita ainda.</center></b></pre>" || get_retorno == "<pre><b><center>E o título?</center></b></pre>")
        {  
            $("#retornoAviso").fadeIn("slow").html(get_retorno);
        }
        else
        {
            $("#retorno_da_nota").show("slow").append(get_retorno);
            $("#nota_aviso").hide("fast"); //Apaga a mensagem de aviso
        }
        document.getElementById("titulo").value = "";
        });
    });
});


$(function(){
    //Função que ao clicar no botão, irá fazer.
    $("#atualizar_notas").click(function(){
        //Pegando os valores que foram digitados no formulário e colocando nas variáveis nome e email.
        var nota = CKEDITOR.instances.nota_b.getData();
        var titulo = $("#titulo").val();
        var id_nota = $("#id_nota").val();
        alert("Atualizando nota: " + titulo);
        //Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
        $.post("include/NotasEditar.php", { nota:nota, titulo:titulo, id_nota:id_nota }, function(get_retorno) {
            
        });
    });
});


$(function(){
    //Função que ao clicar no botão, irá fazer.
    $("#add_nota").click(function(){
    //Aparecer o campo de texto
    $("#formulario_nota").show("slow");

    });
});

//Função para mostrar dados do usuário
$(function(){
    //Função que ao clicar no botão, irá fazer.
    $("#visualizar_informacoes").click(function(){
    //Aparecer o campo de texto
        $("#visualizar_informacoes").hide("fast");
        $("#dados_usuario").show("fast");
    });
});

//Fuñção para adicionar forum no config.php
$(function(){
    //Função que ao clicar no botão, irá fazer.
    $("#adicionar_forum").click(function(){
        //Pegando os valores que foram digitados no formulário e colocando nas variáveis
        var country_id = $("#country_id").val();
        //Enviando as variáveis com os valores para a página php
        $.post("include/ForumAdicionar.php", { country_id:country_id }, function(get_retorno) {
            //Aqui coloca o valor que retono na função get_retorno dentro da div retorno, e mostra a div com efeito em slow.
            document.getElementById("country_id").value = "";
            $("#retorno").show("slow").append(get_retorno);
            $("#info_configuracao").hide("slow"); //Excluir a mensagem de tutorial
        });
    });
});

//Fuñção para criar um novo forum no config.php
$(function(){
    //Função que ao clicar no botão, irá fazer.
    $("#criar_forum").click(function(){
        //Pegando os valores que foram digitados no formulário e colocando nas variáveis
        var nomeForum = $("#nome_forum").val();

        //Enviando as variáveis com os valores para a página php
        $.post("include/ForumCriar.php", { nomeForum:nomeForum }, function(get_retorno) {
            //Aqui coloca o valor que retono na função get_retorno dentro da div retorno, e mostra a div com efeito em slow.
            //document.getElementById("nomeForum").value = "";
            //document.getElementById("senha_forum").value = "";
            if(get_retorno === "1"){
                $("#aviso_forum_existente").show("slow");
            }else{
               $("#retorno_foruns_meus").show("slow").append(get_retorno); 
            }
            
        });
    });
});


//Deletar forum config.php
function deletarForum(idForum){
    var div = "#"+idForum;
    //Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
    $.post("include/DeletarForum.php", { idForum:idForum }, function(get_retorno) {
        if(get_retorno == 'deletado'){
            $(div).hide("slow");
        }
    });
}


//Notificações limpa
$(function(){
    //Função que ao clicar no botão, irá fazer.
    $("#notificacoes").click(function(){
        var id = $("#idUsuario").val(); 
        //Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
        $.post("include/AtualizarNotificacoes.php", {id:id}, function(get_retorno) {
            
            $("#notificacoes").removeClass("fa-2x");
            $("#notificacoes").addClass("fa-1x");
        });
    });
});

//======================== EXPLORAR ================================

function adicionarForum(idPost)
{
    //Enviando as variáveis com os valores para a página envia_formulario.php e criando uma nova função para pegar o retorno da página envia_formulario.php
    $.post("include/AdicionarForumExplorar.php", { idPost:idPost }, function(get_retorno) {
    $("#"+idPost).hide("slow");
    });
}