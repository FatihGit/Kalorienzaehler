<HTML>
   <HEAD>
      <TITLE>Anzeige</TITLE>
      <link href="css/table.css" rel='stylesheet' type='text/css' />
   </HEAD>
   <BODY>
       
   </BODY>
</HTML>
<?php
        session_start();
     ?>
    
<?php
require_once 'mysqlcon.php';

$db = mysqlcon::getConnection();

/*
$con=mysqli_connect("localhost","root","","kalorienzaehlerdb");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
*/

$ID = $_SESSION['ID'];
$result = mysqli_query($con,"SELECT * FROM kalorien WHERE k_id LIKE '$ID'"); 

echo "<table border='1'>
<tr>
<th>Eiweiß</th>
<th>Kohlenhydrate</th>
<th>Fett</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
    echo "Hallo " . $row['k_id'] . "<br>"  ."Ihre Kalorien betragen: " . $row['Kalorien'] ."<br><br>".
          "Die Makronährstoffe sind:"."<br><br>";
    
    
echo "<tr>";
echo "<td>" . $row['Eiweiss'] . "</td>";
echo "<td>" . $row['Kohlenhydrate'] ."</td>";
echo "<td>" . $row['Fett'] ."</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>