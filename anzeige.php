<HTML>
   <HEAD>
      <TITLE>Anzeige</TITLE>
   </HEAD>
   <BODY>
       <div class="loader"></div>
   </BODY>
</HTML>
<?php
        session_start();
     ?>
    
<?php
$con=mysqli_connect("localhost","root","","kalorienzaehlerdb");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$ID = $_SESSION['ID'];
$result = mysqli_query($con,"SELECT * FROM kalorien WHERE k_id LIKE '$ID'"); 

echo "<table border='1'>
<tr>
<th>ID</th>
<th>kalorien</th>
<th>Eiweiß</th>
<th>Kohlenhydrate</th>
<th>Fett</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['k_id'] . "</td>";
echo "<td>" . $row['Kalorien'] . "</td>";
echo "<td>" . $row['Eiweiss'] . "</td>";
echo "<td>" . $row['Kohlenhydrate'] ."</td>";
echo "<td>" . $row['Fett'] ."</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>