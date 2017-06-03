<<?php session_start(); 
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
$tid = $_GET['tid'];
$sid = $_SESSION['uid'];



$stmt = $mysqli->prepare("SELECT p.post_creator, p.post_date, p.edit_time, p.post_content, t.topic_title, 
	t.topic_creator, u.username FROM posts p INNER JOIN topics t ON p.topic_id = t.id 
	INNER JOIN users u ON u.id = t.topic_creator WHERE p.post_creator = ?");
$stmt->bind_param('i', $sid);
$stmt->execute();
$stmt->bind_result($post_creator, $date, $editdate, $content, $title, $op, $opUsername);
$stmt->store_result();
while ($stmt->fetch()){

//if (mysql_num_rows($res) == 1) {	//refers to category id
	echo "<table width='100%'>";
				echo "<tr><td valign='top' style='border:1px solid #000000;'><div style='min-height: 125px;'>{$title}<br />
				Thread Created by {$opUsername}-{$date}<br />Last Edit:{$editdate}<hr />{$content}</div></td><td width='200' valign='top'
				align='center' style='border: 1px solid #000000;'></td></tr><tr><td colspan='2'><hr /></td></tr>";
			
//else{
//	echo "<p>No posts found.</p>";
}

?>
</div>
</div>
</body>
</html>


