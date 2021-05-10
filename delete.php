<?php 
     include 'connect.php';
     include 'controller.php';
    if ( !empty($_POST) && $_SERVER["REQUEST_METHOD"] === 'POST') {
        $conn = connect();

    
       $errors = '';
     
       $id = $_POST['id'];
       if ( empty($_POST['id']) ) {
          $errors .= 'Um Id é necessário para deletar o usuário';
       }
      
     
       if ( empty($errors) ) {
           deleteById($conn,$id);
           $users = getAll($conn);
           http_response_code( 201 );
           echo json_encode( [  'data' => $users ]);
     
       } else {
     
          /*@ Return errors */
     
          http_response_code( 400 ); 
          echo json_encode( [ 'msg' => $errors ] );
       }
     
    }
?>