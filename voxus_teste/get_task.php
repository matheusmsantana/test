<?php

    session_start();
    //Verificando se usuario nao esta logado
    if(!isset($_SESSION['usuario'])){
       header('Location: index.php?erro=1');
    }

    require_once('class/db.class.php');

    $id_usuario = $_SESSION['id_usuario'];

    $objDb = new db();
        
    $link = $objDb->conecta_mysql();

    $sql = " SELECT id_task, task, descricao, attachment FROM tasks ";
    $sql.= " WHERE id_usuario = $id_usuario ";
    $sql.= " ORDER BY id_task DESC "; 

    /*resultado_id esta recebendo resultado da minha query*/
    $resultado_id = mysqli_query($link, $sql);

    if($resultado_id){
        //percorrendo array e atribuindo cada valor em $registro
        while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
            //var_dump($registro);
            $retorno_get.= $registro[id_task] .','. $registro['attachment'] ;
            
            echo'<span class="list-group-item" id="">';
                echo'<h4 class="list-group-item-heading-center">'.$registro[task].'</h4>';
                echo'<p class="list-group-item-text">'.$registro[descricao].'</p> <br/>';
                
                $caminho = fopen('attachment/' . $registro['attachment'] ,r);
                while (!feof($caminho)){

                    $linha = fgets($caminho);
                    $quebra_linha = nl2br($linha);
                    echo'<p class="list-group-item-text">'.$quebra_linha.'</p>';
                }
                fclose();
    
                echo'<p class="list-group-item-text"> <br/><br/>';
                    echo'<a href="alterar_task.php?codigo='.$registro[id_task].'"><button type="button" id="btn_alterar_task" class="btn btn-default">Alterar</button></a>';
                    echo'<a href="excluir_task.php?codigo='.$retorno_get.'"><button type="button" id="btn_excluir_task" class="btn btn-danger">Excluir</button></a>';
                echo'</p>';
                echo '<br>';
            echo '</span>';
            echo '<br/>';

        }
    }else{
        
        echo'erro na consulta de tasks';
    }

?>