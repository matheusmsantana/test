<?php

    session_start();
    //Verificando se usuario nao esta logado
    if(!isset($_SESSION['usuario'])){
        header('Location: index.php?erro=1');
    }

    $id_usuario = $_SESSION['id_usuario'];   
    $result = $_GET['codigo'];

    $registros = explode(",", $result);
    //var_dump($registros);

    echo $registros[0] . '<br>';
    echo $registros[1];
    $id_task = $registros[0];
    $arq = $registros[1];

    if(is_file('attachment/' . $arq)){
        unlink('attachment/' . $arq);    
        //echo $attachment;
    }

    require_once('class/db.class.php');

    $objDb = new db();

    $link = $objDb->conecta_mysql();

    $sql = " DELETE FROM tasks ";
    $sql.= " WHERE id_task = $id_task AND id_usuario = $id_usuario ";

    $resultado_id = mysqli_query($link, $sql);

    if($resultado_id){
        header('Location: home.php');
    }else{
        echo'erro no delete de task';
    }
