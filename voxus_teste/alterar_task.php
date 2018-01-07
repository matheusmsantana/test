<?php

    session_start();
    //Verificando se usuario nao esta logado
    if(!isset($_SESSION['usuario'])){
        header('Location: index.php?erro=1');
	}

	$erro_extencao = isset($_GET['erro']) ? $_GET['erro'] : 0;
    $id_usuario = $_SESSION['id_usuario'];   
    $codigo = $_GET['codigo'];

	require_once('class/db.class.php');

    $objDb = new db();
    
    $link = $objDb->conecta_mysql();

    $sql = " SELECT id_task, task, descricao, attachment FROM tasks ";
    $sql.= " WHERE id_usuario = $id_usuario AND id_task = $codigo ";

    /*resultado_id esta recebendo resultado da minha query*/
    $resultado_id = mysqli_query($link, $sql);

    if($resultado_id){//resource == true

        //transformando resource em um array e atribuindo na variavel $registro
        $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
        //var_dump($registro);

        $id_task = $registro['id_task'];
        $task = $registro['task'];
        $descricao = $registro['descricao'];
        $attachment = $registro['attachment'];

    }else{
        echo'erro na consulta de tasks';
    }
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Alterar Tarefas</title>
		
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
	                        <li><a href="home.php">Voltar</a></li>
	                    </ul>
	                </div>
	        </div>
	    </nav>

	    <div class="container">
	    	
	    	<br/><br/>

	    	<div class="col-md-4"></div>
	    	<div class="col-md-4">
	    			<h3>Altere sua Tarefa</h3>
	    			<br/>
					<form method="post" action="update_task.php?codigo=<?= $registro[id_task] ?>" id="formInserirTask" enctype="multipart/form-data">
						<div class="form-group">
							<input type="text" class="form-control" id="task" name="task" placeholder="Nome da tarefa" required="requiored">
						</div>

						<div class="form-group">
                            <textarea class="form-control" id="descricao" name="descricao" rows="6" placeholder="Descrição da tarefa" required="requiored"></textarea>
						</div>
					
						<div class="form-group">
							<input type="file" class="form-control" id="anexo" name="anexo" required="requiored">

							<?php
								if($erro_extencao){
									echo '<font style="color:#FF0000"><p>Estenção de arquivo invalida</p></font>';
								}
							?>	

						</div>
					
						<button type="submit" class="btn btn-primary form-control">Alterar</button>
					</form>
				</div>
			<div class="col-md-4"></div>

			<div class="clearfix"></div>
			<br/>
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>

		</div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>