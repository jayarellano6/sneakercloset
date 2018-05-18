<?php
session_start();

include 'connect.php';
$connect = getDBConnection();

$sql = "select * from users where 
        username = :username and 
        password = :password";
$stmt = $connect->prepare($sql);
$data = array(":username" => $_POST['username'], ":password" => $_POST['password']);
$stmt->execute($data);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

//redirecting user to quiz if credentials are valid
if(isset($user['username'])){
    $_SESSION['username'] = $user['username'];
    $_SESSION['first'] = $user['first_name'];
    $_SESSION['last'] = $user['last_name'];
    $_SESSION['profile_pic'] = $user['profile_picture'];
    $_SESSION['userID'] = $user['id'];
    
    if($_SESSION['username'] == "admin"){
        header("Location: admin.php");
    }else{
        header("Location: index.php");
    }
    
}
else {
    echo "The values you entered were incorrect. <a href='signin.php'> retry </a>";
    
}
?>