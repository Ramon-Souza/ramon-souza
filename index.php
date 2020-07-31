

<!DOCTYPE html>
<html>
<head>
	<meta  content="text/html; charset="utf-8  http-equiv="Content-Type">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- CSS DO MATERIALIZE-->
	<link rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection" />


	
</head>
<body>
	<nav class="black">
		<div class="nav-wrapper container">
				<div class="brand-logo light"> Sistema de Cadastro</div>
				<ul class="right">
					<li><a href=""><i class = " material-icons left">account_circle</i>cadastro</a></li>

					<li><a href=""><i class = "material-icons left">search</i>consultas</a></li>
		</div>
	</nav>
<!-- Formulário de cadastro-->

	<div class="row container">
		<p>&nbsp</p>
		<form action="index.php" method="POST" class="col s12">
			<fieldset class="formulario"> 

				<legend>Cadastro</legend>

				<?php
					if(isset($_SESSION['msg'])):
						echo $_SESSION['msg'];
						session_unset();
					endif;


				?>
				

				<?php
				if ($_SERVER['REQUEST_METHOD'] == 'POST'){
					$tipo_de_pessoa = $_POST['tipo_de_pessoa'];
					$nome = $_POST['nome'];
					$cpf = $_POST['cpf'];
					$razao_social = $_POST['razao_social'];
					$vinculo = $_POST['vinculo'];
					$telefone = $_POST['telefone'];
					$celular = $_POST['celular'];
					$email = $_POST['email'];
					$cep = $_POST['cep'];
					$cidade = $_POST['cidade'];
					$municipio = $_POST['municipio'];
					$endereco = $_POST['endereco'];
					$numero = $_POST['numero'];
					$complemento = $_POST['complemento'];


		$db_connect = new mysqli('localhost','root','root', 'db_cadastro', '8889');


		



				}
				?>

			<div>
        <label>Tipo de Pessoa:</label>&nbsp<br><br>
        <p>
      <label>
        <input name="tipo_de_pessoa" type="radio"  value= "fisica"checked />
        <span>Física</span>&nbsp&nbsp&nbsp
      </label>
    
      <label>
        <input name="tipo_de_pessoa" type="radio" value= "juridica" />
        <span>Jurídica</span>
      </label>
    </p>&nbsp

        <label>Nome:</label><br>
        <input type="text" name="nome" id="nome" maxlength="50" required autofocus/><br>

        <label for="cpf">CPF/CNPJ:</label><br>
        <input type="text" name="cpf" id="cpf" maxlength="20" required autofocus/><br>
                    
        <label for="cpf">Razão Social:</label><br>
        <input type="text" name="razao_social" id="razao_social" maxlength="70" required autofocus/> 
         
        <label>Vínculo:</label><br><br>
        <label>
        <input name="vinculo" type="radio" id= "vinculo" value= "cliente"checked />
        <span>Cliente</span>&nbsp</label> 
        <label>
        <input name="vinculo" type="radio" id= "vinculo"  value="fornecedor"/>
        &nbsp<span>Fornecedor</span>&nbsp</label>
        <label>
        <input name="vinculo" type="radio" id= "vinculo" value="funcionario"/>
        &nbsp<span>Funcionário</span></label> <br>

        <br> <label for="telefone">Telefone:</label><br>
        <input type="tel" name="telefone" id="telefone" maxlength="15"  autofocus><br>

        <br> <label for="celular">Telefone:</label><br>
        <input type="tel" name="celular" id="celular" maxlength="15"  autofocus><br>

        <label for="email">E-mail:</label> <br>
        <input type="email" name="email" id="email" maxlength="50"  autofocus><br>                


        <label>Cep:</label><br>
        <input name="cep" type="text" id="cep" value="" size="10" maxlength="9"
               onblur="pesquisacep(this.value);" /><br>
        <label>Rua:</label><br>
        <input name="rua" type="text" id="rua" size="60" /><br>

        <label>Bairro:</label><br>
        <input name="bairro" type="text" id="bairro" size="40" /><br>

        <label>Cidade:<br>
        <input name="cidade" type="text" id="cidade" size="40" ><br>

        <label>Estado:<br>
        <input name="uf" type="text" id="uf" size="2" /><br>

        <label for="numero">Número:</label><br>
        <input type="text" name="numero" id="numero" maxlength="10" required autofocus><br>

        <label for="complemento">Complemento:</label><br>
        <input type="text" name="complemento" id="complemento" maxlength="30" autofocus><br><br>
                    
                    
        <input type="submit" value="cadastrar" class = "btn 
 grey">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <input type="submit" value="limpar" class = "btn  orange">


</div>

            </div>
    <script>
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
           
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
          
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
             

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>
    





<script type="text/javascript" src="materialize/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="materialize/js/materialize.min.js"></script>

<!-- INICIALIZAÇÃO -->
<script type="text/javascript"> 
	$(document).ready(function(){

	});

	
</script>
</body>
</html>