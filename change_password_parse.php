<?php session_start(); 
ini_set("display_errors", 1);

if ($_SESSION['uid']) {
	if (isset($_POST['change_password'])) {
		include_once("connect.php"); //include the database file
		//$creator = $_SESSION['uid'];	//current session stores hte user id
		$oldpassword = $_POST['oldpassword'];	//old password
		$newpassword = $_POST['newpassword'];	//new password

		$stmt = $mysqli->prepare("SELECT * FROM users WHERE password = ? AND id = ?");
		$stmt->bind_param('si', $oldpassword, $_SESSION['uid']);
		$stmt->execute(); 
		$stmt->store_result();
		$numrows = $stmt->num_rows;

		if ($numrows == 1){

		$stmt2 = $mysqli->prepare("UPDATE users SET password = ? WHERE id = ?");
		$stmt2->bind_param('si', $newpassword, $_SESSION['uid']);
		$stmt2->execute(); 
		$stmt2->close();

			echo "<a href=user_settings.php>Your password has been changed. Click here to return to settings.</a>";

			}
			else{
			echo "<a href=user_settings.php>Incorrect old password! Click here to return to settings.</a>";
			}
		
	} else{
		exit();
	}
} else {
	exit();
}
?>