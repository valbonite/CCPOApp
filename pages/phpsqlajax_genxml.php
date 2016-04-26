<?php
require("phpsqlajax_dbinfo.php");

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection=@mysql_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
if (!$connection) { 
  echo "Error 1"; 
}

// Set the active MySQL database

$db_selected = mysql_select_db($cleardb_db, $connection);
if (!$db_selected) {
  echo "Error 2"; 
}

// Select all the rows in the markers table

$query = "SELECT * FROM master_data WHERE 1";
$result = mysql_query($query);
if (!$result) {
  echo "Error 3"; 
}

header("Content-type: text/xml; charset=UTF-8");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
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