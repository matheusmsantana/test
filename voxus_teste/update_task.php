<?php

    session_start();
    //Verificando se usuario nao esta logado
    if(!isset($_SESSION['usuario'])){
        header('Location: index.php?erro=1');
    }

    $id_usuario = $_SESSION['id_usuario'];   
    $codigo = $_GET['codigo'];

    $task = $_POST['task'];
    $descricao = $_POST['descricao'];

    require_once('class/db.class.php');

    $objDb = new db();
        
    $link = $objDb->conecta_mysql();

    $sql1 = " SELECT attachment FROM tasks ";
    $sql1.= " WHERE id_task = $codigo AND id_usuario = $id_usuario ";

    $resultado_id = mysqli_query($link, $sql1);

    if($resultado_id){//resource == true
    $registro = mysqli_fetch_array($resultado_id);
    }


    if(isset($_FILES['anexo'])){
    
        //Recuperando nome do arquivo
        $arq = $_FILES['anexo']['name'];
        $nome_arquivo = str_replace(",","_",$arq);
        //var_dump($nome_arquivo);
    
        $extensoes_permitidas = array('.csv', '.tsv', '.pdf', '.doc', '.docx', '.hs', '.xls', '.txt', '.mdb', 'dbf', '.ppt');
        $extensao = strrchr($_FILES['anexo']['name'], '.');

        //Validando extenções
        if(in_array($extensao, $extensoes_permitidas) === true){
            
            if(isset($registro['attachment'])){
                
                if(is_file('attachment/' . $registro['attachment'])){
                    //excluindo arquivo anterior
                    unlink('attachment/' . $registro['attachment']);    
                }
            }

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

            //Movendo anexo para pasta attachment
            if(move_uploaded_file($_FILES['anexo']['tmp_name'], "attachment/".$nome_arquivo)){
                
                $sql = " UPDATE tasks SET ";
                $sql.= " task = '$task', descricao = '$descricao', attachment = '$nome_arquivo' ";
                $sql.= " WHERE id_task = $codigo AND id_usuario = $id_usuario ";
    
                if(mysqli_query($link, $sql)){ //query == true
                    header('Location: home.php');
                }else{
                    echo "Erro ao alterar tarefa";
                }
    
            }else{
                echo 'Erro ao salvar arquivo';
            }
    
        }else{
            $codigo.= '&erro=3';
            header('Location: alterar_task.php?codigo='.$codigo.'');
            
        }
    
    }