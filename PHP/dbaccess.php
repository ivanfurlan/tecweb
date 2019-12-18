<?php
//includo le credenziali
require_once("credenzialiDatabase.php");

if (strpos($_SERVER['PHP_SELF'], 'dbaccess') !== false) {
    //se uno prova ad accedere a questa pagina da browser ritorno un 404, come se la pagina non esistesse
    header("location: 404.php");
}
//classe che gestisce tutte le comuhnicazioni con il database
class DBAccess
{   
    //imposto le credenziali inserite sul file
    const HOST_DB = servername_db;
    const USERNAME = username_db;
    const PASSWORD = password_db;
    const DATABASE_NAME = dbname_db;

    public $connection = NULL;

    //distruttore della classe che chiude la connessione
    function __destruct()
    {  
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }

    //apro la connessione
    public function openDBConnection()
    {
        $this->connection = mysqli_connect(static::HOST_DB, static::USERNAME, static::PASSWORD, static::DATABASE_NAME);

        if (!$this->connection)
            return false;
        else
            return true;
    }

    //ritorna la lista delle notizie, o null se non ce ne sono
    public function getNotizie()
    {
        $query = "SELECT * FROM `Notizie` ORDER BY `Data` DESC;";
        $queryResult = mysqli_query($this->connection, $query);

        if (mysqli_num_rows($queryResult) == 0) {
            //non ci sono notizie
            return NULL;
        } else {
            //ci sono notizie
            //creo array da ritornare
            $result = array();

            while ($row = mysqli_fetch_assoc($queryResult)) {
                array_push($result, $row);
            }

            return $result;
        }
    }

    //inserisco un messaggio nella chat di consulti online
    public function inserisciMessaggioChat($email, $nuovoMessaggio, $isAdmin)
    {
        $query = "INSERT INTO `Messaggi` (`EmailUtente`, `TimeInvio`, `Messaggio`, `IsDottore`) VALUES ('$email', CURRENT_TIMESTAMP, '" . mysqli_real_escape_string($this->connection, $nuovoMessaggio) . "', $isAdmin);";
        return mysqli_query($this->connection, $query);
    }

    //restituisce la lista dei messaggi della chat consultionline, o null se non ci sono mesasggi
    public function getMessaggiChat($emailChat)
    {
        $query = "SELECT * FROM `Messaggi` WHERE `EmailUtente` = '$emailChat' ORDER BY `TimeInvio` ASC";
        $queryResult = mysqli_query($this->connection, $query);
        if (mysqli_num_rows($queryResult) == 0) {
            //non ci sono messaggi
            return NULL;
        } else {
            //creo l'array da restituire con tutti i messaggi della chat
            $result = array();

            while ($row = mysqli_fetch_assoc($queryResult)) {
                array_push($result, $row);
            }

            return $result;
        }
    }

    //chiamabile solo se si e' admin. Restituisce la lista delle chat, o null se non ce ne sono
    public function getChatList()
    {
        $query = "SELECT `EmailUtente`, MAX(`TimeInvio`) AS `TimeInvio` FROM `Messaggi` GROUP BY `EmailUtente` ORDER BY `TimeInvio` DESC";
        $queryResult = mysqli_query($this->connection, $query);
        if (mysqli_num_rows($queryResult) == 0) {
            //non ci sono utenti che hanno iniziato una chat
            return NULL;
        } else {
            //qualcuno ha iniziato una chat, quindi restituisco un array con le chat
            $result = array();

            while ($row = mysqli_fetch_assoc($queryResult)) {
                array_push($result, $row);
            }

            return $result;
        }
    }

    //true o false se qualcuno ha prenotato una visita
    //DA MODIFICARE MAGARI METTENDO COME PARAMETRI UNA DATA (tipo se ci sono visite oggi, o da oggi in poi )
    public function ciSonoVisitePrenotate()
    {
        $query = "SELECT * FROM `Visite`;";
        return (mysqli_num_rows(mysqli_query($this->connection, $query)) > 0);
    }

    //se login avviene con successo ritorna l'email dell'utente, altrimenti false
    public function login($email, $password)
    {
        $password = sha1($password);
        $query = "SELECT `Email` FROM `Utenti` WHERE `Email`='$email' and `Password`='$password'";
        $queryResult = mysqli_query($this->connection, $query);
        //echo $query;
        return (mysqli_num_rows($queryResult) == 1) ? mysqli_fetch_assoc($queryResult)['Email'] : false;
    }

    //ritorna true se la registrazione è andata a buon fine, false altrimenti
    public function registrazioneUtente($email, $nome, $cognome, $telefono, $password)
    {
        $password = sha1($password);
        $query = "INSERT INTO `Utenti` (`Email`, `Nome`, `Cognome`, `Telefono`, `Password`) VALUES ('$email', '$nome', '$cognome', '$telefono', '$password');";
        //echo $query;
        $queryResult = mysqli_query($this->connection, $query);
        //controllo che sia stata inserita solo una riga
        return (mysqli_affected_rows($this->connection) == 1);
    }

    //ritorna true se è già presente un account con l'email data, false altrimenti
    public function emailGiaEsistente($email)
    {
        $query = "SELECT true FROM `Utenti` WHERE `Email`='$email'";
        $queryResult = mysqli_query($this->connection, $query);
        //echo $query;
        return (mysqli_num_rows($queryResult) == 1);
    }

    //ritorna true se è stata eliminata la notizia, false altrimenti
    public function eliminaNotizia($idNotizia)
    {
        $query = "DELETE FROM `Notizie` WHERE `Notizie`.`id` = $idNotizia";
        $queryResult = mysqli_query($this->connection, $query);
        return (mysqli_affected_rows($this->connection) == 1);
    }

    //ritorna tutte le informazioni di una notizia dato l'id della stessa, false se non è presente una notizia con quel id
    public function getNotiziaDaModificare($idNotizia)
    {
        $query = "SELECT * FROM `Notizie` WHERE `Notizie`.`id`=$idNotizia;";
        $queryResult = mysqli_query($this->connection, $query);

        //controllo abbia restituito una sola notizia
        if (mysqli_num_rows($queryResult) == 1) {
            return mysqli_fetch_assoc($queryResult);
        } else {
            return false;
        }
    }

    //ritorna true se la notizia è stata modificata, false altrimnti
    public function modificaNotizia($idNotizia, $titoloNotizia, $contenutoNotizia)
    {
        //la data viene aggioirnata ad oggi, giorno della modifica
        $query = "UPDATE `Notizie` SET `Titolo` = ' " . mysqli_real_escape_string($this->connection, $titoloNotizia) . "',`Data` =  CURRENT_DATE(),`Contenuto` = '" . mysqli_real_escape_string($this->connection, $contenutoNotizia) . "'  WHERE `Notizie`.`id` = $idNotizia;";
        $queryResult = mysqli_query($this->connection, $query);
        return (mysqli_affected_rows($this->connection) == 1);
    }

    //ritorna true se la notizia è stata aggiunta, false altrimnti
    public function aggiungiNotizia($titoloNotizia, $contenutoNotizia)
    {
        //la data viene impostata in automatico ad oggi
        $query = "INSERT INTO `Notizie` (`Data`, `Titolo`, `Contenuto`) VALUES (CURRENT_DATE(), '" . mysqli_real_escape_string($this->connection, $titoloNotizia) . "', '" . mysqli_real_escape_string($this->connection, $contenutoNotizia) . "');";
        $queryResult = mysqli_query($this->connection, $query);
        return (mysqli_affected_rows($this->connection) == 1);
    }

    //ritorna la lista delle prenotazioni per la data selezionata, null se non dovessero esserci
    public function controllaDisponibilita($giorno, $mese, $anno)
    {
        $data = "$anno-$mese-$giorno";
        $query = "SELECT HOUR(`Ora`) AS `Ora` FROM `Visite` WHERE `Giorno`='$data';";
        $queryResult = mysqli_query($this->connection, $query);

        if (mysqli_num_rows($queryResult) == 0) {
            //non ci sono visite prenotate il quel gionro
            return NULL;
        } else {
            //ci sono visite già prenotate
            //creo array con gli orari non più disponibili
            $result = array();

            while ($row = mysqli_fetch_assoc($queryResult)) {
                $result[] = ['ora' => $row['Ora'], 'disponibilita' => false];
            }

            return $result;
        }
    }

    //return true se la visita è stata prenotata, false altrimenti
    public function prenotaVisita($emailUtente, $giorno, $mese, $anno, $ora, $tipoVisita)
    {
        $data = "$anno-$mese-$giorno";
        $query = "INSERT INTO `Visite` (`Giorno`, `Ora`, `Tipologia`, `EmailUtente`) VALUES ('$data','$ora','$tipoVisita','$emailUtente');";
        $queryResult = mysqli_query($this->connection, $query);
        return (mysqli_affected_rows($this->connection) == 1);
    }
}
