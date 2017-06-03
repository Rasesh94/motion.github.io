<!-- make sure we have access to our data base so we can draw out user info -->
<?php
ini_set("display_errors", 1);
session_start();
if ($_SESSION['uid']) {
if (isset($_POST['create_user'])) {
    include_once("connect.php"); 
	$user = $_POST['username'];		
	$pass = $_POST['password'];
    $email = $_POST['email'];

    $stmt = $mysqli->prepare("SELECT username FROM users WHERE username= ?");
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $stmt->store_result();

  if ($stmt->num_rows > 0) {
    echo ("Username has already been taken!");
    } 
else{
    $stmt2 = $mysqli->prepare("INSERT INTO users(username, password, email) VALUES (?, ?, ?)");
    $stmt2->bind_param('sss', $user, $pass, $email); 
    $stmt2->execute();
    $stmt2->close();
    
        $from = "admin@motion.com";
        $bcc = $email;
        $subject = "Motion - Account Created";

        $message = "An account has been created for you on the Motion forums.";
        $headers = "From: {$from}\r\nReply-To: {$from}";
        $headers = "\r\nBcc: {$bcc}";
        mail($email, $subject, $message, $headers);

    echo "<a href ='admin_settings.php'>Account successfully created. Email verification has been sent. Click here to return.</a>";
} 
}
}
?>