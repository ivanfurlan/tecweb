<?php
	require_once "credenzialiDatabase.php";
	
	// create connection
	$mysqli = new mysqli($servername, $username, $password, $dbname);
	
	// check connection
	if($mysqli->connect_error) {
		die("Connection Failed : " . $conn->error);
    }
?>

