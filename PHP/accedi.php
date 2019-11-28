<?php
/*accedi.php */

include ("../PHP/databaseconnection.php");

$connection=mysql_connect("$servername", "$username", "$password")or die("cannot connect");

$db=mysql_select_db("$dbname")or die("cannot select DB");

//aggiungere nome user e password
$username=$_POST[''];
$password=$_POST[''];
$sql="SELECT * FROM Utenti WHERE Email='$username' and Password='$password'";


$result=mysql_query($sql);

$count=mysql_num_rows($result);
if($count==1){
	
//aggiungere nome user e password
// Register $myusername, $mypassword and redirect to file "login.php"
session_register("");
session_register("");
header("location:../PHP/login.php");
else {
echo "Attenzione username o password errati";
}
?>