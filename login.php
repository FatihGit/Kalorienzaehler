<?php 
session_start(); 
?> 

<?php 
$verbindung = mysql_connect("localhost", "root" , "") 
or die("Verbindung zur Datenbank konnte nicht hergestellt werden"); 
mysql_select_db("kalorienzaehlerdb") or die ("Datenbank konnte nicht ausgewählt werden"); 

$ID = $_POST["ID"]; 
$passwort = $_POST["passwort"]; 

$abfrage = "SELECT ID, passwort FROM benutzerlogin WHERE ID LIKE '$ID' LIMIT 1"; 
$ergebnis = mysql_query($abfrage); 
$row = mysql_fetch_object($ergebnis); 

if($row->passwort == $passwort) 
    { 
    $_SESSION["ID"] = $ID; 
    echo "Login erfolgreich. <br> <a href=\"benutzer2.html\">Geschützer Bereich</a>"; 
    } 
else 
    { 
    echo "Benutzername und/oder Passwort waren falsch. <a href=\"login.html\">Login</a>"; 
    } 

?>