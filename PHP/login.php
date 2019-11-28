<?php
session_start();
//aggiungi il nome del user tra parantesi
if(!session_is_registered()){
header("location:../HTML/accedi.html");

?>
