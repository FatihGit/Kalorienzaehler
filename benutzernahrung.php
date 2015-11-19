<html>
    <head>
        <title>Nahrung</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>	
    <form action="nahrung.php" method="post">
        <h2>Nahrung hinzufügen</h2>
        Nahrungsbezeichung<br>
        <input type="text" size="24" maxlength="50"
               name="bez"><br><br>
        Kalorien<br>
        <input type="number" size="24" maxlength="50"
               name="kalorien"><br><br>
        Eiweiß<br>
        <input type="number" size="24" maxlength="50"
               name="eiweiss"><br><br>
        Kohlenhydrate:<br>
        <input type="number" size="24" maxlength="50"
               name="kohlenhydrate"><br><br>
        Fett:<br>
        <input type="number" step="any" size="24" maxlength="50"
               name="fett"><br><br>
        Menge in g:<br>
        100<br><br>
        <input type="submit" name="Submit" value="Hinzufügen">
    </form>
</html>

<?php
session_start();
?>

<?php
include "mysql.php";

$connection = new createCon();
$connection->connect();

$ID = $_SESSION['ID'];
$bez = filter_input(INPUT_POST, "bez");
$kalorien = filter_input(INPUT_POST, "kalorien");
$eiweiss = filter_input(INPUT_POST, "eiweiss");
$kohlenhydrate = filter_input(INPUT_POST, "kohlenhydrate");
$fett = filter_input(INPUT_POST, "fett");
$menge = 100;

/*
  if($passwort != $passwort2 OR $ID == "" OR $passwort == "")
  {
  echo "Eingabefehler. Bitte alle Felder korekt ausfüllen. <a href=\"benutzer.html\">Zurück</a>";
  exit;
  }
 */

/*
  $passwort = $_POST['passwort'];
  $salt_str = 'musta126';

 */

/*
  $gesaltetes_passwort = md5($salt_str . $passwort);
 * 
 */

/*
$abfrage="SELECT ID FROM benutzerlogin WHERE ID LIKE '$ID'";
$result = mysqli_query($connection->myconn, $abfrage);
$menge = mysqli_num_rows($result);
 * 
 */
$abfrage="SELECT bez FROM nahrung WHERE bez LIKE '$bez'";
$result = mysqli_query($connection->myconn, $abfrage);
$anzahl = mysqli_num_rows($result);
if (isset($_POST['Submit'])) 

{
    if ($anzahl == 0) {
        $eintrag = "INSERT INTO nahrung (bez, kalorien, eiweiss, kohlenhydrate, fett, menge) VALUES ('$bez', '$kalorien', '$eiweiss', '$kohlenhydrate', '$fett', '$menge')";
        $eintragen = mysqli_query($connection->myconn, $eintrag);

        if ($eintragen == true) {
            header('Location: anzeige3.php');
        } else {
            echo "Fehler beim Speichern der Nahrung. <a href=\"nahrung.php\">Zurück</a>";
        }
        } else {
         echo "Nahrung schon vorhanden. <a href=\"nahrung.php\">Zurück</a>";
    }
}
?>
