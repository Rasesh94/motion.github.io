<?php session_start(); 
ini_set("display_errors", 0);
include("connect.php");
?>

<?php
if ((!isset($_SESSION['uid'])) || ($_SESSION['admin'] == "N")) {  //unauthorised access if not logged in
  header("Location: forum.php");
  exit();
} 
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
<script src="dist/jquery.validate.js"></script> <!--jquery validation-->

<!-- Include js plugin -->
<script src="assets/owl-carousel/owl.carousel.js"></script>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">
    <!-- Bootstrap and the weird icons and shit -->
    <link rel="stylesheet" type="text/css" href="responsive.css">
    <script type="text/javascript" src="js/modernizr.custom.js"></script>
    <script>
$(function(){
$("#adduser").validate({
    rules: {
        username: {
        required: true,
        minlength: 5
      },
      password: {
        required: true,
        minlength: 5
      },
      confirm_password: {
        required: true,
        minlength: 5,
        equalTo:"#password"
      },
      email: {
        required: true,
        email: true
      }

    },
    messages: {
      username: {
      required: "Please enter a username.",
      minlength: "Your username must consist of atleast 5 characters."
    },
    password: {
      required: "Please provide a password",
      minlength: "Your password must be atleast 5 characters long"
    },
    confirm_password: {
      required: "Please provide a password",
      minlength: "Your password must be atleast 5 characters long",
      equalTo: "Passwords do not match!"
    }
    }

  });
});
</script> <!--jquery validation-->

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

<div id="about" class="text-center">
        <div class="overlay">
            <div class="content">
              <div class="section-title center">
      <h1><strong><span class="color">Add New User</span></strong></h1>
      <div class="line">
                        <hr>
                    </div>
                </div>

 <form id="adduser" action="create_new_user_parse.php" method="post">
 <label for="username">Username</label>
<input type="text" class='form_control' id="username" name="username"></text>
 <br  /> <br />
 <label for="password">Password</label>
 <input type="text" name ="password" id="password"></textarea>
 <br  /> <br />
 <label for="confirm_password">Confirm Password</label>
 <input type="text" name="confirm_password" id="confirm_password"></textarea>
 <br  /> <br />
 <label for="email">Email</label>
 <input type="text" name="email" id="email"></textarea>
 <br  /> <br />

<input type="submit" type="submit" name="create_user" value="Create Account"/>
</form>
</div>


<p><a href="delete_user.php">Delete user from system</a></p>
<p><a href="change_user_password.php">Change user password.</a></p>



</body>
</html>



