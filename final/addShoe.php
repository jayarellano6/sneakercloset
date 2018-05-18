<?php

    include 'connect.php';
    $conn = getDBConnection();
    
    $name = $_GET['shoe_name'];
    $manufac = $_GET['shoe_manufacturer'];
    $type = $_GET['shoe_type'];
    $owner = $_GET['shoe_owner'];
    $img = $_GET['shoe_img'];
    
    $sql = "update users set number_shoes = number_shoes + 1 where id = :id";
    $data = array(":id" => $owner);
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
    /////////
    $sql = "INSERT INTO shoes2 (id, name, manufacturer, shoe_type, shoe_owner, img) VALUES (NULL, '$name', '$manufac', '$type', '$owner', '$img');";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($record);

?>