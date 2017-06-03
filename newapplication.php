<?php
session_start();
if (isset($_POST['send_application'])) {

	include_once("connect.php");
	$email = $_POST['email'];
	$name = $_POST['name'];
	$age = $_POST['age'];
	$class = $_POST['class'];
	$realm = $_POST['realm'];
	$ach = $_POST['achivements'];
	$about = $_POST['aboutyou'];
	$why = $_POST['why'];
	$creator = 1;
	$cid = 2;
	$title = "NEW APPLICATION: {$name}, {$realm}";
	$content = "Name: {$name} </br> Email: {$email} </br> Age: {$age} </br> class: {$class} </br> Realm: {$realm} </br>  
	Achivements: {$achivements} </br> About you: {$aboutyou} </br> Why do you want to join?: {$why}";
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

	echo "<a href=Motion.html>Your application has been submitted, you will hear from us shortly.</a>";
	}
?>