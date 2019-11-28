<!-- INIZIO HEADER -->

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$pageName = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1);
?>

<!-- Link vai al contenuto iniziale -->
<div class="skipLink">
    <a href="#main">Vai al contenuto iniziale</a>
</div>

<!-- Header primo livello -->
<div id="header">
    <a href="javascript:void(0);" id="pulsanteMenuUser" onclick="openCloseMenu('navUser')">
        <img src="../img/user-icon.png" alt="menu login" />
    </a>
    <a href="index.html" id="logo">
        <img src="../img/logo.png" alt="Studio medico del dott. Marco Donati" />
    </a>

    <?php if ($pageName == "index.php") { ?>
        <h1><a href="index.html"><abbr title="Dottor">Dott.</abbr> Marco Donati</a></h1>
    <?php } else { ?>
        <h1><abbr title="Dottor">Dott.</abbr> Marco Donati</h1>
    <?php } ?>

    <a href="javascript:void(0);" id="pulsanteMenuNav" onclick="openCloseMenu('nav')">
        <img src="../img/menu-icon.png" alt="menu principale" />
    </a>
    <ul id="navUser" class="menuClose">
        <?php if (isset($_SESSION['emailUtente'])) { ?>
            <li><a href="logout.php">Esci</a></li>
        <?php } else { ?>

            <?php if ($pageName == "registrati.php") { ?>
                <li class="currentLink">Registrati</li>
            <?php } else { ?>
                <li><a href="registrati.php">Registrati</a></li>
            <?php } ?>

            <?php if ($pageName == "accedi.php") { ?>
                <li class="currentLink">Accedi</li>
            <?php } else { ?>
                <li><a href="accedi.php">Accedi</a></li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>

<!-- Barra di navigazione -->
<div id="nav" class="menuClose">
    <ul>
        <?php if ($pageName == "index.php") { ?>
            <li class="currentLink" xml:lang="en">Home</li>
        <?php } else { ?>
            <li <?php echo ($pageName != "contatti.php")? "xml:":""; ?>lang="en"><a href="index.php">Home</a></li>
        <?php } ?>

        <?php if ($pageName == "contatti.php") { ?>
            <li class="currentLink">Contatti</li>
        <?php } else { ?>
            <li><a href="contatti.php">Contatti</a></li>
        <?php } ?>

        <?php if ($pageName == "dottore.php") { ?>
            <li class="currentLink">Dottore</li>
        <?php } else { ?>
            <li><a href="dottore.php">Dottore</a></li>
        <?php } ?>

        <?php if ($pageName == "areamedica.php") { ?>
            <li class="currentLink" id="navAreaMedica">Area medica
            <?php } else { ?>
            <li id="navAreaMedica"><a href="areamedica.php">Area medica</a>
            <?php } ?>

            <ul>

                <?php if ($pageName == "citologianasale.php") { ?>
                    <li class="currentLink">Citologia nasale</li>
                <?php } else { ?>
                    <li><a href="citologianasale.php">Citologia nasale</a></li>
                <?php } ?>

                <?php if ($pageName == "impedenzometria.php") { ?>
                    <li class="currentLink">Impedenzometria</li>
                <?php } else { ?>
                    <li><a href="impedenzometria.php">Impedenzometria</a></li>
                <?php } ?>

                <?php if ($pageName == "otomicroscopia.php") { ?>
                    <li class="currentLink">Otomicroscopia</li>
                <?php } else { ?>
                    <li><a href="otomicroscopia.php">Otomicroscopia</a></li>
                <?php } ?>

                <?php if ($pageName == "posturografia.php") { ?>
                    <li class="currentLink">Posturografia</li>
                <?php } else { ?>
                    <li><a href="posturografia.php">Posturografia</a></li>
                <?php } ?>

            </ul>
            </li>

            <?php if ($pageName == "notizie.php") { ?>
                <li class="currentLink">Notizie</li>
            <?php } else { ?>
                <li><a href="notizie.php">Notizie</a></li>
            <?php } ?>

            <?php if ($pageName == "prenotavisita.php") { ?>
                <li class="currentLink">Prenota visita</li>
            <?php } else { ?>
                <li><a href="prenotavisita.php">Prenota visita</a></li>
            <?php } ?>

            <?php if ($pageName == "consultionline.php") { ?>
                <li class="currentLink">Consulti <span xml:lang="en">online</span></li>
            <?php } else { ?>
                <li><a href="consultionline.php">Consulti <span <?php echo ($pageName != "contatti.php")? "xml:":""; ?>lang="en">online</span></a></li>
            <?php } ?>

    </ul>
</div>

<!-- Breadcrumbs -->
<div id="breadcrumbs">
    <?php if ($pageName == "index.php") { ?>
        <p>Sei in: <span xml:lang="en">Home</span></p>
    <?php } else { ?>
        <p>Sei in: <span <?php echo ($pageName != "contatti.php")? "xml:":""; ?>lang="en"><a href="index.php">Home</a></span> &gt;&gt;
            <?php
                switch ($pageName) {
                    case "contatti.php":
                        echo "Contatti";
                        break;
                    case "dottore.php":
                        echo "Dottore";
                        break;
                    case "areamedica.php":
                        echo "Area medica";
                        break;
                    case "citologianasale.php":
                        echo '<a href="areamedica.php">Area medica</a> &gt;&gt; ';
                        echo "Citologia nasale";
                        break;
                    case "impedenzometria.php":
                        echo '<a href="areamedica.php">Area medica</a> &gt;&gt; ';
                        echo "Impedenzometria";
                        break;
                    case "otomicroscopia.php":
                        echo '<a href="areamedica.php">Area medica</a> &gt;&gt; ';
                        echo "Otomicroscopia";
                        break;
                    case "posturografia.php":
                        echo '<a href="areamedica.php">Area medica</a> &gt;&gt; ';
                        echo "Posturografia";
                        break;
                    case "notizie.php":
                        echo "Notizie";
                        break;
                    case "prenotavisita.php":
                        echo "Prenota visita";
                        break;
                    case "consultionline.php":
                        echo 'Consulti <span xml:lang="en">online</span>';
                        break;
                    case "registrati.php":
                        echo "Registrati";
                        break;
                    case "accedi.php":
                        echo "Accedi";
                        break;
                }
                ?>
        </p>
    <?php } ?>
</div>


<!-- FINE HEADER -->