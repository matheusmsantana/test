<?php

    session_start();

    require_once('class/db.class.php');

    $email = $_POST['email'];

    //criptografando senha para fazer a comparação
    $senha = md5($_POST['senha']);

    $sql = "SELECT id, usuario, email FROM usuarios WHERE email = '$email' AND senha = '$senha'";

    $objDb = new db();

    $link = $objDb->conecta_mysql();

    //executando a query, e atribuindo o resultado na variavel $resultado_id
    $resultado_id = mysqli_query($link, $sql);

    if($resultado_id){//resource == true
        
        //transformando resource em um array e atribuindo na variavel $dados_usuario
        $dados_usuario = mysqli_fetch_array($resultado_id);

            //Checando o campo usuario, se o usuario existente
            if(isset($dados_usuario['usuario'])){
                //criando variaveis de sessão 
                $_SESSION['id_usuario'] = $dados_usuario['id'];
                $_SESSION['usuario'] = $dados_usuario['usuario'];
                $_SESSION['email'] = $dados_usuario['email'];
                
                header('Location: home.php');
            }else{
                //redirecionando o usuario para index e atribuindo erro=1 na URL
                header('Location: index.php?erro=1');
            }
    }else{
        echo"Erro na execução da consulta";
    }