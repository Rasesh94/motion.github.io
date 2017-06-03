<?php session_start(); 
ini_set("display_errors", 0);
include("connect.php");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="main.css"/>
<link rel="stylesheet" type="text/css" href="forumStyle.css"/>

<link rel="stylesheet" href="owl-carousel/owl.carousel.css">
 
<!-- Default Theme -->
<link rel="stylesheet" href="owl-carousel/owl.theme.css">
 
<!--  jQuery 2.20  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

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


if (isset($_SESSION['uid'])) {
	$logged = " | <a href='create_topic.php?cid={$cid}'>Click here to create a thread</a>";
}else{
	$logged = " | Please log in to create topics in this forum.";
}

$stmt = $mysqli->prepare("SELECT id FROM categories WHERE id = ?");// no need for LIMIT
$stmt->bind_param('i', $cid);
$stmt->execute();
$stmt->store_result();
$numrows = $stmt->num_rows;

if ($numrows == 1)
{
	$stmt->fetch();
	$stmt->close();
	$stmt2 = $mysqli->prepare("SELECT t.topic_title, t.topic_views, t.replies, t.topic_date, 
		 t.topic_creator, t.id, t.topic_reply_date, u.username
		FROM topics t
		JOIN users u ON t.topic_creator = u.id
		WHERE category_id = ? ORDER BY topic_reply_date DESC");

$stmt2->bind_param('i', $cid);
$stmt2->execute();
$stmt2->bind_result($title, $views, $replies, $date, $creator, $tid, $topic_reply_date, $username);
$stmt2->store_result();


if ($stmt2->num_rows > 0) {

	$topics .= "<table width='50%' class='center' style='border-collapse: collapse;'>";
	$topics .= "<tr><td colspan='3'><a href='forum.php'>Return To Forum Index</a>{$logged}<hr /></td</tr>";
	$topics .= "<tr style='background-color: #dddddd; class='cat_header'><td>Topic Title</td><td width='65' align='center'>Replies</td><td width='65' align='center'>Views</td></tr>";
	$topic .= "<tr><td colspan='3'><hr /></td></tr>";

	while ($stmt2->fetch()) {

		$topics .= "<tr><td><a href='view_thread.php?cid={$cid}&tid={$tid}'class='cat_links'>{$title}</a><br /><span class='post_info'>Posted By:{$username} on {$date}</span></td><td align
		='center'><h2>{$replies}</h2></td><td align='center'><h2>{$views}</h2></td></tr>";
		$topics .= "<tr><td colspan='3'><hr /></td></tr>";
	
}
		$topics .= "</table>";
		echo "{$topics}";
	}
	else{
		echo "<a href='forum.php'>Return to Forum</a><hr />";
		echo "<p>There are no topics in this category yet.".$logged."</p>";	
	}

}else{
	echo "<a href='forum.php'>Return to Forum</a><hr />";
echo "<p> You are trying to view a category that does not exist yet.";
}
?>
</div>


 </div>
                </div>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.1.11.1.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<!-- REFERENCE ALL THESE BITCHES AT THE BOTTOM, SMOOTH SCROLL ETC AND THE OTHER LANDS-->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/SmoothScroll.js"></script>
    <script type="text/javascript" src="js/jquery.isotope.js"></script>
    <script src="app.js"></script>
    <!-- Javascripts
    ================================================== -->
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>


