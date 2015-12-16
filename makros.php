<?php
include "navigation.php";
?>
<html>
    <head>
        <title>Kalorienberechnung</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    </head>	    
    <form action="makros.php" method="post">
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
        <input type="submit" name="berechnen" value="Berechnen">
    </form>
</html>
<?php


include "mysql.php";

$connection = new createCon();
$connection->connect();

if(!isset($_SESSION['ID'])){
        header("Location: index.php");
    }
if (isset($_POST['berechnen'])) {

$ID = $_SESSION['ID'];
$gewicht = filter_input(INPUT_POST, "gewicht");
$training = filter_input(INPUT_POST, "training");
$ziel = filter_input(INPUT_POST, "ziel");

if (empty($ID) || empty($gewicht) || empty($training) || empty($ziel)) {
        die ('You did not fill out the required fields');
    }
    
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

$abfrage="SELECT B_ID FROM benutzer WHERE B_ID LIKE '$ID'";
$result = mysqli_query($connection->myconn, $abfrage);
$menge = mysqli_num_rows($result);
if ($menge == 0) {
        $sql = "INSERT INTO benutzer (B_ID, gewicht, training, ziel) VALUES ('$ID', '$gewicht', '$training', '$ziel');";
        $sql2 = "INSERT INTO makros (m_id, Kalorien, Eiweiss, Kohlenhydrate, Fett) VALUES ('$ID', '$kalorien', '$eiweiss', '$kohlenhydrate', '$fett');";
        $eintragen = mysqli_query($connection->myconn, $sql);
        $eintragen2 = mysqli_query($connection->myconn, $sql2);
        if ($eintragen == true && $eintragen2 == true) {
            echo "Kalorien für  <b>$ID</b> werden berechnet. <a href=\"anzeige3.php\">Zu den Kalorien</a>";
        } else {
            echo "Fehler beim Speichern des Benutzernamens. <a href=\"benutzer.html\">Zurück</a>";
        }
    }
    else {
    echo "Benutzername schon vorhanden. <a href=\"benutzer.html\">Zurück</a>";
} 
}

?>