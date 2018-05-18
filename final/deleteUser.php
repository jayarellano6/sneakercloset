<?php
session_start();

include 'connect.php';
$connect = getDBConnection();
$id = $_GET['id'];
$sql = "DELETE FROM users WHERE users.id = :id";
$stmt = $connect->prepare($sql);
$stmt->execute(array(":id" => $id));

$sql = "select * from users";
$stmt = $connect->prepare($sql);
$stmt->execute($data);

$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($user);
    
?>