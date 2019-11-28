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

            <div class="messaggioUtente">
                <div class="intestazioneMessaggio">
                    <span class="email">utentedelsito@gmail.com</span>
                    <span class="orario">21/10/2019 07:53:42</span>
                </div>
                <p>Salve dottore ciao!</p>
            </div>

            <div class="messaggioDottore">
                <div class="intestazioneMessaggio">
                    <span class="email">info@dottmarcodonati.com</span>
                    <span class="orario">04/11/2019 14:24:07</span>
                </div>
                <p>Ciao carissimo utente!</p>
            </div>

            <div class="messaggioUtente">
                <div class="intestazioneMessaggio">
                    <span class="email">utentedelsito@gmail.com</span>
                    <span class="orario">07/11/2019 22:12:01</span>
                </div>
                <p>Alla prossima!</p>
            </div>

            <form action="consultionline.php" method="post">
                <fieldset>
                    <legend class="nascosto">Rispondi</legend>
                    <label for="nuovomessaggio">Scrivi un messaggio: </label>
                    <textarea name="nuovomessaggio" rows="7" cols="40" title="Messaggio di risposta"> </textarea>
                    <input type="submit" value="Rispondi" />
                </fieldset>
            </form>

        </div>

    </div>

    <?php
    include "../HTML/footer.html";
    ?>
</body>

</html>