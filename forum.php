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
<div id="home" class="text-center">
        <div class="overlay">
              <div class="section-title center">
      <h1><strong><span class="color">Motion Forums</span></strong></h1>
      <div class="line">
                        <hr>
                    </div>
                </div>
<?php
$stmt = "SELECT * FROM categories ORDER BY category_title ASC";
$res = $mysqli->query($stmt);
	while($row = $res->fetch_assoc()) 
	{
		$id = $row['id'];
		$title = $row['category_title'];
		$description = $row['category_description'];
		$categories = "<a href='view_category.php?cid={$id}'class='cat_links'>{$title} - <font size='-1'>{$description}</font></a>";
		    echo "{$categories}";

    }
?>
   </div>
    </div> 
</div>
</div>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.1.11.1.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/SmoothScroll.js"></script>
    <script type="text/javascript" src="js/jquery.isotope.js"></script>
    <script src="app.js"></script>
    <!-- Javascripts
    ================================================== -->
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>


