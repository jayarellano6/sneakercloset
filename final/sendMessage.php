<?php

    include 'connect.php';
    $conn = getDBConnection();
    
    $tos = $_GET['to_'];
    $froms = $_GET['from_'];
    $messages = $_GET['message_'];
    
    $sql = "update users set number_messages = number_messages + 1 where username = :id";
    $data = array(":id" => $froms);
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
    /////////
    $sql = "INSERT INTO messages (id, _to_, _from_, message) VALUES (NULL, '$tos', '$froms', '$messages');";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($record);

?>