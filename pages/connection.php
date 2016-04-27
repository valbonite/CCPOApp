<?php
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$cleardb_server = $cleardb_url["hostname"];
$cleardb_username = $cleardb_url["username"];
$cleardb_password = $cleardb_url["password"];
$cleardb_db = substr($cleardb_url["path"], 1);

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = $cleardb_server;
$db['default']['username'] = $cleardb_username;
$db['default']['password'] = $cleardb_password;
$db['default']['database'] = $cleardb_db;

$connection = new mysqli($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

var_dump($cleardb_url);

if(!$connection) {
	echo "Error!";
	//die("Connection failed: " . mysqli_connect_error() );
}
//echo "Connected successfully!";
?>