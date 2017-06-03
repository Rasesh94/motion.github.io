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
$("#changepassword").validate({
    rules: {
        oldpassword: {
        required: true,
        minlength: 5
      },
      newpassword: {
        required: true,
        minlength: 5
      },
      confirm_password: {
        required: true,
        minlength: 5,
        equalTo:"#newpassword"
      },

    },
    messages: {
      oldpassword: {
      required: "Please enter your old password.",
      minlength: "Your old password must consist of atleast 5 characters."
    },
    newpassword: {
      required: "Please enter your new password.",
      minlength: "Your new password must be atleast 5 characters long"
    },
    confirm_password: {
      required: "Please provide a password",
      minlength: "Your new password must be atleast 5 characters long",
      equalTo: "New passwords do not match!"
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
<?php
include_once("connect.php");

$stmt = $mysqli->prepare("SELECT comment FROM users WHERE id = ?");
$stmt->bind_param('i', $_SESSION['uid']);
$stmt->execute();
$stmt->bind_result($signature);
$stmt->store_result();
$stmt->fetch();
?>
<div id="about" class="center">
          <div class="col-md-6">
                                <div class="form-group">
                           <form id="changepassword" action="change_password_parse.php" method="post">
 <label for="oldpassword">Current Password:</label>
  <input type="text" id="oldpassword" name="oldpassword"></text>
  </br> </br>
 <label for="newpassword">New Password:</label>
 <input type="text" name ="newpassword" id="newpassword"></textarea>
   </br> </br>
 <label for="confirm_password">Confirm Password</label>
 <input type="text" name="confirm_password" id="confirm_password"></textarea>
   </br> </br>
<input type="submit" name="change_password" value="Change Password" />
</form>
</div>
 </div>
                  

<div id="content">
 <form action="signature_parse.php" method="post">
 <p>Your signature:</p>
 <textarea name="signature_content" rows="5" cols="75"><?php echo "{$signature}"?></textarea>
 <br  /> <br />
 <input type="submit" name="sig_submit" value="Save changes" />
 </form>
                

 


<p><a href="view_posts.php">View all your forum posts</a></p>
</div>
</body>
</html>



