<?php
    require_once "databaseconnection.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
    <title>Notizie - Dott. Marco Donati</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description"
        content="Sezione notizie del sito del dott. Marco Donati" />
    <meta name="keywords"
        content="notizie,news,novità,Chiusure straordinarie,dottore,dott,dottor,Marco Donati,visite specialistiche,otorino,otorinolaringoiatra,consulenza,medico,padova" />
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
        <h1 xml:lang="en">Notizie</h1>
        <?php
            $query="SELECT * FROM `Notizie`";
            $result=$mysqli->query($query);

            while ($notizia=$result->fetch_assoc()){
        ?>
                <div class="notizia">
                    <h2><?php echo $notizia['Titolo']; ?></h2>
                    <p>
                        Postato il <?php echo $notizia['Data']; ?> dal <a href="dottore.html"><abbr title="Dottor">Dott.</abbr> Marco Donati&nbsp;</a>
                    </p>
                    <p>
                        <?php echo $notizia['Contenuto']; ?>
                    </p>
                </div>

        <?php
            }
        ?>

    </div>

    <?php
        include "../HTML/footer.php";
    ?>
</body>

</html>