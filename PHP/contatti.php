<!DOCTYPE html>
<html lang="it">

<head>
    <title>Contatti - Dott. Marco Donati</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Informazioni sugli orari, sui vari contatti e sulla posizione dello studio." />
    <meta name="keywords" content="contatti,orari,indirizzo,dottore,dott,dottor,Marco Donati,visite specialistiche,otorino,otorinolaringoiatra,consulenza,medico,Padova" />
    <meta name="author" content="Francesco Bari, Ivan Furlan, Zhaohui Lin, Francesco Pecile" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Desktop -->
    <link rel="stylesheet" type="text/css" href="../CSS/styledesktop.css" />

    <!-- Mobile -->
    <link rel="stylesheet" type="text/css" href="../CSS/stylemobile.css" media="screen and (max-width: 630px)" />

    <!-- Print -->
    <link rel="stylesheet" type="text/css" href="../CSS/styleprint.css" media="print" />

    <!-- Icon -->
    <link rel="icon" href="../img/logo.png" type="image/gif" />

    <!-- Javascript -->
    <script src="../JS/script.js"></script>

</head>

<body>
    <?php
    include "header.php";
    ?>

    <div id="main" class="contatti">
        <h1>Contatti</h1>
        <div class="colonna1">
            <p>
                Negli orari di segreteria &egrave; possibile chiedere maggiori informazioni, o disdire degli
                appuntamenti
                (entro le ore 17 del giorno precedente la visita)<br />
            </p>
            <h2>Orari</h2>
            <p>Lo studio &egrave; aperto con i seguenti orari: <br />
                <em>Segreteria:</em><br />
                Luned&igrave; - Venerd&igrave;: 8:00 - 12:30 / 16:00 - 19:00<br />
                <em>Studio:</em><br />
                Luned&igrave; - Venerd&igrave;: 16:00 - 19:00<br />

                Rimane permanentemente in funzione un servizio di segreteria telefonica.</p>
            <dl id="recapitiContatti">
                <dt>Telefono</dt>
                <dd>049 1234567</dd>
                <dt>Fax</dt>
                <dd>049 7654321</dd>
                <dt lang="en">Email</dt>
                <dd>info@dottmarcodonati.it</dd>
                <dt>Indirizzo</dt>
                <dd>Padova (PD), via Paolotti 2, 35121, al terzo piano.</dd>
            </dl>
        </div>
        <div class="colonna2">
            <!-- <span lang="en">Google maps</span> -->
            <div class="skipLink">
                <a href="#footer">Salta la mappa</a>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1400.5349899327482!2d11.886011192767873!3d45.407928396048725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x477eda58121508c7%3A0xce9bf01594057558!2sEdificio%20Paolotti%2C%20Via%20Giambattista%20Belzoni%2C%207%2C%2035121%20Padova%20PD!5e0!3m2!1sit!2sit!4v1571318420037!5m2!1sit!2sit" id="mappaGoogle" title="Mappa con la posizione dello studio">
            </iframe>
        </div>
    </div>
    <?php
    include "../HTML/footer.html";
    ?>
</body>

</html>