<?php session_start(); 
ini_set("display_errors", 0);
?>
<!doctype html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="main.css"/>
<link rel="stylesheet" type="text/css" href="forumStyle.css"/>

<link rel="stylesheet" href="owl-carousel/owl.carousel.css">
 
<!-- Default Theme -->
<link rel="stylesheet" href="owl-carousel/owl.theme.css">
 
<!--  jQuery 1.7+  -->
 
<!-- Include js plugin -->
<script src="assets/owl-carousel/owl.carousel.js"></script>

    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">
    <!-- Bootstrap and the weird icons and shit -->
    <link rel="stylesheet" type="text/css" href="responsive.css">
    <script type="text/javascript" src="js/modernizr.custom.js"></script>

</head>
<body>
<nav id='menu' class='navbar navbar-default navbar-fixed-top'>
      <div class='container'>
        <div class='navbar-header'>
          <button type'button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand' href='forum.php'>Motion</a>
        </div>
<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
          <ul class='nav navbar-nav navbar-right'>
<?php
if (!isset($_SESSION['uid'])) {	//uid = identifier that user is logged in
//if user id is not set the user is not logged in ,
	echo "
		  	<form action='login_parse.php' method='post'>
	<input type='text' name='username' placeholder='username'/>
	<input type='password' name='password' placeholder='password'/>
	<input type='submit' class='btn btn-primary btn-xs' value='Log In'/>
          </ul>   
        </div>
      </div>
    </nav>
	";
} 
else{
	 if ($_SESSION['admin'] == "Y") {
  echo "
  <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
          <ul class='nav navbar-nav navbar-right'>
        <a href='admin_settings.php'>Admin Settings</a>
        <a href='user_settings.php' i class='fa fa-user'>User Settings</a>
      You are logged in as ".$_SESSION['username']." &bull; <a href='logout_parse.php'>Logout</a>

          </ul>   
        </div>
      </div>
    </nav>";}
    else{
      echo "<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
          <ul class='nav navbar-nav navbar-right'>
        <a href='user_settings.php' i class='fa fa-user'>User Settings</a>
      You are logged in as ".$_SESSION['username']." &bull; <a href='logout_parse.php'>Logout</a>

          </ul>   
        </div>
      </div>
    </nav>";}
 
  }
?>

<div id="about" class="center">
        <div class="overlay">
            
    
<?php 
include_once("connect.php");
$cid = $_GET['cid'];
$tid = $_GET['tid'];

$stmt = $mysqli->prepare("SELECT topic_title, topic_creator, topic_last_user,
	topic_date, topic_reply_date, topic_views, replies
	FROM topics WHERE category_id=? AND id= ?");
$stmt->bind_param('ii', $cid, $tid);
$stmt->execute();
$stmt->bind_result($title, $op, $topic_last_user, $date, $reply_date, $views, $replies);
$stmt->store_result();
$numrows = $stmt->num_rows;

	echo "<table width='100%'>";

	if ($_SESSION['uid']) 
	{ 
	echo "<a href=view_category.php?cid={$cid}>Back to Board Index</a>";
	echo "<tr><td colspan='2'><input type='submit' value='Add Reply' onClick
	=\"window.location = 
'post_reply.php?cid={$cid}&tid={$tid}'\" /><hr />";}
//}
else {
	echo "<tr><td colspan='2'><p>Please log in to reply.</p><hr /></td></tr>";
}
		while ($stmt->fetch()) {

			$stmt2 = $mysqli->prepare("SELECT p.id, p.post_creator, p.post_content, p.post_date, p.edit_time, u.username, u.comment
			FROM posts p JOIN users u ON p.post_creator = u.id
			WHERE category_id= ? AND topic_id=?");

			$stmt2->bind_param('ii', $cid, $tid);
			$stmt2->execute();
			$stmt2->bind_result($pid, $post_creator, $content, $post_date, $edit_time, $username, $signature);
			$stmt2->store_result();
				while($stmt2->fetch()){


		if ($_SESSION['username']== $username) //if the user logged into the session matches the user who created the post
		//give them the option to edit the post (applies to their individual post only, this option will not happen)
		//if the user is not logged in!
		{
			echo "<tr><td valign='top' class = 'cat_links'style='border:1px solid #000000;'><div style='min-height: 75px;'>{$title}<br />
				by {$username}-{$post_date}<br />Last Edit: {$edit_time}<input type='submit' value='Edit post' onClick
=\"window.location = 
'edit_reply.php?cid={$cid}&tid={$tid}&pid={$pid}'\" /><hr />{$content}</div></td><tr><td valign='top' class = 'cat_links'
				style='border: 1px solid #000000;'>{$signature}</td></tr><tr><td colspan='2'><hr /></td></tr>";
				
				$old_views = $views;
				$new_views = $old_views + 1;
			$stmt3 = $mysqli->prepare("UPDATE topics SET topic_views = ?  
 		  WHERE category_id = ? AND id = ?");
		$stmt3->bind_param('iii', $new_views, $cid, $tid);
		$stmt3->execute(); 
		$stmt3->close();

				}
				else {
				echo "<tr><td valign='top' class = 'cat_links'style='border:1px solid #000000;'><div style='min-height: 75px;'>{$title}<br />
				by {$username}-{$post_date}<br />Last Edit: {$edit_time}<hr />{$content}</div></td><tr><td valign='top' class = 'cat_links'
				style='border: 1px solid #000000;'>{$signature}</td></tr><tr><td colspan='2'><hr /></td></tr>";
				
				$old_views = $views;
				$new_views = $old_views + 1;
	
			$stmt3 = $mysqli->prepare("UPDATE topics SET topic_views = ?  
 	  WHERE category_id = ? AND id = ?");
	$stmt3->bind_param('iii', $new_views, $cid, $tid);
	$stmt3->execute(); 
	$stmt3->close();

			}
		}
	}
?>
</div>
</div>
</body>
</html>