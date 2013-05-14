<?php
$con = mysql_connect('localhost','aponcolc_main','al=r0205');
if (!$con){
  die('Could not connect to database: ' . mysql_error());
}

$dbs = mysql_select_db('aponcolc_users', $con);
$phpemail = $_GET["email"];

$phpemail = mysql_real_escape_string($phpemail);

$result = mysql_query("SELECT id,email FROM user_social_link WHERE email = '$phpemail'");
$array = mysql_fetch_array($result);

if($array['id']==0) {
		echo("error");
} else { echo($array['id']); }
mysql_close($con);
?>