
<?php
include "navigation.php";
?>
<html>
    <HEAD>
      <TITLE>Login</TITLE>
      
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   </HEAD>
    
    <BODY>

   </BODY>
     <div class="container">
    <form class="form-signin" action="index.php" method="post">
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
$passwort = filter_input(INPUT_POST, "passwort");


    $secret_salt = $ID;
    $salted_password = $secret_salt . $passwort;
    $password_hash = hash('sha512', $salted_password);

$abfrage = "SELECT ID, passwort FROM benutzerlogin WHERE ID LIKE '$ID' LIMIT 1";
$ergebnis = mysqli_query($connection->myconn, $abfrage);
$row = mysqli_fetch_object($ergebnis);

if (isset($_POST['Submit'])) {

    if (!empty($ID) && !empty($passwort )) {
        

        if ($row == true && $row->passwort == $password_hash) {
            
            $_SESSION["ID"] = $ID;
            header('Location: anzeige3.php');
        } else {
            echo "Benutzername und/oder Passwort waren falsch. <a href=\"login.html\">Login</a>";
        }
                
    } else {
        echo "Bitte Benutzername und Passwort eingeben";
    }
}
/*
mysqli_close($connection);
 * s
 */
?>



