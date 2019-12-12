<?php
session_start();

if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == false) {
    header('location: prenotavisita.php');
}

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);


require_once("dbaccess.php");
$oggettoConnessione = new DBAccess();
$connessioneOK = $oggettoConnessione->openDBConnection();
if (!$connessioneOK) {
    header("location: 500.php?errore=connessione_db");
}

$result = $oggettoConnessione->ciSonoVisitePrenotate();

$pageContent = '';
if ($result) {
    $pageContent .=  '<p>Oh, qualcuno ha prenotato una visita, ma ancora non sono in grado di dirchi chi è e quando verrà</p>';
} else {
    $pageContent .=  '<p>Al momento nessuno ha prenotato una visita</p>';
}
$paginaHTML = str_replace("<pageContent />", $pageContent, $paginaHTML);


echo $paginaHTML;
