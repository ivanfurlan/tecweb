<?php
	$servername = "localhost";
	$username = "";
	$password = "";
	$dbname="dbDottMarcoDonati";
	
	// create connection
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// check connection
	
	if($conn->connect_error) {
		die("Connection Failed : " . $conn->error);
	}
?>