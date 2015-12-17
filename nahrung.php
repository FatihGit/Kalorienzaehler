<?php
include "navigation.php";
?>
<html>
    <head>
        <title>Nahrung</title>
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

    if (!isset($_SESSION['ID'])) {
        header("Location: index.php");
    }


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
    $ID = $_SESSION['ID'];
    $bez = filter_input(INPUT_POST, "bez");

    $abfrage = "SELECT bez FROM nahrung WHERE bez LIKE '$bez'";
    $result = mysqli_query($connection->myconn, $abfrage);
    $anzahl = mysqli_num_rows($result);
    $kalorien = 0;



    if (isset($_POST['berechnen'])) {
        $bez = filter_input(INPUT_POST, "bez");
        $eiweiss = filter_input(INPUT_POST, "eiweiss");
        $kohlenhydrate = filter_input(INPUT_POST, "kohlenhydrate");
        $fett = filter_input(INPUT_POST, "fett");
        $menge = 100;

        $kalorien = ($eiweiss * 4) + ($kohlenhydrate * 4) + ($fett * 9);
        if (empty($bez) || empty($kalorien) || empty($eiweiss) || empty($kohlenhydrate) || empty($fett)) {
            echo ('SIe müssen alle Felder ausfüllen!');
            if($kalorien==0){
                echo ("Bitte zuerst die Kalorien aktualisieren");
            }
        }
    }
    if (isset($_POST['Submit'])) {
        
        $bez = filter_input(INPUT_POST, "bez");
        $kalorien = filter_input(INPUT_POST, "kalorien");
        $eiweiss = filter_input(INPUT_POST, "eiweiss");
        $kohlenhydrate = filter_input(INPUT_POST, "kohlenhydrate");
        $fett = filter_input(INPUT_POST, "fett");
        $menge = 100;

        if (empty($bez) || empty($kalorien) || empty($eiweiss) || empty($kohlenhydrate) || empty($fett)) {
            echo ('SIe müssen alle Felder ausfüllen!');
        }
        else
        {
            if(!isset($_POST['berechnen'])){
            echo "bitte zuerst die Kalroien aktualisieren";
        }
        if ($anzahl == 0) {
            $eintrag = "INSERT INTO nahrungen (bez, kalorien, eiweiss, kohlenhydrate, fett, menge) VALUES ('$bez', '$kalorien', '$eiweiss', '$kohlenhydrate', '$fett', '$menge')";
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
    }
    ?>
    <div class="container" style="background: navajowhite;">
        <form class="form-signin" action="nahrung.php" method="post">
            <h2>Nahrung hinzufügen</h2>
            Nahrungsbezeichung<br>
            <input type="text" size="24" maxlength="50"
                   name="bez" value=
                   <?php
                   if (isset($_POST['bez'])) {
                       echo $_POST['bez'];
                   }
                   ?>><br><br>
            Kalorien<br>
            <?php echo $kalorien; ?>
            Eiweiß<br>
            <input type="number" size="24" maxlength="50"
                   name="eiweiss" step="any" value=
                   <?php
                   if (isset($_POST['eiweiss'])) {
                       echo $_POST['eiweiss'];
                   }
                   ?>><br><br>
            Kohlenhydrate:<br>
            <input type="number" size="24" maxlength="50"
                   name="kohlenhydrate" step="any" value=
                   <?php
                   if (isset($_POST['kohlenhydrate'])) {
                       echo $_POST['kohlenhydrate'];
                   }
                   ?>><br><br>
            Fett:<br>
            <input type="number" size="24" maxlength="50"
                   name="fett" step="any" value=
                   <?php
                   if (isset($_POST['fett'])) {
                       echo $_POST['fett'];
                   }
                   ?>><br><br>
            Menge in g:<br>
            100<br><br>
            <input type="submit" name="berechnen" value="Kalorien berechnen">
            <input type="submit" name="Submit" value="Hinzufügen">
            <input type="hidden" size="24" maxlength="50"
                   name="kalorien" step="any" value=
                   <?php echo $kalorien; ?>><br><br>

        </form>
    </div>
</html>