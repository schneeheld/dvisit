<?php
// header ( "Content-Type: application/json; charset=UTF-8" );

require_once 'helper.php';


function recordInsertStatement($table, $rec) {

	$sql = "INSERT INTO $table (uName, vReason, vDate, vTime)
			VALUES ('$rec[0]','$rec[1]','$rec[2]','$rec[3]')";

	return $sql;
}

// Get user input
$post_date = file_get_contents ( "php://input" );
$data = json_decode ( $post_date );


// Escape && sanitise username
// TODO: anti-injection verification
// Secure special characters, define reg_exp pattern
if ( strlen ( $data->userName ) < 1 ) 
{
	echo 'ERROR: Incomplete input.';
	exit ();
}

$record [0] = $data->userName;
$record [1] = $data->visitReason;
$record [3] = $data->visitTime;


// Connect
require_once 'connect.php';

// Find an available visit date
$record [2] = findAvailableDate ( $conn, $tableName, 
					$data->startDate, $data->endDate, $data->visitTime );

	
// No day is available for the requiested time
if (empty ( $record[2] )) {
	echo "Already booked for the required time.";
	exit ();
}
	
// Insert data into database
$sql = recordInsertStatement ( $tableName, $record );
$stmt = $conn->query ( $sql );

if ($stmt) {
	$response = "Your request has been successfully confirmed.";
} else {
	$response = "We're experiencing some technical difficulties.";
}

// Close connection
$conn->close ();

echo $response;
?>
