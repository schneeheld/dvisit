<?php
// TODO: use composer + Zend expressive
require_once 'helper.php';

// Connect
require_once 'connect.php';

// Validate input
$id = $_GET ['ID'];
if (! isset ( $id ) || ! validateID ( $id )) {
	// ERROR: Invalid record id supplied
	exit ();
}

// Delete the record
// If ID is not in the database the statement is still true
$sql = "DELETE FROM $tableName WHERE ID=" . $id;
$stmt = $conn->query ( $sql );

// TODO: Use MVC pattern: move to view
if ($stmt) {
	$response = '<center><h2>Record ' . $id 
			. ' has been successfully removed.</H2></center>';
	$response .= '<center><a href="../admin.html"><img src="../img/refresh.png"></a></center>';
} else {
	$response = "<center><h2>Failed to remove the record " 
			. $id . " </H2></center>";
}

// Close connection
$conn->close ();

echo $response;
?>
