
<?php
//I did not see this as a constraint as I could have easily removed this and 		made typing for useres only, however I wanted to clone my Motion website which only allowed access to members of Motion.
function redirect() {
    header('Location:forum.php');
}
?>
<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Forum Login</title>
<link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="loginPage.css"/>
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


<?php		//variable uid stored here
if (isset($_SESSION['uid'])) {	//uid = identifier that user is logged in
//if user id is not set the user is not logged in ,
redirect();
}
?>
<div class="container">
  <div class="row">
    <div class="Absolute-Center is-Responsive">
      <div id="logo-container"></div>
      <div class="col-sm-12 col-md-10 col-md-offset-1">
        <form action="" id="loginForm">
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='username' placeholder="username"/>          
          </div>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input class="form-control" type="password" name='password' placeholder="password"/>     
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox"> I agree to the <a href="#">Terms and Conditions</a>
            </label>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-def btn-block">Login</button>
          </div>
          <div class="form-group text-center">
            <a href="#">Forgot Password</a>&nbsp;|&nbsp;<a href="#">Support</a>
          </div>
        </form>        
      </div>  
    </div>    
  </div>
</div>