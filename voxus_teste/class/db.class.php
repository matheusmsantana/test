<?php
//Classe de conexão com MySQL
class db{
    //Atributos de conexão locais
    /*private $host = 'localhost';

    private $usuario = 'root';

    private $senha = '63970719';    

    private $database = 'voxus_teste';*/

    //Atributos de conexão na nuvem

    private $host = 'c628faf1-7912-4c1f-91f5-a86100dd8739.mysql.sequelizer.com';
    
    private $usuario = 'ollwbaznvwdnlhtp';
    
    private $senha = 'PrU7asHW2WQoC4aaBj7zjFZxZefCykTFT35zeh6qZNbosQc62gcrutziywf4mexP';    
    
    private $database = 'dbc628faf179124c1f91f5a86100dd8739';


    //Método de conexão com mysql
    public function conecta_mysql(){

        //mysqli_connect(): espera 4 parametros: host, usuario, senha e nome do banco
        $con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

        //configurando edioma de comunicação do php com mysql
        mysqli_set_charset($con, 'utf8');

        //Teste de conexão com mysql
        if(mysqli_connect_errno()){
            //mysqli_connect_error(): retorna a mensagem de erro
            echo 'Erro com banco de dados ' . mysqli_connect_error();
        }

        return $con;        
    }
}    