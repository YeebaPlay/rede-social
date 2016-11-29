# rede-social
Rede social acadêmica liberada para todos os desenvolvedores utilizarem e melhorarem o sistema, o sistema foi feito em 2012 quando estava aprendendo a desenvolver em PHP, por esse motivo tem muito comando ultrapassado e vulnerabilidade (SQL INJECTION), estou abrindo o código da rede para que qualquer um que deseja utiliza-lo possa melhora-lo e subi-lo para o repositório, sendo de livre uso a todos.

<b>COMO CONFIGURAR</b>

Dentro da pasta Config tem um arquivo de configuração com os seguintes dados:

$local_serve = "localhost"; 	 // local do servidor <br />
$usuario_serve = "USUARIO";		 // nome do usuario <br />
$senha_serve = "DIGITE_SENHA";			 	 // senha <br />
$banco_de_dados = "NOME_BANDO"; 	 // nome do banco de dados <br />

Preencha cada um dos campos com os dados do seu banco (Lembre-se de criar um banco antes de importar o sql)

<b>COMO IMPORTAR O BANCO</b>

Basta você ir até o MySql e criar um novo banco, depois importar o arquivo banco.sql dentro do repositório

<b>CADASTRO COM O FACEBOOK</b>

Para que funcione o cadastro com o Facebook você deverá ter um cadastro como desenvolvedor no Facebook, criando um aplicativo você receberá um ID e uma senha, essas duas informações são importantes para o funcionamento do sistema.

Adicionar nos locais que se encontra ID e SECRET, adicione seu ID do Facebook e a senha do aplicativo faça o mesmo para os seguintes diretórios:
/u/pages/logar.php
/src/cadastra_usuario.php
/include/Menu.php

Obs. No Menu.php os ID se encontra na URL, assim como o cadastra_usuario.php também possui ID na URL do Facebook.

Nota: O ideal para que o sistema continue funcionando de forma mais fácil seria em um único arquivo configurar todo sistema, o mesmo ainda não foi feito, quem tiver um tempo para ajudar com melhorias será muito bem vindo.


<b> VEJA O SISTEMA ONLINE </b>
Acesse esse link e cadastre-se pelo Facebook: http://yeebaplay.com.br/yeeba/

