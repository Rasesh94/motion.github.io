<?php
session_start();
if ($_SESSION['uid']) {
	if (isset($_POST['sig_submit'])) {
		include_once("connect.php"); //include hte database file
		$creator = $_SESSION['uid'];	//current session stores hte user id
	
		$signature = $_POST['signature_content'];	//get sig data

		$stmt = $mysqli->prepare("UPDATE users SET comment = ? WHERE id = ?");
		$stmt->bind_param('si', $signature, $creator);
		$stmt->execute();
		$stmt->close();

		if ($stmt) { //if all the queries are performed		
			//row options work for the select function, obviously...		
		echo "<p> Your signature has been saved. <a href='user_settings.php'>Click here to return.</a></p>";	
		//return user to the user settings area 
		} 
		else {
			echo "There was a problem was a problem saving your signature, sorry.";
		}	
	
	} else{
		exit();
	}
} else {
	exit();
}
?>