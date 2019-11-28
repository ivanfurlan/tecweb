<?php
session_start();
//aggiungi il nome del user
if(!session_is_registered()){
header("location:../HTML/accedi.html");

?>