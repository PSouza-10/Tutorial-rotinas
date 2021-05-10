<?php
    function connect(){

        $host = "localhost"; 
        $db = "tutorial";
        $user = "root";
        $password = "";
        try{
            
            $conn = new PDO("mysql:host=$host;dbname=$db",$user,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conn;
        }catch(PDOException $e){
            echo "Erro na conexão com a base de dados";    
        }
    }
?>