<!-- INIZIO HEADER -->

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
    <h1><a href="index.html"><abbr title="Dottor">Dott.</abbr> Marco Donati</a></h1>
    <a href="javascript:void(0);" id="pulsanteMenuNav" onclick="openCloseMenu('nav')">
        <img src="../img/menu-icon.png" alt="menu principale" />
    </a>
    <ul id="navUser" class="menuClose">
        <li><a href="registrati.php">Registrati</a></li>
        <li <?php echo (strpos($_SERVER['PHP_SELF'],"accedi.php"))? "class=\"currentLink\"" : "";?>> 
            <?php echo (strpos($_SERVER['PHP_SELF'],"accedi.php"))? "Accedi" : "<a href=\"accedi.php\">Accedi</a>"; ?>
        </li>
    </ul>
</div>

<!-- Barra di navigazione -->
<div id="nav" class="menuClose">
    <ul>
        <li xml:lang="en"><a href="index.php">Home</a></li>
        <li><a href="contatti.php">Contatti</a></li>
        <li><a href="dottore.php">Dottore</a></li>
        <li id="navAreaMedica"><a href="areamedica.html">Area medica</a>
            <ul>
                <li><a href="citologianasale.php">Citologia nasale</a></li>
                <li><a href="impedenzometria.php">Impedenzometria</a></li>
                <li><a href="otomicroscopia.php">Otomicroscopia</a></li>
                <li><a href="posturografia.php">Posturografia</a></li>
            </ul>
        </li>
        <li><a href="notizie.php">Notizie</a></li>
        <li><a href="prenotavisita.php">Prenota visita</a></li>
        <li><a href="consultionline.php">Consulti <span xml:lang="en">online</span></a></li>
    </ul>
</div>

<!-- Breadcrumbs -->
<div id="breadcrumbs">
    <p>Sei in: <span xml:lang="en">Home</span></p>
</div>


<!-- FINE HEADER -->