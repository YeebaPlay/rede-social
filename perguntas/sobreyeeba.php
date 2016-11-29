<html>
<head>

<style type="text/css">
  /**
  * Definir a largura e centraliza os itens da sanfona
  */
  .accordions{
      width:630px;
      margin:0 auto;
      border:1px solid #ccc;
	  
  }
  
  .cor{
		color: #FFF;
		padding: 10px;
		
  }
  /**
  * Oculta o input
  */
  .accordion-item input{display:none;}

  /**
   * Aqui configura o label
   * que será parte clicável
  **/
  .accordion-item label{
      display:block;
      border:1px solid #FFF;
      background:#333333;
      cursor:pointer;
  }

  /**
  * Aqui o elemento que vai o conteúdo.
  * Define o height:0, para aplicarmos o efeito
  * colocamos overflow:hidden não mostrar o último item
  * O transition o tipo de efeito que queremos
  */
  .accordion-content{
	  color: #333333;
      height: 0px;
      overflow: hidden;
      -webkit-transition: height 0.3s ease-in-out;
      -moz-transition: height 0.3s ease-in-out;
      -o-transition: height 0.3s ease-in-out;
      -ms-transition: height 0.3s ease-in-out;
      transition: height 0.3s ease-in-out;
  }

  /**
  * Selecionar o elemento que está precedente
  * do tipo com atributo checked, sendo
  * que o ID comece o accordion
  * E dentro dele, definimos a altura,
  * mostrando o conteúdo
  */
  [id^=accordion]:checked ~ .accordion-content {
      height: 100px;
  }
  
  .width3{
	margin-top: -220px;
	float:left; width:635px; height:85%; 
	background-color: #F5F5F5;
	border-top:1px solid #ccc;
	border-left:1px solid #ccc;
	border-right:1px solid #ccc;
	border-bottom:1px solid #ccc;
	
	}
	
	
  </style>


</head>
<body>

<div class="width3">

<!-- Sidebar -->
<div class="width"> 

<div class="accordions">

 

          <div class="accordion-item">

              <input type="checkbox" name="accordion" id="accordion-1" />

              <label class="cor" for= "accordion-1">O que eh o Yeeba?</label>

              <div class="accordion-content">O Yeeba eh uma rede para facilitar alunos e professores a encontrarem e compartilharem conteudo, alem de oferecer informacoes sobre estagios e empregos em sua cidade filtrando cada um por curso. Com o Yeeba voce monta salas de aula compartilhando arquivos apenas com alunos de sua sala (O professor tem todo controle de cada aluno)</div>

          </div>

 

          <div class="accordion-item">

              <input type="checkbox" name="accordion" id="accordion-2" />

              <label class="cor" for= "accordion-2">Por que nao encontro minha faculdade?</label>

              <div class="accordion-content">Nos envie um formulario para adicionar sua faculdade ao nosso sistema</div>

          </div>

 

          <div class="accordion-item">

              <input type="checkbox" name="accordion" id="accordion-3" />

              <label class="cor" for= "accordion-3">Tenho privacidade nos conteudos que posto?</label>

              <div class="accordion-content">Todo arquivo publicado fora da sala de aula sera publico para qualquer estudante acessar, arquivos adicionados dentro da sala de aula podera ser ou não publico</div>

          </div>
		  
		  
		  <div class="accordion-item">

              <input type="checkbox" name="accordion" id="accordion-4" />

              <label class="cor" for= "accordion-4">Posso compartilhar arquivos com direitos autorais?</label>

              <div class="accordion-content">Todo arquivo com direitos autorais sera de responsabilidade da pessoa que esta compartilhando.</div>

          </div>
		  
		  
		  <div class="accordion-item">

              <input type="checkbox" name="accordion" id="accordion-5" />

              <label class="cor" for= "accordion-5">Como o Yeeba pode te ajudar nos estudos?</label>

              <div class="accordion-content">Com um grande quantidade de conteudo forum de discucoes, alem de poder fazer qualquer pergunta relacionadas ao meio academico. Ja para os professores poderao criar turmas para gerenciar e limitar os arquivos a serem divulgados na rede</div>

          </div>

		  
      </div>



</div>
</div>


</body>
</html>