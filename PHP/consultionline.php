<?php
session_start();

if ($_SESSION['isAdmin'] == true && !isset($_GET['email'])){
    header('location: elencoconsultionline.php');
}


if (isset($_POST ['nuovomessaggio'])){
    $nuovoMessaggio=trim($_POST ['nuovomessaggio']);
    $email = ($_SESSION['isAdmin'])? $_GET['email'] : $_SESSION['emailUtente'];
    //PRIMA BISOGNA FARE I CONTROLLI SU TUTTI I CAMPI 

    include ("databaseconnection.php");
    $query="INSERT INTO `Messaggi` (`EmailUtente`, `TimeInvio`, `Messaggio`, `IsDottore`) VALUES ('$email', CURRENT_TIMESTAMP, '$nuovoMessaggio', ".(($_SESSION['isAdmin'])? '1' : '0') .");";
    //echo $query;
    $result=$mysqli->query($query);

    if($result===false){
        header("location: 500.php");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- doctype html -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
    <title>Consulti online - Dott. Marco Donati</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Contatta direttamente il dottore per discutere e risolvere i tuoi problemi. E' necessario registrarsi o accedere al sito." />
    <meta name="keywords" content="consulti online,chat,dottore,dott,dottor,Marco Donati,visite specialistiche,otorino,otorinolaringoiatra,consulenza,medico,Padova" />
    <meta name="author" content="Francesco Bari, Ivan Furlan, Zhaohui Lin, Francesco Pecile" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />

    <!-- Desktop -->
    <link rel="stylesheet" type="text/css" href="../CSS/styledesktop.css" />

    <!-- Mobile -->
    <link rel="stylesheet" type="text/css" href="../CSS/stylemobile.css" media="screen and (max-width: 630px)" />

    <!-- Print -->
    <link rel="stylesheet" type="text/css" href="../CSS/styleprint.css" media="print" />

    <!-- Icon -->
    <link rel="icon" href="../img/logo.png" type="image/gif" />

    <!-- Javascript -->
    <script src="../JS/script.js" type="text/javascript" charset="utf-8"></script>

</head>

<body>
    <?php
    include "header.php";
    ?>

    <div id="main">

        <div id="chat">
            <?php
            if (isset($_SESSION['emailUtente'])) {
                require_once "databaseconnection.php";

                $emailChat = ($_SESSION['isAdmin'] == true && isset($_GET['email'])) ? $_GET['email'] : $_SESSION['emailUtente'];
                $query = "SELECT * FROM `Messaggi` WHERE `EmailUtente` = '$emailChat' ORDER BY `TimeInvio` ASC";
                $result = $mysqli->query($query);

                while ($messaggio = $result->fetch_assoc()) {
                    ?>
                    <div <?php echo ($messaggio['IsDottore']) ? 'class="messaggioDottore"' : 'class="messaggioUtente"'; ?>>
                        <div class="intestazioneMessaggio">
                            <span class="email"><?php echo ($messaggio['IsDottore']) ? "Dottor Marco Donati" : $messaggio['EmailUtente']; ?></span>
                            <span class="orario"><?php echo $messaggio['TimeInvio']; ?></span>
                        </div>
                        <p><?php echo $messaggio['Messaggio']; ?></p>
                    </div>
                <?php } ?>

                <form action="consultionline.php<?= ($_SESSION['isAdmin'])? "?email=".$_GET['email'] : ''?>" method="post">
                    <fieldset>
                        <legend class="nascosto">Rispondi</legend>
                        <label for="nuovomessaggio">Scrivi un messaggio<?php echo ($_SESSION['isAdmin'] == true) ? " a $emailChat" : " al Dottore"; ?>: </label>
                        <textarea name="nuovomessaggio" rows="7" cols="40" title="Messaggio di risposta"> </textarea>
                        <input type="submit" value="Rispondi" />
                    </fieldset>
                </form>
            <?php } else { ?>
                <h1>Consulti <span xml:lang="en">online</span></h1>
                <p><a href="accedi.php" title="Pagina per accedere">Effettua il login</a>, oppure <a href="registrati.php" title="Pagina per registrarsi">registrati</a>, per poter chiedere direttamente al <abbr title="dottor">Dott.</abbr> Marco Donati una consulenza online e potergli porre le tue domande direttamente da questa pagina.</p>
            <?php } ?>
        </div>

    </div>

    <?php
    include "footer.php";
    ?>
</body>

</html>