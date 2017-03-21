<?php

header ( "Content-Type: application/json; charset=UTF-8" );

// Connect
require_once 'connect.php';

// Search for all records sort by date
$sql = "SELECT * FROM $tableName ORDER BY vDate, vTime";
$stmt = $conn->query ( $sql );

// Fetch the records into an associative array
$records = array ();
while ( $row = $stmt->fetch_array ( MYSQLI_ASSOC ) ) {
	$records [] = $row;
}

// Close connection
$conn->close ();

// Generate json response
$response = '{"records":' . json_encode ( $records ) . '}';
echo ($response);
?>
