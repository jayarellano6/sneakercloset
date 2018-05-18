<?php
session_start();

include 'connect.php';
$connect = getDBConnection();

$sql = "select sum(number_messages) total from users";
$stmt = $connect->prepare($sql);
$stmt->execute($data);
$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

// print_r($user);
echo json_encode($user);
    
?>