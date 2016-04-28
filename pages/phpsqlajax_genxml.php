<?php
error_reporting(-1);
require("phpsqlajax_dbinfo.php");
echo "Hello!";

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server
var_dump($cleardb_url);
$connection=@mysql_connect ($cleardb_server, $cleardb_username, $cleardb_password);
if (!$connection) {  die('Not connected : ' . mysql_error());}
echo "Error!";
// Set the active MySQL database
var_dump($cleardb_url);
var_dump($connection);

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
ini_set('memory_limit', '-1');
while ($row = mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("day", utf8_encode($row['day']));
  $newnode->setAttribute("barangay", utf8_encode($row['barangay']));
  $newnode->setAttribute("classification", utf8_encode($row['classification']));
  $newnode->setAttribute("areaofincident", utf8_encode($row['areaofincident']));
  $newnode->setAttribute("latitude", utf8_encode($row['latitude']));
  $newnode->setAttribute("longitude", utf8_encode($row['longitude']));
  $newnode->setAttribute("crimetype", utf8_encode($row['crimetype']));
}

echo $dom->saveXML();

?>