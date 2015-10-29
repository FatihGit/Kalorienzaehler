<html>
    <head>
        <title>Kalorienberechnung</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>	
    <form action="kalorienberechnung.php" method="post">
        <h2>Kalorien berechnen</h2>

        Deine ID<br>
        <?php
        session_start();
        echo "" . $_SESSION['ID'];
        ?> <br><br>
        Dein Gewicht<br>
        <input type="number" size="24" maxlength="50"
               name="gewicht"><br><br>
        Training/Woche<br>
        <select name="training">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
        </select>
        <br><br>
        Ziel:<br>
        Muskelaufbau<input type="radio" value="m" name="ziel">
        Fettabbau<input type="radio" value="f" name="ziel"><br>    
        <input type="submit" value="Berechnen">
    </form>
</html>


<?php
$verbindung = mysql_connect("localhost", "root", "")
        or die("Verbindung zur Datenbank konnte nicht hergestellt werden");

mysql_select_db("kalorienzaehlerdb") or die("Datenbank konnte nicht ausgewählt werden");


$ID = $_SESSION['ID'];
$gewicht = filter_input(INPUT_POST, "gewicht");
$training = filter_input(INPUT_POST, "training");
$ziel = filter_input(INPUT_POST, "ziel");


if ($ziel == 'm') {
    $z = 500;
    $e = 2;
    $f = 1;
} else {
    $z = -500;
    $e = 2.5;
    $f = 0.6;
}
$kalorien = ($gewicht * 30) + $z + ($training*100);
$eiweiss = $gewicht * $e;
$fett = $gewicht * $f;
$kohlenhydrate = ($kalorien - ($eiweiss * 4) - ($fett * 9)) / 4;

$result = mysql_query("SELECT B_ID FROM benutzer WHERE B_ID LIKE '$ID'");
$menge = mysql_num_rows($result);

if ($menge == 0) {
    if (!empty($gewicht) && !empty($training) && !empty($ziel)) {
        $sql = "INSERT INTO benutzer (B_ID, gewicht, training, ziel) VALUES ('$ID', '$gewicht', '$training', '$ziel');";
        $sql2 = "INSERT INTO kalorien (k_id, Kalorien, Eiweiss, Kohlenhydrate, Fett) VALUES ('$ID', '$kalorien', '$eiweiss', '$kohlenhydrate', '$fett');";
        $eintragen = mysql_query($sql);
        $eintragen2 = mysql_query($sql2);

        if ($eintragen == true && $eintragen2 == true) {
            echo "Kalorien für  <b>$ID</b> werden berechnet. <a href=\"anzeige.php\">Zu den Kalorien</a>";
        } else {
            echo "Fehler beim Speichern des Benutzernamens. <a href=\"benutzer.html\">Zurück</a>";
        }
    }
} else {
    echo "Benutzername schon vorhanden. <a href=\"benutzer.html\">Zurück</a>";
}
?>
