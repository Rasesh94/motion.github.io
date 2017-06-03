<?php
session_start();
if ($_SESSION['uid']) {
	if (isset($_POST['reply_submit'])) {
		include_once("connect.php"); //include hte database file
		$creator = $_SESSION['uid'];	//current session stores hte user id
		$cid = $_POST['cid'];		//category id
		$tid = $_POST['tid'];	//thread id
		$pid = $_POST['pid'];	//post id

		$reply_content = $_POST['edit_content'];

		$stmt = $mysqli->prepare("UPDATE posts SET post_content = ?, edit_time=now() WHERE id = ?");
		$stmt->bind_param('si', $reply_content, $pid);
		$stmt->execute(); 
		$stmt->close();
	
		
		if ($stmt) { //if all the queries are performed		
			//row options work for the select function, obviously...		
		header("Location: view_thread.php?cid={$cid}&tid={$tid}");

		//return user to the thread based on the thread id variable
		} 
		else {
			echo "There was a problem editing your post. Sorry about that.";
		}	
	
	} else{
		exit();
	}
} else {
	exit();
}
?>