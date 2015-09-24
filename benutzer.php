<?php
$verbindung = mysql_connect("localhost", "root" , "")
or die("Verbindung zur Datenbank konnte nicht hergestellt werden");

mysql_select_db("kalorienzaehlerdb") or die ("Datenbank konnte nicht ausgewählt werden");

$ID = $_POST["ID"];
$passwort = $_POST["passwort"];
$passwort2 = $_POST["passwort2"];

if($passwort != $passwort2 OR $ID == "" OR $passwort == "")
{
	echo "Eingabefehler. Bitte alle Felder korekt ausfüllen. <a href=\"eintragen.html\">Zurück</a>";
	exit;
}
$passwort = md5($passwort);

$result = mysql_query("SELECT ID FROM benutzerlogin WHERE ID LIKE '$ID'");
$menge = mysql_num_rows($result);

if($menge == 0)
{
	$eintrag = "INSERT INTO benutzerlogin (ID, passwort) VALUES ('$ID', '$passwort')";
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