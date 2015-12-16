<?php
include "navigation.php";
?>
<?php
//including the database connection file
include "mysql.php";

$connection = new createCon();
$connection->connect();

//getting id of the data from url
if(isset($_GET['nid']))
{
    $nid = $_GET['nid'];    
}
else
{
    echo "nid nicht gesetzt";
}
    

$abfrage="DELETE FROM nahrung WHERE n_ID='$nid'  ";
//deleting the row from table
$result = mysqli_query($connection->myconn, $abfrage);

header("Location:anzeige3.php");

//redirecting to the display page (index.php in our case)
?>

