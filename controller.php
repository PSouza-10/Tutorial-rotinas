<?php 
    function getAll($conn){
        $statement = $conn->prepare("SELECT * from users");
        $statement->execute();
        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement->fetchAll();
    }

    function create($conn,$name,$email){
     
        $statement = $conn->prepare("INSERT INTO users(nome,email) values ('$name','$email')");
        $statement->execute();


    }
    function update($conn,$id,$name,$email){
       
        $statement = $conn->prepare("UPDATE users SET nome='$name', email='$email' WHERE id=$id");
        $statement->execute();


    }
    function deleteById($conn,$id){
        
        $statement = $conn->prepare("DELETE FROM users WHERE id = $id");
        $statement->execute();

    }
?>