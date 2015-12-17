


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
        session_start();
     ?>
<?php


//getting id from url
if(isset($_GET['nid']))
{
    $nid = $_GET['nid'];    
    
}
else
{
    echo "nid nicht gesetzt";
}
   

$abfrage="SELECT * FROM nahrung WHERE n_id='$nid'";
//selecting data associated with this particular id
$result = mysqli_query($connection->myconn,$abfrage);


while($row = mysqli_fetch_array($result))
{
        $bez=$row['bez'];
	$menge = $row['menge'];
        $kalorien = $row['kalorien']/$menge;
        $eiweiss = $row['eiweiss']/$menge;
        $kohlenhydrate = $row['kohlenhydrate']/$menge;
        $fett = $row['fett']/$menge;

}
   
if(isset($_POST['update']))
{	
    
      
      $ID = $_SESSION['ID'];
      $nid2 = filter_input(INPUT_POST, "nid2");
      $bez2 = filter_input(INPUT_POST, "bez2");
      $menge = filter_input(INPUT_POST, "menge");
      $eiweiss = filter_input(INPUT_POST, "eiweiss")*$menge;
      $kohlenhydrate = filter_input(INPUT_POST, "kohlenhydrate")*$menge;
      $fett = filter_input(INPUT_POST, "fett")*$menge;

      
      $kalorien = ($eiweiss*4)+($kohlenhydrate*4)+($fett*9);
      
      
     
      $e=($kalorien/$menge)*$menge;
      $kh=($kalorien/$menge)*$menge;
      
      
      
	// checking empty fields
	if(empty($menge)) {	
			
            echo "<font color='red'>Menge field is empty.</font><br/>";
			
	} else {	
                $abfrage2= "UPDATE nahrung SET menge='$menge', kalorien='$kalorien', eiweiss='$eiweiss', kohlenhydrate='$kohlenhydrate', fett='$fett' where n_id='$nid2' AND n_b_id='$ID'";
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
                                <?php echo "" . $_SESSION['ID']; ?>
                                
                            </td>
                        </tr>
                        <tr>
				<td>Menge</td>
                                <td>
                                    <input type="hidden" name="nid2" value=<?php echo '"'.$nid.'"';?>/>
                                    <input type="hidden" name="bez2" value=<?php echo '"'.$bez.'"';?>/>
                                    <td><input type="hidden" name="kalorien" value=<?php echo $kalorien;?>>
                                        <td><input type="hidden" name="eiweiss" value=<?php echo $eiweiss;?>/>
                                            <td><input type="hidden" name="kohlenhydrate" value=<?php echo $kohlenhydrate;?>/>
                                                <td><input type="hidden" name="fett" value=<?php echo '"' .$fett. '"';?> />
                                                
                                <input type="number" name="menge" value=<?php echo $menge;?>></td>
			</tr>
                       
			<tr>
				<td><input type="submit" name="update" value="update"></td>
			</tr>
                     
		</table>
	</form>
</body>
</html>
