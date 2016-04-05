<?php
$server = "localhost";
$username = "root";
$password = "password";
$db = "ccpo_database";

$connection = mysqli_connect($server, $username, $password, $db);

if(!$connection) {
	die("Connection failed: " . mysqli_connect_error() );
}

//echo "Connected successfully!";
?>