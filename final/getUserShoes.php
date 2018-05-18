<?php
session_start();

include 'connect.php';
$connect = getDBConnection();

$sql = "select * from shoes2 where shoe_owner = 2";
$stmt = $connect->prepare($sql);
$stmt->execute($data);
$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

print_r($user);
    
?>