<?php
require("phpsqlajax_dbinfo.php");
echo "Error 1";
// Start XML file, create parent node
/*
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
echo "Error 2";*/
// Opens a connection to a MySQL server

$connection=@mysql_connect ($cleardb_server, $cleardb_username, $cleardb_password);
if (!$connection) { 
  echo "Error 3"; 
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database

$db_selected = mysql_select_db($cleardb_db, $connection);
if (!$db_selected) {
  echo "Error 4";
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table

$query = "SELECT encoder FROM master_data WHERE crimecategory = 'THEFT' ";
$result = mysql_query($query);
if (!$result) {
  echo "Error 5";
  die('Invalid query: ' . mysql_error());
}

//header("Content-type: text/xml; charset=UTF-8");

while ($row = mysql_fetch_assoc($result)) {
    echo $row['encoder'];
}

// Iterate through the rows, adding XML nodes for each

/*while ($row = @mysql_fetch_assoc($result)){
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
}*/

//echo $dom->saveXML();

?>