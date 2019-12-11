<?php

class DBAccess
{
    const HOST_DB = 'localhost';
    const USERNAME = 'dottmarcodonati';
    const PASSWORD = 'Admin123';
    const DATABASE_NAME = 'dbDottMarcoDonati';

    public $connection = null;

    function __destruct() {
        if($this->connection){
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
        $query = "SELECT * FROM `Notizie` ORDER BY `Data`;";
        $queryResult = mysqli_query($this->connection, $query);

        if (mysqli_num_rows($queryResult) == 0) {
            return null;
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
        $query = "INSERT INTO `Messaggi` (`EmailUtente`, `TimeInvio`, `Messaggio`, `IsDottore`) VALUES ('$email', CURRENT_TIMESTAMP, '$nuovoMessaggio', $isAdmin);";
        return mysqli_query($this->connection, $query);
    }

    public function getMessaggiChat($emailChat)
    {
        $query = "SELECT * FROM `Messaggi` WHERE `EmailUtente` = '$emailChat' ORDER BY `TimeInvio` ASC";
        $queryResult = mysqli_query($this->connection, $query);
        $result = array();

        while ($row = mysqli_fetch_assoc($queryResult)) {
            array_push($result, $row);
        }

        return $result;
    }
}
