<?php

    session_start();
    //Verificando se usuario nao esta logado
    if(!isset($_SESSION['usuario'])){
        header('Location: index.php?erro=1');
	}
	
	$id_usuario = $_SESSION['id_usuario'];

	require_once('class/db.class.php'); 

	$objDb = new db();
        
    $link = $objDb->conecta_mysql();

	/*Consulta para contar todas as tasks*/
	$sql = " SELECT COUNT(id_task) AS qtde_tasks FROM tasks where id_usuario = $id_usuario ";

	$qtde_tasks = 0;

    //atribuindo result da query em $resultado_id
	$resultado_id = mysqli_query($link, $sql);
	
	
	if($resultado_id){
		//resource == true, utilizo mysqli_fetch_array para gerar um array e atribuo em $registro
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);

		$qtde_tasks = $registro['qtde_tasks'];
	}else{
		echo'erro na consulta de tarefas';
	}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Home</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

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
                        <!--destruindo variaveis de sessão-->
	                    <li><a href="sair.php">Sair</a></li>
	                </ul>
	            </div>
	        </div>
	    </nav>

	    <div class="container">
			    <!--informaçoes de usuario-->
	    	    <div class="col-md-2">
					    <div class="panel panel-default">
						    <div class="panel-body">
							        <h4><?= $_SESSION['usuario'] ?></h4>
							    <!--Linha horizontal-->
							    <hr>
							    <div class="col-md-6">
								    Tarefas </br> <?php echo $qtde_tasks;?>
							    </div>
						    </div>
					    </div>
				</div>
				
	    	<div class="col-md-8">
				<div id="tasks" class="list-group"> 
					<!--tarefas do usuario-->
					<?php require_once('get_task.php') ?>
				</div>
			</div>

			<div class="col-md-2">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4><a href="inserir_task.php">Criar Tarefa</a></h4>
					</div>
				</div>
			</div>

		</div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>