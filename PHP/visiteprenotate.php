<?php
// pagina acessibile solo dall'amministratore
session_start();

if ((isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == false) || !isset($_SESSION['isAdmin'])) {
    // se non si è admin si viene mandati alla pagina prenotavisita.php
    header('location: prenotavisita.php');
}

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

require_once("dbaccess.php");
$oggettoConnessione = new DBAccess();
$connessioneOK = $oggettoConnessione->openDBConnection();
if (!$connessioneOK) {
    // connessione db fallita
    header("location: 500.php?errore=connessione_db");
}

$result = $oggettoConnessione->ciSonoVisitePrenotate();

$pageContent = '';
if ($result) {
    // ci sono visite prenotate
    $pageContent .= '<h2>Visite di oggi</h2><ul class="elencoPuntato">';
    $temp = preparaHTMLListaVisite($oggettoConnessione->getListaVisitePrenotatePeriodo("o"));
    $pageContent.= ($temp)?$temp:"<li>Non sono presenti visite prenotate per oggi</li>";
    $pageContent .= '</ul>';
    $pageContent .= '<h2>Visite nei prossimi 7 giorni</h2><ul class="elencoPuntato">';
    $temp = preparaHTMLListaVisite($oggettoConnessione->getListaVisitePrenotatePeriodo("f7"));
    $pageContent.= ($temp)?$temp:"<li>Non sono presenti visite prenotate per i prossimi 7 giorni</li>";
    $pageContent .= '</ul>';
    $pageContent .= '<h2>Ultime 20 visite passate</h2><ul class="elencoPuntato">';
    $temp = preparaHTMLListaVisite($oggettoConnessione->getListaVisitePrenotatePeriodo("p"));
    $pageContent.= ($temp)?$temp:"<li>Non sono presenti visite passate</li>";
    $pageContent .= '</ul>';
} else {
    // non ci sono visite prenotate
    $pageContent .=  '<p>Al momento nessuno ha prenotato una visita</p>';
}
$paginaHTML = str_replace("<pageContent />", $pageContent, $paginaHTML);


echo $paginaHTML;
