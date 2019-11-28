<?php
session_start();

if(isset($_SESSION['emailUtente'])){
    session_unset();
}
header ( "location: index.php" );
?>