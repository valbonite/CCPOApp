<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
require("phpsqlajax_dbinfo.php");

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);


// Opens a connection to a MySQL server

$connection=mysqli_connect ('us-cdbr-iron-east-03.cleardb.net', 'b63bd21b2fbdc5', '5f51cc51', 'heroku_edbd0db618b7e76');
if (!$connection) {  die('Not connected : ' . mysql_error());}

// Select all the rows in the markers table
header('Content-type: text/xml; charset=UTF-8');

$query = "SELECT * FROM master_data WHERE 1";
$result = mysqli_query($connection, $query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($connection));
}

//header("Content-type: text/xml; charset=UTF-8");

// Iterate through the rows, adding XML nodes for each
ini_set('memory_limit', '-1');
while ($row = mysqli_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("date",$row['date']);
  $newnode->setAttribute("day",$row['day']);
  $newnode->setAttribute("time",$row['time']);
  $newnode->setAttribute("areaofincident",$row['areaofincident']);
  $newnode->setAttribute("barangay", utf8_encode($row['barangay']));
  $newnode->setAttribute("latitude",$row['latitude']);
  $newnode->setAttribute("longitude",$row['longitude']);
  $newnode->setAttribute("crimetype",$row['crimetype']);
  $newnode->setAttribute("crimecategory",$row['crimecategory']);
  $newnode->setAttribute("classification",$row['classification']);
}

echo $dom->saveXML();

?>