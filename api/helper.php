<?php

// Positive integer
function validateID($val) {
	
	// Positive int && check for the non-leading zero
	if ((is_int ( $val ) || ctype_digit ( $val )) 
			&& ( int ) $val > 0 && $val [0] != '0') {
		return true;
	} else {
		return false;
	}
}

// Find an available date for a visit.
// Start/end dates and requested time are provided as inputs.
// Query database to return existing/scheduled visits.
function findAvailableDate($conn, $table, $sDay, $eDay, $time) {
	
	// AngularJS DatePicker timezoone issue.
	// Keep yyyy-mm-dd only
	$sDay = substr($sDay, 0, 10);
	$eDay = substr($eDay, 0, 10);
	
	$begin = new DateTime ( $sDay );
	$end = new DateTime ( $eDay );
	
	// Array of all days in the provided range
	$dd = array ();
	for($d = $begin; $d <= $end; $d->modify ( '+1 day' )) {
		$dd [] = $d->format ( 'Y-m-d' );
	}
	
	// Search for all records sort by date
	$sql = "SELECT DATE_FORMAT(vDate, '%Y-%m-%d') AS vDate
			FROM $table
			WHERE vDate>='$sDay' AND vDate <='$eDay'
			AND vTime='$time'
			ORDER BY vDate";
	
	$stmt = $conn->query ( $sql );
	
	// Fetch the records into an associative array
	$records = array ();
	while ( $row = $stmt->fetch_array ( MYSQLI_ASSOC ) ) {
		$records [] = $row ['vDate'];
	}
	
	// Array of all available days
	$res = array_diff ( $dd, $records );

	if ( empty( $res ) )
	{
		return array();
	} else {
		// Return the first elemet, i.e next available date
		return reset ( $res );
		
	}
}

