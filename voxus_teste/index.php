<?php
	//caso $_GET['erro'] esteja iniciado atribuo seu valor na variavel $erro
	$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
	$cadastro = $_GET['cadastro'] ? $_GET['cadastro'] : 0;
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
		<script>	
	
			$(document).ready( function(){
				
				$('#btn_login').click(function(){

					var campo_vazio = false;

					//Validando se o formulario de login contem valor
					if($('#campo_usuario').val() == ''){

						//alterando atributo css
						$('#campo_usuario').css({'border-color': '#A94442'});
						campo_vazio = true;
					}else{
						$('#campo_usuario').css({'border-color': '#CCC'});
					}
	
					if($('#campo_senha').val()== ''){
							$('#campo_senha').css({'border-color': '#A94442'});
							campo_vazio = true;
					}else{
						$('#campo_senha').css({'border-color': '#CCC'});
					}

					//var campo_vazio == true impesso submissão do form
					if(campo_vazio){
						return false;
					} 
				});
			});

		</script>
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	        <div class="container">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	                    <span class="sr-only">Toggle navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	            </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	            <ul class="nav navbar-nav navbar-right">
	                <li><a href="inscrevase.php">Inscrever-se</a></li>
					<!--atribuindo class open caso $erro==1-->
	                <li class="<?= $erro == 1 ? 'open' : ''; ?>">

	            	<a id="entrar" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entrar</a>
					<ul class="dropdown-menu" aria-labelledby="entrar">
						<div class="col-md-12">
				    		<br/>
							<form method="post" action="validar_acesso.php" id="formLogin">
								<div class="form-group">
									<input type="text" class="form-control" id="campo_usuario" name="email" placeholder="Email" />
								</div>
								
								<div class="form-group">
									<input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
								</div>
								
								<button type="buttom" class="btn btn-primary" id="btn_login">Entrar</button>

								<br/><br/>
								
							</form>
							<!--Retornando mensagem de erro para o usuario-->
							<?php
								if($erro == 1){
									echo'<font color="#FF0000">email ou senha invalido(s)</font>';
								}
							?>
                        </div>
				  	</ul>
	                </li>
	            </ul>
	        </div><!--navbar-collapse -->
	        </div><!--container-->
	    </nav>
		
		<?php 
			if($cadastro){

				echo '<div class="container">';
					echo '<div class="jumbotron">';
						echo '<p>Cadastro realizado com sucesso</p>';
					echo '</div>';
				echo'</div>';
			} 
		?>				

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>
