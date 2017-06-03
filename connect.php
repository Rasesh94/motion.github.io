
<!-- MYSQL DATA CONNECTION FILE -->

<?php
$host == "homepages.shu.ac.uk/mysql";
$username = "b3042260";
$password = "rasesh94";
$db = "b3042260_db2";
 
$mysqli = new mysqli($host, $username, $password, $db);

if(!$mysqli){
echo "Could not connect to server"; 
};


mysqli_select_db($mysqli, 'b3042260_db2');
if(!mysqli_select_db($mysqli, 'b3042260_db2')){
echo "Could not connect to database"; 
};
?>
