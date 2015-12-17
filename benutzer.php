<?php
include "navigation.php";
?>
<html>
    <head>
        <title>Registrieren</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  
    </head>
    
    <BODY>
 
   </BODY>
  
     <div class="container" style="background: navajowhite;">
    <form class="form-signin" action="benutzer.php" method="post">
        
            <h2>Registrierung</h2>
            Dein Username:<br>
            <input type="text" size="24" minlength="4" maxlength="50"
                   name="ID">
            <p> (mind. 4 Zeichen)</p>
            
            Dein Passwort:<br>
            <input type="password" size="24" minlength="12" maxlength="50" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                   name="passwort">
            <p> (mind. 12 Gro&szlig; und Kleinbuchstaben sowie Sonderzeichen und Ziffern) </p>
            Passwort wiederholen:<br>
            <input type="password" size="24" minlength="12" maxlength="50" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                   name="passwort2"><br><br>
            Vorname:<br>
            <input type="text" size="24" maxlength="50"
                   name="vorname"><br><br>
            Nachname:<br>
            <input type="text" size="24" maxlength="50"
                   name="nachname"><br><br>
            <input type="submit" name="submit" value="Anmelden" class="btn btn-success">
            </form>
        </div>
</html>


<?php
session_start();
?>

<?php
include "mysql.php";

$connection = new createCon();
$connection->connect();


$ID = filter_input(INPUT_POST, "ID");
$_SESSION['ID'] = $ID;

$abfrage = "SELECT ID FROM benutzerlogin WHERE ID LIKE '$ID'";
$result = mysqli_query($connection->myconn, $abfrage);
$anzahl = mysqli_num_rows($result);

if (isset($_POST['submit'])) {
    $passwort = filter_input(INPUT_POST, "passwort");
    $passwort2 = filter_input(INPUT_POST, "passwort2");
    $vorname = filter_input(INPUT_POST, "vorname");
    $nachname = filter_input(INPUT_POST, "nachname");

    $secret_salt = $ID;
    $salted_password = $secret_salt . $passwort;
    $password_hash = hash('sha512', $salted_password);

    if (empty($ID) || empty($passwort) || empty($passwort2) || empty($vorname) || empty($nachname)) {
        die('You did not fill out the required fields');
    }
    if ($passwort != $passwort2) {
        die('Passwort stimmt nicht überein!');
    }

    if ($anzahl == 0) {
        $eintrag = "INSERT INTO benutzerlogin (ID, passwort, vorname, nachname) VALUES ('$ID', '$password_hash', '$vorname', '$nachname')";
        $eintragen = mysqli_query($connection->myconn, $eintrag);

        if ($eintragen == true) {
            header('Location: makros.php');
        } else {
            echo "Fehler beim Speichern des Benutzernames. <a href=\"benutzer.html\">Zurück</a>";
        }
    }
}
?>
