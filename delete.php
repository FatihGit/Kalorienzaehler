<?php
//including the database connection file
include "mysql.php";

$connection = new createCon();
$connection->connect();

//getting id of the data from url
if(isset($_GET['bez']))
{
    $bez = $_GET['bez'];    
}
else
{
    echo "Bez nicht gesetzt";
}
    

$abfrage="DELETE FROM nahrung WHERE bez='$bez'";
//deleting the row from table
$result = mysqli_query($connection->myconn, $abfrage);

header("Location:anzeige3.php");

//redirecting to the display page (index.php in our case)
?>

