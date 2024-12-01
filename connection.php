<?php
$server = "localhost";
$uname = "root";
$pwd = "";
$db = "cake_dbweb";

$conn = new mysqli($server,$uname,$pwd,$db);

if($conn->connect_error)
{
	die("connection failed:".$conn->connect_error);
}
?>