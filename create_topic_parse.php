<?php
session_start();
if ($_SESSION['uid'] =="") {
	header("Location: forum.php");
	exit();
}
if (isset($_POST['topic_submit'])) {
	if (($_POST['topic_title'] == "") && ($_post['topic_content'] == "")){
	echo "Please fill in the fields.";	//validation 
	exit();
	}

	else{
	include_once("connect.php");
	$cid = $_POST['cid'];
	$title = $_POST['topic_title'];		//variables passed over from get
	$content = $_POST['topic_content'];
	$creator = $_SESSION['uid'];	//current session id 

	$stmt = $mysqli->prepare("INSERT INTO topics (category_id, topic_title, topic_creator,
	topic_date, topic_reply_date) VALUES (?,?,?, now(), now())");
	$stmt->bind_param('isi', $cid, $title, $creator);
	$stmt->execute(); 
	$stmt->close();

	
	$new_topic_id = mysqli_insert_id($mysqli);
	$stmt2 = $mysqli->prepare("INSERT into posts (category_id, topic_id, post_creator, post_content, post_date) VALUES (?, ?, 
	?, ?, now())");
	$stmt2->bind_param('iiis', $cid, $new_topic_id, $creator, $content);
	$stmt2->execute(); 
	$stmt2->close();


	$stmt3 = $mysqli->prepare("UPDATE categories SET last_post_date=NOW(), last_user_posted = ? WHERE id = ?");
	$stmt3->bind_param('ii', $creator, $cid);
	$stmt3->execute(); 
	$stmt3->close();

		header("Location: view_thread.php?cid={$cid}&tid={$new_topic_id}");
	}
}
?>