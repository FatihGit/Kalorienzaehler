<?php
include "navigation.php";
?>
<HTML>
   <HEAD>
      <TITLE>Anzeige</TITLE>
      
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  
      <link rel="stylesheet" href="table.css">
   </HEAD>
   <BODY>
   

   </BODY>
</form>
  </FORM>
</HTML>
<?php
        session_start();
?>


<?php
      include "mysql.php";

        $connection = new createCon();
        $connection->connect();
?>



<?php
    if(!isset($_SESSION['ID'])){
        header("Location: index.php");
    }

$ID = $_SESSION['ID'];

$abfrageK ="SELECT makros.Kalorien AS M, SUM(nahrung.kalorien) AS N, ROUND(((SUM(nahrung.kalorien)/makros.Kalorien)*100),0) AS Z FROM nahrung INNER JOIN makros ON nahrung.n_b_id=makros.m_ID WHERE n_b_id LIKE '$ID'"; 
$result5 = mysqli_query($connection->myconn, $abfrageK);

echo "<table class='table'>
<thead style='text-align:center'>
<th class='active'>Ziel</th>
<th class='active'>derzeit</th>
</thead>";

while($row3 = mysqli_fetch_array($result5))
{
echo "<tr>";
echo "<td>".$row3['M']."</td>";
echo "<td>".$row3['N']."</td>";
echo "</tr>";
echo "<tr>";
echo "<td  colspan='2'>".$row3['Z']."%</td>";
echo "</tr>";
}  
echo "</table><br>";
        

$abfrage = "SELECT * FROM makros WHERE m_id LIKE '$ID'";
$result = mysqli_query($connection->myconn, $abfrage);
echo "<table class='table'>
<tr class='active' '>
<th style='text-align:center'>Eiwei&szlig</th>
<th>Kohlenhydrate</th>
<th>Fett</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
    echo "Hallo " . $row['m_id'] . "<br>"  ."Ihre Kalorien betragen: " . $row['Kalorien'] ."<br><br>".
          "Die Makron&aumlhrstoffe sind:"."<br><br>";
       
    
echo "<tr>";
echo "<td>" . $row['Eiweiss'] . "</td>";
echo "<td>" . $row['Kohlenhydrate'] ."</td>";
echo "<td>" . $row['Fett'] ."</td>";
echo "</tr>";

}
$abfrageSUM ="SELECT ROUND(SUM(eiweiss),2) AS EW_SUM, ROUND(SUM(kohlenhydrate),2) AS KH_SUM, ROUND(SUM(fett),2) AS FETT_SUM FROM nahrung WHERE n_b_id LIKE '$ID'"; 
$result3 = mysqli_query($connection->myconn, $abfrageSUM);

while($row2 = mysqli_fetch_array($result3))
{
echo "<th>".$row2['EW_SUM']."</th>";
echo "<th>".$row2['KH_SUM']."</th>";
echo "<th>".$row2['FETT_SUM']."</th>";
echo "</tr>";
}
$abfrageP ="SELECT ROUND(((SUM(nahrung.eiweiss)/makros.Eiweiss)*100),0) AS E "
        . ", ROUND(((SUM(nahrung.kohlenhydrate)/makros.Kohlenhydrate)*100), 0) AS K,"
        . "ROUND(((SUM(nahrung.fett)/makros.FETT)*100),0) AS F FROM nahrung INNER JOIN makros ON nahrung.n_b_id=makros.m_ID WHERE n_b_id LIKE '$ID'"; 
$result4 = mysqli_query($connection->myconn, $abfrageP);

while($row3 = mysqli_fetch_array($result4))
{
echo "<th>".$row3['E']."%</th>";
echo "<th>".$row3['K']."%</th>";
echo "<th>".$row3['F']."%</th>";
echo "</table><br>";
}


$abfrage2 = "SELECT * FROM nahrung WHERE n_b_id LIKE '$ID'";
$result2 = mysqli_query($connection->myconn, $abfrage2);

echo 
          "Ihre Nahrungen sind:"."<br><br>";

echo "<table class='table'>
<tr class='active'>
<th>Bezeichung</th>
<th>Kalorien</th>
<th>Eiweiß</th>
<th>Kohlenhydrate</th>
<th>Fett</th>
<th>Menge</th>
<th>Update/Delete</th>
</tr>";
  
  
while($row = mysqli_fetch_array($result2))
{
echo "<tr>";
echo "<td>" . $row['bez'] . "</td>";
echo "<td>" . $row['kalorien'] ."</td>";
echo "<td>" . $row['eiweiss'] ."</td>";
echo "<td>" . $row['kohlenhydrate'] ."</td>";
echo "<td>" . $row['fett'] ."</td>";
echo "<td>" . $row['menge'] ."</td>";
echo "<td><a href=\"edit.php?nid=".$row['n_id']."\">Edit</a> | <a href=\"delete.php?nid=".$row['n_id']."\">Delete</a></td>";
echo "</tr>";
}
echo "</table>";
?>
 <FORM>
        <a href="nahrung.php" target="_blank">Nahrung adden</a>
    </FORM>

<form action="anzeige3.php" method="post">
<input type="text" name="bezSuche" />
<input type="submit" name="search" value="Search" />
</form>
<?php


    


if (isset($_POST['search'])) {
    $bezSuche = filter_input(INPUT_POST, "bezSuche");
    $abfrageS = "SELECT * FROM nahrungen where bez like '%{$bezSuche}%'";
$resultS = mysqli_query($connection->myconn, $abfrageS);
$anzahl = mysqli_num_rows($resultS);
    if ($anzahl == 0) {
        echo "du opfer nix nahrung";
    }

echo "<table class='table'>
<tr class='active'>
<th>Bezeichung</th>
<th>Kalorien</th>
<th>Eiweiß</th>
<th>Kohlenhydrate</th>
<th>Fett</th>
<th>Menge</th>
<th>Hinzufügen</th>
</tr>";
  
  
while($rowS = mysqli_fetch_array($resultS))
{
echo "<tr>";
echo "<td>" . $rowS['bez'] . "</td>";
echo "<td>" . $rowS['kalorien'] ."</td>";
echo "<td>" . $rowS['eiweiss'] ."</td>";
echo "<td>" . $rowS['kohlenhydrate'] ."</td>";
echo "<td>" . $rowS['fett'] ."</td>";
echo "<td>" . $rowS['menge'] ."</td>";
echo "<td><a href=\"add.php?bez=".$rowS['bez']."\">Hinzufügen</a></td>";
echo "</tr>";
}
echo "</table>";
}

 
?>




</HTML>
