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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="dist/jquery.validate.js"></script> <!--jquery validation-->
<script>//VALIDATION
$(function(){   
$("#createthread").validate({
    rules: {
        title: {
        required: true,
        minlength: 5
      },
      content: {
          required: true,
          minlength: 5
        },
    },
    messages: {
      title: {
      required: "Please enter a thread title.",
      minlength: "Title must be atleast 5 characters long."
    },
    content: {
      required: "Please enter something in the content field.",
      minlength: "Content must be 5 characters long."
    }
    }

  });
});
</script> <!--jquery validation-->
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
if (!isset($_SESSION['uid'])) { //uid = identifier that user is logged in
//if user id is not set the user is not logged in ,
  header("Location: forum.php");
  exit();
} else{
  
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
  	$tid = $_GET['tid'];
    $cid = $_GET['cid'];
?>
<div id="about" class="text-center">
              <div class="section-title center">
      <h1><strong><span class="color">Post Reply</span></strong></h1>
      <div class="line">
                        <hr>
                    </div>
                </div>

<div id="content">
 <form action="post_reply_parse.php" method="post">
 <p>Reply Content</p>
 <textarea name="reply_content" rows="5" cols="75"></textarea>
 <br  /> <br />
 <input type="hidden" name="cid" value="<?php echo $cid;?>"/>
 <input type="hidden" name="tid" value="<?php echo $tid;?>"/>
 <input type="submit" name="reply_submit" value="Post reply" />
</div>
</div>
</body>
</html>


