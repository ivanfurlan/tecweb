<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
    <title>Homepage - Dott. Marco Donati</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Sito del dott. Marco Donati, otorinolaringoiatra di Padova. Offre consulenza online e visite specialistiche su prenotazione." />
    <meta name="keywords" content="dottore,dott,dottor,Marco Donati,visite specialistiche,otorino,otorinolaringoiatra,consulenza,medico,padova" />
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

        <img src="../img/studio1.jpg" class="imgSlider" alt="Dottor Marco Donati che visita un paziente" />
        <img src="../img/studio2.jpg" class="imgSlider" alt="Sala d'attesa dello studio" />
        <img src="../img/studio3.jpg" class="imgSlider" alt="Dottore che effettua una Citologia nasale su un paziente" />

        <button id="leftButton" onclick="plusDivs(-1)">&#10094;</button>
        <button id="rightButton" onclick="plusDivs(1)">&#10095;</button>

        <p>
            Nello studio di Via Paolotti 2, in provincia di Padova, il <abbr title="Dottor">Dott.</abbr> Marco Donati
            esegue visite specialistiche preoccupandosi della salute del condotto uditivo, nasale e sui disturbi
            dell'equilibrio dovuti a posture scorrette. <br /> Per avere informazioni dettagliate sulle prestazioni
            offerte si consiglia di visitare la pagina presente nel menù di navigazione, denominata <a href="areamedica.html">Area medica</a>. Il dottore svolge anche un <a href="consultionline.html" title="Pagina consulti online">servizio di consulti online gratuiti</a>, per avere rapida un'opinione
            sullo stato di salute, magari da approfondire con una visita.<br />
            I servizi offerti dallo studio sono in continuo aggiornamento, quindi vi consigliamo di controllare la
            pagina <a href="notizie.html">Notizie</a> per restare aggiornati e per informazioni su eventuali chiusure
            eccezionali dello studio.
        </p>
    </div>

    <?php
    include "../HTML/footer.html";
    ?>
</body>

</html>