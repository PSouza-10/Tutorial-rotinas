<?php 
    include 'connect.php';
    include 'controller.php';

    $conn = connect();
    $users = getAll($conn);
    http_response_code( 200 );
    echo json_encode( [ 'data' => $users ]);
?>