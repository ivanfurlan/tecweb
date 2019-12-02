<?php
	require_once "credenzialiDatabase.php";
	
	// create connection
	$mysqli = new mysqli($servername_db, $username_db, $password_db, $dbname_db);
	
	// check connection
	if($mysqli->connect_error) {
		header("Location: 500.php");
    }
?>

