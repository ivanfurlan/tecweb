<?php
session_start();
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
    header('location: visiteprenotate.php');
}
require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

$pageContent = "";
if (isset($_SESSION['emailUtente'])) {
    $pageContent .= '
            <form action="prenotavisita.php" method="post">
                <div class="colonna1">
                    <fieldset>
                        <legend>Scegli il giorno e il tipo di visita</legend>

                        <label for="anno">Anno:</label>
                        <select name="anno" id="anno">
                            <option value="2019" selected="selected">2019</option>
                            <option value="2020">2020</option>
                        </select>

                        <label for="mese">Mese:</label>
                        <select name="mese" id="mese">
                            <option value="1">Gennaio</option>
                            <option value="2">Febbraio</option>
                            <option value="3">Marzo</option>
                            <option value="4">Aprile</option>
                            <option value="5">Maggio</option>
                            <option value="6">Giugno</option>
                            <option value="7">Luglio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Settembre</option>
                            <option value="10">Ottobre</option>
                            <option value="11">Novembre</option>
                            <option value="12">Dicembre</option>
                        </select>

                        <label for="giorno">Giorno:</label>
                        <select name="giorno" id="giorno">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                        <br />
                        <label for="tipovisita">Visita:</label>
                        <select name="tipovisita" id="tipovisita">
                            <option value="impedenzometria" selected="selected">Impedenzometria</option>
                            <option value="citologianasale" >Citologia Nasale</option>
                            <option value="otomicroscopia" >Otomicroscopia</option>
                            <option value="posturografia">Posturografia</option>  
                        </select>

                        <button type="button" onclick="controllaDisponibilita()">Controlla disponibilit&agrave;</button>
                    </fieldset>
                </div>
                <!--da fare in modo che quando Click Controlla disponibilit&agrave viene fuori questa form -->
                <div class="colonna2">
                    <fieldset id="sceltaOrario" class="nascosto">
                        <legend>Scegli l&rsquo;orario della visita</legend>

                        <input type="radio" name="orario" id="ore8" value="8:00" />
                        <label for="ore8">Ore 8:00-9:00</label>

                        <input type="radio" name="orario" id="ore9" value="9:00" />
                        <label for="ore9">Ore 9:00-10:00</label>

                        <input type="radio" name="orario" id="ore10" value="10:00" />
                        <label for="ore10">Ore 10:00-11:00</label>

                        <input type="radio" name="orario" id="ore11" value="11:00" />
                        <label for="ore11">Ore 11:00-12:00</label>

                        <input type="radio" name="orario" id="ore16" value="16:00" />
                        <label for="ore16">Ore 16:00-17:00</label>

                        <input type="radio" name="orario" id="ore17" value="17:00" />
                        <label for="ore17">Ore 17:00-18:00</label>

                        <input type="radio" name="orario" id="ore18" value="18:00" />
                        <label for="ore18">Ore 18:00-19:00</label>

                        <input type="submit" value="Prenota visita" />
                    </fieldset>

                </div>
            </form>';
} else {
    $pageContent .= '
                <p><a href="accedi.php" title="Pagina per accedere">Effettua il login</a>, oppure <a href="registrati.php" title="Pagina per registrarsi">registrati</a>, per poter prenotare una visita con il Dottor Marco Donati in uno degli orari ancora disponibili.
                </p>
        ';
}

$paginaHTML = str_replace("<pageContent />", $pageContent, $paginaHTML);

echo $paginaHTML;