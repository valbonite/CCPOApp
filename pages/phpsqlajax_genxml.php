<?php
require("connection.php");

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection=@mysql_connect ($cleardb_server, $cleardb_username, $cleardb_password);
if (!$connection) {  
  die('Not connected : ' . mysql_error());
} else {
  echo "Successful!";
}

// Set the active MySQL database

$db_selected = mysql_select_db($cleardb_db, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table

$query = "SELECT * FROM master_data WHERE 1";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml; charset=UTF-8");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("day",$row['day']);
  $newnode->setAttribute("barangay",$row['barangay']);
  $newnode->setAttribute("classification",$row['classification']);
  $newnode->setAttribute("areaofincident", $row['areaofincident']);
  $newnode->setAttribute("latitude", $row['latitude']);
  $newnode->setAttribute("longitude", $row['longitude']);
  $newnode->setAttribute("crimetype", $row['crimetype']);
}

echo $dom->saveXML();

?>