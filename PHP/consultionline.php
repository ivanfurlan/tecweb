<?php

session_start();
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true && !isset($_GET['email'])) {
    // se e' l'amministratore, e non ha raggiunto questa pagina passando per elencoconsultionline.php, allora lo indirizzo su quella pagina cosi' che possa selezionare che chat visualizzare
    header('location: elencoconsultionline.php');
}

require_once("dbaccess.php");

$oggettoConnessione = new DBAccess();

$connessioneOK = $oggettoConnessione->openDBConnection();

if (!$connessioneOK) {
    // connessione al db non e' andata a buon fine
    header("location: 500.php?errore=connessione_db");
}

$erroriDaMostrare='';
// se devo inserire un nuovo messaggio
if (isset($_POST['nuovomessaggio'], $_SESSION['emailUtente'])) {
    // si e' loggati e si sta inserendo un nuovo messaggio nella chat
    if (trim($_POST['nuovomessaggio']) != '') {
        // se il messaggio non e' vuoto

        // rimuovo gli spazi prima e dopo e sostituisco eventuali <, >, e &
        $nuovoMessaggio = str_replace("<","&lt;",str_replace(">","&gt;",str_replace("&","&amp;",trim($_POST['nuovomessaggio']))));
        // se e' l'admin la mail che caratterizza la chat e' l'email del paziente (passata con get provenendo daelencoconsultionline.php) e non la sua.
        $email = ($_SESSION['isAdmin']) ? $_GET['email'] : $_SESSION['emailUtente'];

        $result = $oggettoConnessione->inserisciMessaggioChat($email, $nuovoMessaggio, (($_SESSION['isAdmin']) ? '1' : '0'));

        if ($result === false) {
            header("location: 500.php?errore=inserimento_messaggio_chat");
        } else {
            // se il messaggio e' stato inserito correttamente ricarico la pagina, cosi' l'utente se aggiornasse la pagina non tornerebbe inserire lo stesso messaggio appena inviato
            header("location: consultionline.php" . (($_SESSION['isAdmin']) ? "?email=" . $_GET['email'] : '')); // per eliminare variabili POST
        }
    }else{
        // errore messaggio vuoto
        $erroriDaMostrare.="<li>Impossibile inserire un messaggio vuoto o con soli spazi.</li>";
    }
}

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

$mainContent = '';
if (isset($_SESSION['emailUtente'])) {
    // se si e' loggati mostro la chat
    $emailChat = ($_SESSION['isAdmin'] == true && isset($_GET['email'])) ? $_GET['email'] : $_SESSION['emailUtente'];

    $result = $oggettoConnessione->getMessaggiChat($emailChat);
    if ($result) {
        // la chat presenta dei messaggi gia' inviati
        foreach ($result as $messaggio) {
            // inserisco tutti i messaggi presenti nel db
            $mainContent .= '<div ' . (($messaggio['IsDottore']) ? 'class="messaggioDottore"' : 'class="messaggioUtente"') . '>
                                <div class="intestazioneMessaggio">
                                    <span class="email">' . (($messaggio['IsDottore']) ? "Dottor Marco Donati" : $messaggio['EmailUtente']) . '</span>
                                    <span class="orario">' . $messaggio['TimeInvio'] . '</span>
                                </div>
                                <p class="testoMessaggioChat">' . $messaggio['Messaggio'] . '</p>
                            </div>';
        }
    } else {
        // non e' ancora stato inviato nessun mesasggio
        $mainContent .= '<p>Non hai ancora scritto nessun messaggio. Approfitta di questo servizio per chiedere al dottor Marco Donati le tue domande!</p>';
    }
    // inserisco il form per inviare un nuovo mesasggio
    $mainContent .= '<form action="consultionline.php' . (($_SESSION['isAdmin']) ? "?email=" . $_GET['email'] : '') . '" method="post" onsubmit="return validaConsultiOnline()" id="formConsultiOnline">
                        <fieldset>
                            <legend class="nascosto">Rispondi</legend>
                            <label for="nuovomessaggio">Scrivi un messaggio' . (($_SESSION['isAdmin'] == true) ? " a $emailChat" : " al Dottore") . ': </label>
                            <textarea name="nuovomessaggio" id="nuovomessaggio" rows="7" cols="40" title="Messaggio di risposta"></textarea>
                            <input type="submit" value="' . (($_SESSION['isAdmin'] == true) ? "Rispondi" : "Invia") . '" />
                        </fieldset>
                    </form>';
} else {
    // non si e' ancora fatto il login, quindi mostro un messaggio per spiegare la pagina ed invitare ad loggarsi
    $mainContent = '<p><a href="accedi.php" title="Pagina per accedere">Effettua il login</a>, oppure <a href="registrati.php" title="Pagina per registrarsi">registrati</a>, per poter chiedere direttamente al <abbr title="dottor">Dott.</abbr> Marco Donati una consulenza online e potergli porre le tue domande direttamente da questa pagina.</p>';
}
if ($erroriDaMostrare !== '') {
    // se ci sono degli errori da stampare, preparo la stringa dentro ad un div
    $erroriDaMostrare = '<div class="erroreCampiForm"><ul>' . $erroriDaMostrare . '</ul></div>';
}

$paginaHTML = str_replace("<erroriDaMostrare />", $erroriDaMostrare, $paginaHTML);
$paginaHTML = str_replace("<pageContent />", $mainContent, $paginaHTML);

echo $paginaHTML;
