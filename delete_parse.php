<!-- make sure we have access to our data base so we can draw out user info -->
<?php
ini_set("display_errors", 1);
session_start();
if ($_SESSION['uid']) {
if (isset($_POST['delete_user'])) {
    include_once("connect.php"); 
	$user = $_POST['username'];		
    $stmt2 = $mysqli->prepare("SELECT admin FROM users WHERE username= ?");
    $stmt2->bind_param('s', $user);
    $stmt2->execute();
    $stmt2->bind_result($admin);
    $stmt2->store_result();  //grab the old post content for user to edit
    $stmt2->fetch(); 

if ($admin == "Y") {        //unauthorised access if not logged in
    echo "<a href ='admin_settings.php'>Admin account cannot be deleted. Please contact database admin.</a>";
    exit();
}
else {

    $stmt = $mysqli->prepare("DELETE FROM users WHERE username = ?");
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $stmt->close();

    echo "<a href ='admin_settings.php'>Account successfully deleted. Click here to return.</a>";
} 
}
}
?>