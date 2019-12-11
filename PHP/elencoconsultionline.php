<?php
session_start();

if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == false) {
    header('location: consultionline.php');
}

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

require_once("dbaccess.php");
$oggettoConnessione = new DBAccess();
$connessioneOK = $oggettoConnessione->openDBConnection();
if (!$connessioneOK) {
    header("location: 500.php?errore=connessione_db");
}

$result = $oggettoConnessione->getChatList();

if ($result != NULL) {
    $pageContent = '';
    foreach ($result as $chat) {
        $pageContent .= '<dt><a href="consultionline.php?email=' . urlencode($chat['EmailUtente']) . '">' . $chat['EmailUtente'] . '</a></dt>
                    <dd>L&rsquo;ultimo messaggio è stato in data e ora: ' . $chat['TimeInvio'] . '</dd>';
    }
} else {
    $pageContent .=  '<dt>Al momento non è presente nessuna richiesta da parte dei pazienti</dt>';
}
$paginaHTML = str_replace("<pageContent />", $pageContent, $paginaHTML);


echo $paginaHTML;
