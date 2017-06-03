<?php session_start(); 
ini_set("display_errors", 1);
include("connect.php");
?>

<?php
$stmt2 = $mysqli->prepare("SELECT admin FROM users WHERE id = ?");//select from the post in the db which id matches the pid
//that was passed through via the php script on the previous page
$stmt2->bind_param('i', $_SESSION['uid']);
$stmt2->execute();
$stmt2->bind_result($admin);
$stmt2->store_result();  //grab the old post content for user to edit
$stmt2->fetch(); 

if ($admin == "N") {		//unauthorised access if not logged in
	header("Location: forum.php");
	exit();
}

else {		//unauthorised access if not logged in
	$_SESSION['admin'] = $admin;
	header("Location: admin_settings.php");
	exit();
}
else ()
?>


} 
