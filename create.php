<?php 
      include 'connect.php';
      include 'controller.php';
     if ( !empty($_POST) && $_SERVER["REQUEST_METHOD"] === 'POST') {
         $conn = connect();

     
        $errors = '';
      
        $name = $_POST['name'];
        if ( empty($_POST['name']) ) {
           $errors .= 'O campo "Nome" é obrigatório';
        }
        $email = $_POST['email'];
        if ( empty($_POST['email']) ) {
           $errors .= 'O campo "Nome" é obrigatório';
        }
      
      
        if ( empty($errors) ) {
            create($conn,$name,$email);
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