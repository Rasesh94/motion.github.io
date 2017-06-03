<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<div id="wrapper">
<h2> Rasesh Forum </h2>
<p> Creating the basic login functionaility </p>

<?php
if (!isset($_SESSION['uid'])) {
	echo "<form action='login_parse.php' method='post'>
	Username: <input type='text' name='username' />&nbsp;
	Password: <input type='password' name='password' />&nbsp;
	<input type='submit' name='submit' value='Log In'/>
	";
} else{
	echo"<p> You are logged in as ".$_SESSION['username']. "$bull; <a href='logout_parse.php'>Logout</a>";
	
}
?>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>