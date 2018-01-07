<?php

    require_once('class/db.class.php');

    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']); //criptografia de dados 32bits

    $objDb = new db();

    $link = $objDb->conecta_mysql();

    /*variaves para validação de cadastro de usuario*/
    $usuario_existe = false;
    $email_existe = false;

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    /*Verificando usuario cadastrado*/
    if($resultado_id = mysqli_query($link, $sql)){

        $dados_usuario = mysqli_fetch_array($resultado_id);

        if(isset($dados_usuario['usuario'])){
            $usuario_existe = true;
        }    
    }else{
    echo"Erro ao tentar localizar registro de usuario";
    }

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    /*Verificando email cadastrado*/
    if($resultado_id = mysqli_query($link, $sql)){

        $dados_usuario = mysqli_fetch_array($resultado_id);
  
        if(isset($dados_usuario['email'])){
            $email_existe = true;
        }    
    }else{
        echo"Erro ao tentar localizar registro de usuario";
    }

    if($usuario_existe || $email_existe){

        $retorno_get = '';

        if($usuario_existe){
    
            $retorno_get.= "erro_usuario=1&";
        }

        if($email_existe){

        $retorno_get.= "erro_email=2";
        }
        //redirecionando o usuario para form de cadastro e concatenando a url com $retorno_get
        header('Location: inscrevase.php?' . $retorno_get);
        die();
    }

    $sql = "INSERT INTO usuarios (usuario, email, senha) VALUES ('$usuario', '$email', '$senha')";

    if(mysqli_query($link, $sql)){ 
        header('Location: index.php?cadastro=4');
    }else{
        //query == false
        echo "Erro ao registrar o usuário!";
    }
