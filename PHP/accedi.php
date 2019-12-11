<?php
session_start();

if (isset($_SESSION['emailUtente'])) {
    header("location: index.php");
}

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);
echo $paginaHTML;