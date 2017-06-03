<!-- make sure we have access to our data base so we can draw out user info -->
<?php

session_start();
include_once("connect.php"); 

if (isset($_POST['username'])) {
	$username = $_POST['username'];		
	$password = $_POST['password'];
    $stmt = $mysqli->prepare("SELECT id, username, admin FROM users WHERE username=? AND password=?");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $stmt->bind_result($id, $user, $admin);
    $stmt->store_result();

  if ($stmt->num_rows > 0) {
    while ($stmt->fetch()){
    $_SESSION['uid'] = $id;
    $_SESSION['username'] = $user;
    $_SESSION['admin'] = $admin;

    header("Location: forum.php");
    exit();
}
 } 
 else{
    echo "Invalid login information. Please return to previous page."; 
    exit();
}
}

?>