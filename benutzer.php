<?php
$verbindung = mysql_connect("localhost", "root" , "")
or die("Verbindung zur Datenbank konnte nicht hergestellt werden");

mysql_select_db("kalorienzaehlerdb") or die ("Datenbank konnte nicht ausgewählt werden");

$ID = $_POST["ID"];
$passwort = $_POST["passwort"];
$passwort2 = $_POST["passwort2"];
$vorname = $_POST["vorname"];
$nachname = $_POST["nachname"];

if($passwort != $passwort2 OR $ID == "" OR $passwort == "")
{
	echo "Eingabefehler. Bitte alle Felder korekt ausfüllen. <a href=\"benutzer.html\">Zurück</a>";
	exit;
}

$passwort = $_POST['passwort'];
$salt_str = 'musta126';
 
$gesaltetes_passwort = md5($salt_str . $passwort);



$result = mysql_query("SELECT ID FROM benutzerlogin WHERE ID LIKE '$ID'");
$menge = mysql_num_rows($result);

if($menge == 0)
{
	$eintrag = "INSERT INTO benutzerlogin (ID, passwort, vorname, nachname) VALUES ('$ID', '$passwort', '$vorname', '$nachname')";
	$eintragen = mysql_query($eintrag);

	if($eintragen == true)
	{
		echo "Benutzername <b>$ID</b> wurde erstellt. <a href=\"login.html\">Login</a>";
	}
	else
	{
		echo "Fehler beim Speichern des Benutzernames. <a href=\"benutzer.html\">Zurück</a>";
	}


}

else
{
	echo "Benutzername schon vorhanden. <a href=\"benutzer.html\">Zurück</a>";
}
?>
