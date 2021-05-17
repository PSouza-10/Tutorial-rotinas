<?php 
      include 'connect.php';
      include 'controller.php';
     if ( !empty($_POST) && $_SERVER["REQUEST_METHOD"] === 'POST') {
         $conn = connect();

     
        $errors = '';
        $id = $_POST['id'];
        if ( empty($_POST['name']) ) {
           $errors .= 'Um ID é necessário para alterar um usuário';
        }
        $name = $_POST['name'];
        if ( empty($_POST['name']) ) {
           $errors .= 'O campo "Nome" é obrigatório';
        }
        $email = $_POST['email'];
        if ( empty($_POST['email']) ) {
           $errors .= 'O campo "Email" é obrigatório';
        }
      
      
        if ( empty($errors) ) {
            update($conn,$id,$name,$email);
            $users = getAll($conn);
            http_response_code( 201 );
            echo json_encode( [ 'msg' => 'Usuário cadastrado', 'data' => $users ]);
      
        } else {
      
           /*@ Return errors */
      
           http_response_code( 406 ); 
           echo json_encode( [ 'msg' => $errors ] );
        }
      
     }

    
?>