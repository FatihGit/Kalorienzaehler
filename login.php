

<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>	
    <form action="login.php" method="post">
        <h2>Login</h2>
        Dein Username:<br>
        <input type="text" size="24" maxlength="50"
               name="ID"><br><br>

        Dein Passwort:<br>
        <input type="password" size="24" maxlength="50"
               name="passwort"><br><br>
        <br>
        <input type="submit" name="Submit" value="Login">

        <a href="benutzer.php" target="_blank">Registrieren</a>
    </form>
</html>

<?php


session_start();
?> 

<?php
$servername = "sql13.hostinger.de";
$username = "u659698584_ilyas";
$password = "ilyas1234";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>
<?php

/*
require_once 'mysqlcon.php';
*/
/*
$mysqli = new mysqli("localhost", "u659698584_ilyas", "ilyas1234", "u659698584_kalo");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";
*/


/*
$verbindung = mysql_connect("mysql.hostinger.de", "u659698584_ilyas", "ilyas1234")
        or die("Verbindung zur Datenbank konnte nicht hergestellt werden");
mysql_select_db("u659698584_kalo") or die("Datenbank konnte nicht ausgewählt werden");
*/
/*
Server=myServerAddress;Database=myDataBase;Uid=myUsername;Pwd=myPassword;
*/
$ID = filter_input(INPUT_POST, "ID");
$passwort = filter_input(INPUT_POST, "passwort");
$submit = filter_input(INPUT_POST, "submit");

$abfrage = "SELECT ID, passwort FROM benutzerlogin WHERE ID LIKE '$ID' LIMIT 1";
$ergebnis = mysql_query($abfrage);
$row = mysql_fetch_object($ergebnis);

if (isset($_POST['Submit'])) {

    if (!empty($ID) && !empty($passwort )) {
        if ($row == true && $row->passwort == $passwort) {
            $_SESSION["ID"] = $ID;
            echo 'Login erfolgreich <br> <a href="anzeige.php">Daten anzeigen</a>';
        } else {
            echo "Benutzername und/oder Passwort waren falsch. <a href=\"login.html\">Login</a>";
        }
    } else {
        echo "Bitte Benutzername und Passwort eingeben";
    }
}

?>



