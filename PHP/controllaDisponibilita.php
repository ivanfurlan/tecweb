<?php
require_once("dbaccess.php");
$oggettoConnessione = new DBAccess();
$connessioneOK = $oggettoConnessione->openDBConnection();

if (!$connessioneOK) {
    header("location: 500.php?errore=connessione_db");
}

$result = $oggettoConnessione->controllaDisponibilita($_POST['giorno'], $_POST['mese'], $_POST['anno'], $_POST['tipovisita']);

if ($result !== NULL) {
    header('Content-type: text/javascript');
    echo json_encode($result, JSON_PRETTY_PRINT);
} else {
    echo "{}";
}
