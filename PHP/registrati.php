<?php
include("databaseconnection.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
    <title>Registrati - Dott. Marco Donati</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Registrati al sito del dott. Marco Donati per comunicare direttamente con il dottore." />
    <meta name="keywords" content="registrati,registrazione,dottore,dott,dottor,Marco Donati,visite specialistiche,otorino,otorinolaringoiatra,consulenza,medico,Padova" />
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

<body onload="setSubmitForJS()">
    <?php
    include "header.php";
    ?>
    <div id="main">
        <h1>Registrati</h1>
        <p id="descrizioneForm">
            Registrati completando con i tuoi dati il modulo sottostante, cos&igrave; potrai prenotare le visite
            direttamente su questo sito, o inviare un messaggio al <abbr title="Dottor">Dott.</abbr> Marco Donati
            chiedendo una consulenza <span xml:lang="en">online</span>.
        </p>
        <!-- form per registrazione da fare registrati.php -->
        <form id="formRegistrati" action="../PHP/registrati.php" method="post">
            <fieldset>
                <legend class="nascosto">Registrati</legend>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" /><br />

                <label for="cognome">Cognome:</label>
                <input type="text" name="cognome" id="cognome" /><br />

                <label for="telefono">Telefono:</label>
                <input type="text" name="telefono" id="telefono" /> <br />

                <label for="email" xml:lang="en">Email:</label>
                <input type="text" name="email" id="email" /><br />

                <!--  da fare controllo di due password -->
                <label for="password" xml:lang="en">Password:</label>
                <input type="password" name="password" id="password" /><br />

                <label for="confermapassword">Conferma <span xml:lang="en">password</span>:</label><br />
                <input type="password" name="confermapassword" id="confermapassword" /><br />

                <input type="submit" value="Registrati" onclick="validaRegistrati()" id="btnSubmit" />
            </fieldset>
        </form>
        <p><a href="accedi.php">Se sei gi&agrave; registrato clicca qui</a></p>
    </div>

    <?php
    include "footer.php";
    ?>
</body>

</html>