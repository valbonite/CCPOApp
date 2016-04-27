<?php
error_reporting(E_ALL);
require('connection.php');

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

//$connection=@mysql_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
//if (!$connection) {  die('Not connected : ' . mysql_error());}

// Set the active MySQL database

//$db_selected = mysql_select_db($cleardb_db, $connection);
//if (!$db_selected) {
//  die ('Can\'t use db : ' . mysql_error());
//}

mysqli_select_db($cleardb_db, $connection);

// Select all the rows in the markers table

//$query = "SELECT * FROM master_data WHERE 1";
//$result = mysql_query($query);
$result = $connection->query("SELECT * FROM master_data WHERE 1");

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml; charset=UTF-8");


// Iterate through the rows, adding XML nodes for each

while ($row=$result->fetch_object()){
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
echo $result;

echo $dom->saveXML();

?>