<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true && !isset($_GET['email'])){
    header('location: elencoconsultionline.php');
}

require_once("dbaccess.php");

$oggettoConnessione = new DBAccess();

$connessioneOK = $oggettoConnessione->openDBConnection();

if (!$connessioneOK) {
    header("location: 500.php");
}

if (isset($_POST ['nuovomessaggio'])){
    $nuovoMessaggio=trim($_POST ['nuovomessaggio']);
    $email = ($_SESSION['isAdmin'])? $_GET['email'] : $_SESSION['emailUtente'];
    //PRIMA BISOGNA FARE I CONTROLLI SU TUTTI I CAMPI 

    $result = $oggettoConnessione->inserisciMessaggioChat($email,$nuovoMessaggio,(($_SESSION['isAdmin'])? '1' : '0'));

    if($result===false){
        header("location: 500.php");
    }

}

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

$mainContent='';
if (isset($_SESSION['emailUtente'])) {

    $emailChat = ($_SESSION['isAdmin'] == true && isset($_GET['email'])) ? $_GET['email'] : $_SESSION['emailUtente'];

    $result = $oggettoConnessione->getMessaggiChat($emailChat);

    foreach ($result as $messaggio) {
        $mainContent.= '<div '. (($messaggio['IsDottore']) ? 'class="messaggioDottore"' : 'class="messaggioUtente"').'>
            <div class="intestazioneMessaggio">
                <span class="email">'.(($messaggio['IsDottore']) ? "Dottor Marco Donati" : $messaggio['EmailUtente']) .'</span>
                <span class="orario">'. $messaggio['TimeInvio'].'</span>
            </div>
            <p>'. $messaggio['Messaggio'].'</p>
        </div>';
     } 

     $mainContent.= '<form action="consultionline.php'. (($_SESSION['isAdmin'])? "?email=".$_GET['email'] : '').'" method="post">
        <fieldset>
            <legend class="nascosto">Rispondi</legend>
            <label for="nuovomessaggio">Scrivi un messaggio'. (($_SESSION['isAdmin'] == true) ? " a $emailChat" : " al Dottore").': </label>
            <textarea name="nuovomessaggio" rows="7" cols="40" title="Messaggio di risposta"> </textarea>
            <input type="submit" value="Rispondi" />
        </fieldset>
    </form>';
 } else {
    $mainContent = '<h1>Consulti <span xml:lang="en">online</span></h1>
    <p><a href="accedi.php" title="Pagina per accedere">Effettua il login</a>, oppure <a href="registrati.php" title="Pagina per registrarsi">registrati</a>, per poter chiedere direttamente al <abbr title="dottor">Dott.</abbr> Marco Donati una consulenza online e potergli porre le tue domande direttamente da questa pagina.</p>';
 } 

$paginaHTML = str_replace("<pageContent />", $mainContent, $paginaHTML);

echo $paginaHTML;

