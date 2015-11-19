


<html>
<head>	
	<title>Edit Data</title>
</head>

<?php
// including the database connection file
include "mysql.php";

        $connection = new createCon();
        $connection->connect();
?>
<?php

//getting id from url
if(isset($_GET['bez']))
{
    $bez = $_GET['bez'];    
}
else
{
    echo "Bez nicht gesetzt";
}
   
$abfrage="SELECT * FROM nahrung WHERE bez='$bez'";
//selecting data associated with this particular id
$result = mysqli_query($connection->myconn,$abfrage);


while($row = mysqli_fetch_array($result))
{
	$menge = $row['menge'];
}
   
if(isset($_POST['update']))
{	
      
      
      $bez2 = filter_input(INPUT_POST, "bez2");
      $menge = filter_input(INPUT_POST, "menge");
	// checking empty fields
	if(empty($menge)) {	
			
            echo "<font color='red'>Menge field is empty.</font><br/>";
			
	} else {	
                $abfrage2= "UPDATE nahrung SET menge='$menge' where bez='$bez2'";
		$result2 = mysqli_query($connection->myconn, $abfrage2);
		if ($result2 == true) {
                    header('Location: anzeige3.php');
		//redirectig to the display page. In our case, it is index.php
                }
                else
                {
                    echo "Fehler beim Update. <a href=\"edit.php\"></a>";
                }
	}
}
?>
<body>
	<a href="anzeige3.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
                            <td>
                                <?php echo $bez; ?>
                            </td>
                        </tr>
                        <tr>
				<td>Menge</td>
                                <td><input type="hidden" name="bez2" value=<?php echo '"'.$bez.'"';?>/>
                                <input type="number" name="menge" value=<?php echo $menge;?>></td>
			</tr>
          
			<tr>
				<td><input type="submit" name="update" value="update"></td>
			</tr>
                     
		</table>
	</form>
</body>
</html>
