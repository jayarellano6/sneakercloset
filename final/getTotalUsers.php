<?php
session_start();

include 'connect.php';
$connect = getDBConnection();

$sql = "select count(*) total from users where username != :username";
$stmt = $connect->prepare($sql);
$stmt->execute(array(':username' => $_SESSION['username']));
$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

// print_r($user);
echo json_encode($user);
    
?>