<?php
$con = mysql_connect('fdb3.awardspace.com','853400_database','testinggab');
if (!$con){
  die('Could not connect to database: ' . mysql_error());
}

$dbs = mysql_select_db('853400_database', $con);
$phpemail = $_GET["email"];
$phppassword = $_GET["password"];

$phpemail = mysql_real_escape_string($phpemail);
$phppassword = mysql_real_escape_string($phppassword);

$result = mysql_query("SELECT password FROM register WHERE email = '$phpemail'");
$array = mysql_fetch_array($result);

$dbpass = $array['password'];
if($dbpass==$phppassword)
	echo "Valid!";
else
    echo "Not!";

mysql_close($con);

?>
<?php

/*
      ' //Connect to MySQL Server
mysql_connect($dbhost, $dbuser, $dbpass);
	//Select Database
mysql_select_db($dbname) or die(mysql_error());
	// Retrieve data from Query String
$age = $_GET['age'];
$sex = $_GET['sex'];
$wpm = $_GET['wpm'];
	// Escape User Input to help prevent SQL Injection
$age = mysql_real_escape_string($age);
$sex = mysql_real_escape_string($sex);
$wpm = mysql_real_escape_string($wpm);
	//build query
$query = "SELECT * FROM ajax_example WHERE ae_sex = '$sex'";
if(is_numeric($age))
	$query .= " AND ae_age <= $age";
if(is_numeric($wpm))
	$query .= " AND ae_wpm <= $wpm";
	//Execute query
$qry_result = mysql_query($query) or die(mysql_error());

	//Build Result String
$display_string = "<table>";
$display_string .= "<tr>";
$display_string .= "<th>Name</th>";
$display_string .= "<th>Age</th>";
$display_string .= "<th>Sex</th>";
$display_string .= "<th>WPM</th>";
$display_string .= "</tr>";

	// Insert a new row in the table for each person returned
while($row = mysql_fetch_array($qry_result)){
	$display_string .= "<tr>";
	$display_string .= "<td>$row[ae_name]</td>";
	$display_string .= "<td>$row[ae_age]</td>";
	$display_string .= "<td>$row[ae_sex]</td>";
	$display_string .= "<td>$row[ae_wpm]</td>";
	$display_string .= "</tr>";
	
}
echo "Query: " . $query . "<br />";
$display_string .= "</table>";
echo $display_string;
*/
?>
