<?php
define('DB_SERVER','localhost');
define('DB_USER','u252291822_medcon');
define('DB_PASS' ,'Whitewalker#1');
define('DB_NAME', 'u252291822_medcon');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }

?>

