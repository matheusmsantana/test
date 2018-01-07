<?php

    session_start();

    //Verificando se usuario nao esta logado
    if(!isset($_SESSION['usuario'])){
        header('Location: index.php?erro=1');
    }

    $id_usuario = $_SESSION['id_usuario'];
    $task = $_POST['task'];
    $descricao = $_POST['descricao'];

    require_once('class/db.class.php');


    if(isset($_FILES['anexo'])){

        //Recuperando nome do arquivo
        $arq = $_FILES['anexo']['name'];
        $nome_arquivo = str_replace(",","_",$arq);

            //verificando se o arquivo é existente
            if(file_exists("attachment/$nome_arquivo")){
                $i = 1;
                while(file_exists('attachment/('.$i.')'.$nome_arquivo.'')){
                $i++;
                //echo $nome_arquivo;
                }
            //renomeando arquivo
            $nome_arquivo = '('.$i.')'.$nome_arquivo;
            }
    
        $extensoes_permitidas = array('.csv', '.tsv', '.pdf', '.doc', '.docx', '.hs', '.xls', '.xlsx', '.txt', '.mdb', 'dbf', '.ppt');
        $extensao = strrchr($_FILES['anexo']['name'], '.');

            //Validando extenções
            if(in_array($extensao, $extensoes_permitidas) === true){

                //Movendo anexo para pasta attachment
                if(move_uploaded_file($_FILES['anexo']['tmp_name'], "attachment/".$nome_arquivo)){
    
                    $objDb = new db();
    
                    $link = $objDb->conecta_mysql();
    
                $sql = " INSERT INTO tasks (id_usuario , task, descricao, attachment) ";
                $sql.= " VALUES ($id_usuario , '$task', '$descricao', '$nome_arquivo') ";
    

                    if(mysqli_query($link, $sql)){ //query == true
                        header('Location: home.php');
                    }else{
                        echo "Erro ao registrar tarefa";
                    }

                }else{
                    echo 'Erro ao salvar arquivo';
                }

            }else{
                header('Location: inserir_task.php?erro=3');
        
            }

    }