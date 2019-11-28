<?php
session_start();

if ($_SESSION['isAdmin'] == false) {
    header('location: consultionline.php');
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
            <dl id="contenutoElencoChat">
                <?php
                require_once "databaseconnection.php";

                $query = "SELECT `EmailUtente` FROM `Messaggi` GROUP BY `EmailUtente`";
                $result = $mysqli->query($query);

                while ($chat = $result->fetch_assoc()) {
                    ?>
                    <dt><a href="consultionline.php?email=<?php echo urlencode($chat['EmailUtente']); ?>"><?php echo $chat['EmailUtente']; ?></a></dt>
                    <dd>L'ultimo messaggio è stato in data e orario: <?php //echo $chat['TimeInvio']; ?></dd>
                <?php } ?>

            </dl>
        </div>

    </div>

    <?php
    include "../HTML/footer.html";
    ?>
</body>

</html>