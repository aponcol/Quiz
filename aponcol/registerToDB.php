<?php
$con = mysql_connect('localhost','aponcolc_main','al=r0205');
if (!$con){
  die('Could not connect to database: ' . mysql_error());
}

$dbs = mysql_select_db('aponcolc_users', $con);
$name = $_POST['username'];
$favteam = $_POST['favteam'];
$user_token = $_POST['user_token'];
$email = $_POST['email'];
$password = $_POST['password'];

$name = mysql_real_escape_string($name);
$favteam = mysql_real_escape_string($favteam);
$user_token = mysql_real_escape_string($user_token);
$email = mysql_real_escape_string($email);
$password = mysql_real_escape_string($password);

//echo($name."-----".$favteam."---------".$user_token);

if($user_token=="") {
	$addToDB = mysql_query("INSERT INTO `user_social_link`(`name`,`favFootballTeam`,`email`,`password`) VALUES ('$name','$favteam','$email','$password')");
} else {
	$result = mysql_query("SELECT name,email,user_token FROM user_social_link WHERE user_token LIKE '$user_token'");
	$array = mysql_fetch_array($result);
	$rows = mysql_num_rows($result);
	
	if ($rows == 0) {
		$addToDB = mysql_query("INSERT INTO `user_social_link`(`name`,`favFootballTeam`,`user_token`,`email`,`password`) VALUES ('$name','$favteam','$user_token','$email','$password')");
	} else {
		$updateOnDB = mysql_query("UPDATE `user_social_link` SET `name`='$name',`favFootballTeam`='$favteam',`email`='$email',`password`='$password' WHERE `user_token`='$user_token'");
	}	
}	
mysql_close($con);
?>