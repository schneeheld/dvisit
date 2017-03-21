<?php

require_once 'cinfo.php';

// Connect
$conn = new mysqli ( $server, $uname, $psswd, $dbname );
if (!$conn) {
	// ERROR: Unable to connect to the database
	// ROUTE: General error page
	header("Location: generalError.html");
	exit ();
}

?>
