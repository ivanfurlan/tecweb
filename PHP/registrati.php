<?php
/* registrati.php*/
include ("../PHP/databaseconnection.php");


$connection=mysql_connect("$host", "$username_db", "$password_db")or die("cannot connect");

$db=mysql_select_db("$db_name")or die("cannot select DB");


?>