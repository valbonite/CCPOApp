<?php
//ini_set('display_startup_errors',1);
//ini_set('display_errors',1);
//error_reporting(-1);
require("phpsqlajax_dbinfo.php");

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);


// Opens a connection to a MySQL server

$connection=mysqli_connect ('us-cdbr-iron-east-03.cleardb.net', 'b63bd21b2fbdc5', '5f51cc51', 'heroku_edbd0db618b7e76');
if (!$connection) {  die('Not connected : ' . mysql_error());}

var_dump($connection);
// Select all the rows in the markers table

$query = "SELECT * FROM master_data WHERE 1";
$result = mysqli_query($connection, $query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($connection));
}

header("Content-type: text/xml; charset=UTF-8");

// Iterate through the rows, adding XML nodes for each
ini_set('memory_limit', '-1');
while ($row = mysqli_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("date", utf8_encode($row['date']));
  $newnode->setAttribute("day", utf8_encode($row['day']));
  $newnode->setAttribute("time", utf8_encode($row['time']);
  $newnode->setAttribute("areaofincident", utf8_encode($row['areaofincident']));
  $newnode->setAttribute("barangay", utf8_encode($row['barangay']));
  $newnode->setAttribute("latitude", utf8_encode($row['latitude']));
  $newnode->setAttribute("longitude", utf8_encode($row['longitude']));
  $newnode->setAttribute("crimetype", utf8_encode($row['crimetype']));
  $newnode->setAttribute("crimecategory", utf8_encode($row['crimecategory']));
  $newnode->setAttribute("classification", utf8_encode($row['classification']));
}

echo $dom->saveXML();

?>