<?php
session_start();

if ((isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == false)||!isset($_SESSION['isAdmin'])) {
    //se non si è amministratori, o non si è loggati si inoltra il visitatore a consultionline.php
    header('location: consultionline.php');
}

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

require_once("dbaccess.php");
$oggettoConnessione = new DBAccess();
$connessioneOK = $oggettoConnessione->openDBConnection();
if (!$connessioneOK) {
    //si è verificato un errore nella connessione al db
    header("location: 500.php?errore=connessione_db");
}

$result = $oggettoConnessione->getChatList();

if ($result != NULL) {
    //ci sono chat 
    $pageContent = '';
    foreach ($result as $chat) {
        //inserisco tutti gli account che hanno scritto un messaggio
        $pageContent .= '<dt><a href="consultionline.php?email=' . urlencode($chat['EmailUtente']) . '">' . $chat['EmailUtente'] . '</a></dt>
                    <dd>L&rsquo;ultimo messaggio è stato in data e ora: ' . $chat['TimeInvio'] . '</dd>';
    }
} else {
    //non ci sono chat - nessun utente ha scritto messaggi
    $pageContent .=  '<dt>Al momento non è presente nessuna richiesta da parte dei pazienti</dt>';
}
$paginaHTML = str_replace("<pageContent />", $pageContent, $paginaHTML);


echo $paginaHTML;
