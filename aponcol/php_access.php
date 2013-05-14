<?php
$con = mysql_connect('localhost','aponcolc_main','al=r0205');
if (!$con){
  die('Could not connect to database: ' . mysql_error());
}

$dbs = mysql_select_db('aponcolc_users', $con);
$phpemail = $_POST["email"];
$phppassword = $_POST["password"];

$phpemail = mysql_real_escape_string($phpemail);
$phppassword = mysql_real_escape_string($phppassword);

$result = mysql_query("SELECT password,name,phrase,email FROM user_social_link WHERE email = '$phpemail'");
$array = mysql_fetch_array($result);

$dbpass = $array['password'];
$dbname = $array['name'];
$dbphrase = $array['phrase'];
$dbemail = $array['email'];

if($dbpass!=$phppassword) {
	echo('Password combination doesn\'t match!');
} else { echo('success');}
mysql_close($con);
?>