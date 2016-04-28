<?php
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$cleardb_server = 'us-cdbr-iron-east-03.cleardb.net';
$cleardb_username = 'b63bd21b2fbdc5';
$cleardb_password = '5f51cc51';
$cleardb_db = 'heroku_edbd0db618b7e76';

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = $cleardb_server;
$db['default']['username'] = $cleardb_username;
$db['default']['password'] = $cleardb_password;
$db['default']['database'] = $cleardb_db;
?>