<html>
<head>	
	<title>Add Data</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
</head>

<?php
// including the database connection file
include "mysql.php";
        $connection = new createCon();
        $connection->connect();
?>
<?php
        session_start();
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
   
$abfrage="SELECT * FROM nahrungen WHERE bez='$bez'";
//selecting data associated with this particular id
$result = mysqli_query($connection->myconn,$abfrage);
$menge = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result))
{
	$menge = $row['menge'];
        $kalorien = $row['kalorien']/$menge;
        $eiweiss = $row['eiweiss']/$menge;
        $kohlenhydrate = $row['kohlenhydrate']/$menge;
        $fett = $row['fett']/$menge;
}


if ($menge != 0) {
         echo "Die Nahrung haben sie bereits geaddet. <a href=\"anzeige3..php\"></a>";
} else {
   
   
if(isset($_POST['insert']))
{	
    
      
      $ID = $_SESSION['ID'];
      $bez2 = filter_input(INPUT_POST, "bez2");
      $menge = filter_input(INPUT_POST, "menge");
      $eiweiss = filter_input(INPUT_POST, "eiweiss")*$menge;
      $kohlenhydrate = filter_input(INPUT_POST, "kohlenhydrate")*$menge;
      $fett = filter_input(INPUT_POST, "fett")*$menge;
      $datum = date("Y-m-d");
      
      $kalorien = ($eiweiss*4)+($kohlenhydrate*4)+($fett*9);
      
      
      
      
      
	// checking empty fields
	if(empty($menge)) {	
			
            echo "<font color='red'>Menge field is empty.</font><br/>";
			
	} else {	
                $abfrage2 = "INSERT INTO nahrung (n_b_id, bez, kalorien, eiweiss, kohlenhydrate, fett, menge, datum) VALUES ('$ID', '$bez2', '$kalorien', '$eiweiss', '$kohlenhydrate', '$fett', '$menge', '$datum')";
		$result2 = mysqli_query($connection->myconn, $abfrage2);
		if ($result2 == true) {
                    header('Location: anzeige3.php');
		//redirectig to the display page. In our case, it is index.php
                }
                else
                {
                    echo "Fehler beim Insert. <a href=\"add.php\"></a>";
                }
	}
}
}
?>
<body>
	<a href="anzeige3.php">Anzeige3</a>
	<br/><br/>
	
	<form name="form1" method="post" action="add.php">
		<table class='table'>
			<tr> 
                            <td>
                                <?php echo $bez; ?>
                                <?php echo "" . $_SESSION['ID']; ?>
                                
                            </td>
                        </tr>
                        <tr>
				<td>Menge</td>
                                <td>
                                    <input type="hidden" name="bez2" value=<?php echo '"'.$bez.'"';?>/>
                                    <td><input type="hidden" name="kalorien" value=<?php echo $kalorien;?>>
                                        <td><input type="hidden" name="eiweiss" value=<?php echo $eiweiss;?>/>
                                            <td><input type="hidden" name="kohlenhydrate" value=<?php echo $kohlenhydrate;?>/>
                                                <td><input type="hidden" name="fett" value=<?php echo '"' .$fett. '"';?> />
                                                
                                <input type="number" name="menge" value=<?php echo $menge;?>></td>
			</tr>
                       
			<tr>
				<td><input type="submit" name="insert" value="insert"></td>
			</tr>
                     
		</table>
	</form>
</body>
</html>