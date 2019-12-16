<?php
require_once("credenzialiDatabase.php");

class DBAccess
{
    const HOST_DB = servername_db;
    const USERNAME = username_db;
    const PASSWORD = password_db;
    const DATABASE_NAME = dbname_db;

    public $connection = NULL;

    function __destruct()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }

    public function openDBConnection()
    {
        $this->connection = mysqli_connect(static::HOST_DB, static::USERNAME, static::PASSWORD, static::DATABASE_NAME);

        if (!$this->connection)
            return false;
        else
            return true;
    }

    public function getNotizie()
    {
        $query = "SELECT * FROM `Notizie` ORDER BY `Data` DESC;";
        $queryResult = mysqli_query($this->connection, $query);

        if (mysqli_num_rows($queryResult) == 0) {
            return NULL;
        } else {
            $result = array();

            while ($row = mysqli_fetch_assoc($queryResult)) {
                array_push($result, $row);
            }

            return $result;
        }
    }

    public function inserisciMessaggioChat($email, $nuovoMessaggio, $isAdmin)
    {
        $query = "INSERT INTO `Messaggi` (`EmailUtente`, `TimeInvio`, `Messaggio`, `IsDottore`) VALUES ('$email', CURRENT_TIMESTAMP, '" . mysqli_real_escape_string($this->connection, $nuovoMessaggio) . "', $isAdmin);";
        return mysqli_query($this->connection, $query);
    }

    public function getMessaggiChat($emailChat)
    {
        $query = "SELECT * FROM `Messaggi` WHERE `EmailUtente` = '$emailChat' ORDER BY `TimeInvio` ASC";
        $queryResult = mysqli_query($this->connection, $query);
        if (mysqli_num_rows($queryResult) == 0) {
            return NULL;
        } else {
            $result = array();

            while ($row = mysqli_fetch_assoc($queryResult)) {
                array_push($result, $row);
            }

            return $result;
        }
    }

    public function getChatList()
    {
        $query = "SELECT `EmailUtente`, MAX(`TimeInvio`) AS `TimeInvio` FROM `Messaggi` GROUP BY `EmailUtente` ORDER BY `TimeInvio` DESC";
        $queryResult = mysqli_query($this->connection, $query);
        if (mysqli_num_rows($queryResult) == 0) {
            return NULL;
        } else {
            $result = array();

            while ($row = mysqli_fetch_assoc($queryResult)) {
                array_push($result, $row);
            }

            return $result;
        }
    }

    public function ciSonoVisitePrenotate()
    {
        $query = "SELECT * FROM `Visite`;";
        return (mysqli_num_rows(mysqli_query($this->connection, $query)) > 0);
    }

    public function login($email, $password)
    {
        $password = sha1($password);
        $query = "SELECT `Email` FROM `Utenti` WHERE `Email`='$email' and `Password`='$password'";
        $queryResult = mysqli_query($this->connection, $query);
        //echo $query;
        return (mysqli_num_rows($queryResult) == 1) ? mysqli_fetch_assoc($queryResult)['Email'] : false;
    }

    public function registrazioneUtente($email, $nome, $cognome, $telefono, $password)
    {
        $password = sha1($password);
        $query = "INSERT INTO `Utenti` (`Email`, `Nome`, `Cognome`, `Telefono`, `Password`) VALUES ('$email', '$nome', '$cognome', '$telefono', '$password');";
        //echo $query;
        $queryResult = mysqli_query($this->connection, $query);
        return (mysqli_affected_rows($this->connection) == 1);
    }

    public function emailGiaEsistente($email)
    {
        $query = "SELECT true FROM `Utenti` WHERE `Email`='$email'";
        $queryResult = mysqli_query($this->connection, $query);
        //echo $query;
        return (mysqli_num_rows($queryResult) == 1);
    }

    public function eliminaNotizia($idNotizia)
    {
        $query = "DELETE FROM `Notizie` WHERE `Notizie`.`id` = $idNotizia";
        $queryResult = mysqli_query($this->connection, $query);
        return (mysqli_affected_rows($this->connection) == 1);
    }

    public function getNotiziaDaModificare($idNotizia)
    {
        $query = "SELECT * FROM `Notizie` WHERE `Notizie`.`id`=$idNotizia;";
        $queryResult = mysqli_query($this->connection, $query);

        if (mysqli_num_rows($queryResult) == 1) {
            return mysqli_fetch_assoc($queryResult);
        } else {
            return false;
        }
    }

    public function modificaNotizia($idNotizia, $titoloNotizia, $contenutoNotizia)
    {
        $query = "UPDATE `Notizie` SET `Titolo` = ' " . mysqli_real_escape_string($this->connection, $titoloNotizia) . "',`Data` =  CURRENT_DATE(),`Contenuto` = '" . mysqli_real_escape_string($this->connection, $contenutoNotizia) . "'  WHERE `Notizie`.`id` = $idNotizia;";
        $queryResult = mysqli_query($this->connection, $query);
        return (mysqli_affected_rows($this->connection) == 1);
    }

    public function aggiungiNotizia($titoloNotizia, $contenutoNotizia)
    {
        $query = "INSERT INTO `Notizie` (`Data`, `Titolo`, `Contenuto`) VALUES (CURRENT_DATE(), '" . mysqli_real_escape_string($this->connection, $titoloNotizia) . "', '" . mysqli_real_escape_string($this->connection, $contenutoNotizia) . "');";
        $queryResult = mysqli_query($this->connection, $query);
        return (mysqli_affected_rows($this->connection) == 1);
    }

    public function controllaDisponibilita($giorno, $mese, $anno, $tipoVisita)
    {
        $data = "$anno-$mese-$giorno";
        $query = "SELECT HOUR(`Ora`) AS `Ora` FROM `Visite` WHERE `Giorno`='$data' AND `Tipologia`='$tipoVisita';";
        $queryResult = mysqli_query($this->connection, $query);
        if (mysqli_num_rows($queryResult) == 0) {
            return NULL;
        } else {
            $result = array();

            while ($row = mysqli_fetch_assoc($queryResult)) {
                $result[] = ['ora' => $row['Ora'], 'disponibilita' => false];
            }

            return $result;
        }
    }

    public function prenotaVisita($emailUtente, $giorno, $mese, $anno, $ora, $tipoVisita)
    {
        $data = "$anno-$mese-$giorno";
        $query = "INSERT INTO `Visite` (`Giorno`, `Ora`, `Tipologia`, `EmailUtente`) VALUES ('$data','$ora','$tipoVisita','$emailUtente');";
        $queryResult = mysqli_query($this->connection, $query);
        return (mysqli_affected_rows($this->connection) == 1);
    }
}
