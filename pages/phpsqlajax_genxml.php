<?php
error_reporting(E_ALL);
require('connection.php');

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection= new mysqli($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


mysql_select_db($cleardb_db);

// Select all the rows in the markers table

//$query = "SELECT * FROM master_data WHERE 1";
$result = $connection->query("SELECT * FROM master_data WHERE 1");


header("Content-type: text/xml; charset=UTF-8");


// Iterate through the rows, adding XML nodes for each

while ($row = $result->fetch_assoc()){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("date",$row['date']);
  $newnode->setAttribute("day",$row['day']);
  $newnode->setAttribute("time",$row['time']);
  $newnode->setAttribute("areaofincident",$row['areaofincident']);
  $newnode->setAttribute("barangay",$row['barangay']);
  $newnode->setAttribute("latitude",$row['latitude']);
  $newnode->setAttribute("longitude",$row['longitude']);
  $newnode->setAttribute("crimetype",$row['crimetype']);
  $newnode->setAttribute("crimecategory",$row['crimecategory']);
  $newnode->setAttribute("classification",$row['classification']);
}

echo $dom->saveXML();

?>