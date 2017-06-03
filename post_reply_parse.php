<?php
session_start();
if ($_SESSION['uid']) {
	if (isset($_POST['reply_submit'])) {
		include_once("connect.php"); //include hte database file
		$creator = $_SESSION['uid'];	//current session stores hte user id
		$cid = $_POST['cid'];		//
		$tid = $_POST['tid'];	//thread id
		$reply_content = $_POST['reply_content'];

 
$stmt = $mysqli->prepare("INSERT INTO posts(category_id, topic_id, post_creator, post_content, post_date)
 VALUES (?, ?, ?, ?, NOW())");
$stmt->bind_param('iiis', $cid, $tid, $creator, $reply_content);
$stmt->execute(); 
$stmt->close();

	$stmt2 = $mysqli->prepare("UPDATE categories SET last_post_date=NOW(), last_user_posted = ? WHERE id = ?");
	$stmt2->bind_param('ii', $creator, $cid);
	$stmt2->execute(); 
	$stmt2->close();

	$stmt3 = $mysqli->prepare("UPDATE topics SET topic_reply_date=NOW(), topic_last_user= ? WHERE id = ?");
	$stmt3->bind_param('ii', $creator, $tid);
	$stmt3->execute(); 
	$stmt3->close();

	$stmt4 = $mysqli->prepare("SELECT replies FROM topics WHERE category_id = ? AND id = ?");
	$stmt4->bind_param('ii', $cid, $tid);
	$stmt4->execute(); 
	$stmt4->bind_result($replies);
	$stmt4->store_result();
	$stmt4->fetch();
	$stmt4->close();
		

		//email sending code - selects post creator which is an integer, selects the id and email from uesr depending on which key is run through the script.
		$stmt5 = $mysqli->prepare("SELECT post_creator FROM posts WHERE category_id = ? AND topic_id = ?
			GROUP BY post_creator");

		$stmt5->bind_param('ii', $cid, $tid);
		$stmt5->execute();
		$stmt5->bind_result($op);
		$stmt5->store_result();
		while ($stmt5->fetch()){
			$userids[] .= $op;
		}
		foreach ($userids as $key){
			$stmt6 = $mysqli->prepare("SELECT id, email FROM users WHERE id = ? AND 
				forum_notification = 1");
			$stmt6->bind_param('i', $key);
			$stmt6->execute();
			$stmt6->bind_result($userid, $email);
			$stmt6->store_result();
//runs through each user id in the array and draws out the id and email from that user,
			//if the id field of the user does not equal the creator which is the session id, - 
			//basically it will select any user that is not the current user that is posting,
			//stores inside the email variable
			if ($stmt6->num_rows > 0)
			{
				$stmt6->fetch();
				if ($userid != $creator){
					$email .= $email.", ";
				}
			}
		}


		$email = substr($email, 0, (strlen($email)-2)); //appending a comma and space in the email, this removes the last 2 characters
		// from our email variable, cleans it up to send emails without a blank email address...

		//email script..
		$to = "jake@cdcdsc.com";
		$from = "admin@motion.com";
		$bcc = $email;
		$subject = "Forum Reply";

		$message = "Someone has replied to the thread you posted in.";
		$headers = "From: {$from}\r\nReply-To: {$from}";
		$headers .= "\r\nBcc: {$bcc}";
		$subject = "Forum Reply";
		mail($to, $subject, $message, $headers);


		$old_replies = $replies;
		$new_replies = $old_replies + 1;

		$stmt5 = $mysqli->prepare("UPDATE topics SET replies = ? WHERE category_id = ? AND id = ?");
		$stmt5->bind_param('iii', $new_replies, $cid, $tid);
		$stmt5->execute(); 
		$stmt5->close();
	
		header("Location: view_thread.php?cid={$cid}&tid={$tid}");
  		exit();		
		//return user to the thread based on the thread id variable
		} 
	
	} else{
		exit();
	}
?>