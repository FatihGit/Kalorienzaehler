<?php
include "navigation.php";
?>
<html>
    <head>
        <title>Meine Daten</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  
    </head>	
    
    
    
    
<?php
session_start();
?>
<?php


include "mysql.php";

$connection = new createCon();
$connection->connect();


if(!isset($_SESSION['ID'])){
        echo "bitte alles ausfüllen!";
        header("Location: index.php");
    }

$ID = $_SESSION['ID'];
     
  $abfrage="SELECT * FROM benutzer WHERE B_ID LIKE '$ID'";
$result = mysqli_query($connection->myconn, $abfrage);
while($row = mysqli_fetch_array($result))
{
	$gewicht = $row['gewicht'];
        $training = $row['training'];
        $ziel=$row['ziel'];

}


if (isset($_POST['aktualisieren'])) {


$gewicht = filter_input(INPUT_POST, "gewicht");
$training = filter_input(INPUT_POST, "training");
$ziel = filter_input(INPUT_POST, "ziel");

if (empty($ID) || empty($gewicht) || empty($training) || empty($ziel)) {
        header('Location: daten.php');
        die ('Bitte füllen Sie alle Felder aus!');
        
    }
    if($gewicht<0){
       die ('Gewicht darf nicht negativ sein');
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

        $sql = "UPDATE benutzer set gewicht='$gewicht', training='$training', ziel='$ziel' where B_ID='$ID'";
        $sql2 = "UPDATE makros set Kalorien='$kalorien', Eiweiss='$eiweiss', Kohlenhydrate='$kohlenhydrate', Fett='$fett' where m_id='$ID'";
        $eintragen = mysqli_query($connection->myconn, $sql);
        $eintragen2 = mysqli_query($connection->myconn, $sql2);
        if ($eintragen == true && $eintragen2 == true)
        {
            echo "Kalorien für  <b>$ID</b> werden berechnet. <a href=\"anzeige3.php\">Zu den Kalorien</a>";
        } 
        else 
            {
            echo "Fehler beim Speichern";
        }
    
   
}


?>
     <div class="container" style="background: navajowhite;">
<form class="form-signin" action="daten.php" method="post">
        <h2>Meine Daten</h2>
        Deine ID<br>
        <?php
       
        echo "" . $_SESSION['ID'];
        ?> <br><br>
        Dein Gewicht<br>
        <input type="number" 
               name="gewicht" value=<?php echo $gewicht;?>><br><br>
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
        Muskelaufbau <input type="radio" value="m" name="ziel">
        Fettabbau <input type="radio" value="f" name="ziel"><br>    
        <input type="submit" name="aktualisieren" value="aktualisieren">
    </form>
          </div>
</html>
<?php

?>