<?php
session_start();

if(isset($_SESSION['emailUtente'])){
    header ( "location: index.php");
}

if (isset($_POST ['email']) && isset($_POST ['password']) && $_POST ['email']!="" && $_POST ['password']!="" ){
    include ("databaseconnection.php");
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query="SELECT `Email` FROM `Utenti` WHERE `Email`='$email' and `Password`='$password'";
    //echo $query;
    $result=$mysqli->query($query);
    //print_r($result);
    if($result->num_rows>0) {
        // loggatto corettamente
        $dati=$result->fetch_assoc();
        //print_r($dati);
        $_SESSION['emailUtente']=$dati['Email'];
        //echo $_SESSION['emailUtente'];
        if($_SESSION['emailUtente']=="admin@admin.com")
            $_SESSION['isAdmin']=true;
        else
            $_SESSION['isAdmin']=false;
        header ( "location: index.php" );
    } else {
        // credenziali errate
        header ( "location: accedi.php?errore=credenziali_errate" );
    }
}else{
    header ( "location: accedi.php?errore=campi_vuoti" );
}
?>
