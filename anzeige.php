<HTML>
   <HEAD>
      <TITLE>Anzeige</TITLE>
      <link href="css/table.css" rel='stylesheet' type='text/css' />
      
      
      
      
   </HEAD>
   <BODY>
       <link href="css/site.css" rel='stylesheet' type='text/css' />
       <ul id="navi">
<li>
<a href="login.php" id="akt">Login</a>
</li>
<li>
<a href="kalorienberechnung.php">Kalorien</a>
</li>
<li>
<a href="logout.php">Logout</a>
</li>
</ul>
   </BODY>
</HTML>
<?php
        session_start();
     ?>
    
<?php

include "connection.php";

$connection = new createCon();
$connection->connect();

$ID = $_SESSION['ID'];
$abfrage = "SELECT * FROM kalorien WHERE k_id LIKE '$ID'";
$result = mysqli_query($connection->myconn, $abfrage);

echo "<table border='1'>
<tr>
<th>Eiwei&szlig</th>
<th>Kohlenhydrate</th>
<th>Fett</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
    echo "Hallo " . $row['k_id'] . "<br>"  ."Ihre Kalorien betragen: " . $row['Kalorien'] ."<br><br>".
          "Die Makron&aumlhrstoffe sind:"."<br><br>";
    
    
echo "<tr>";
echo "<td>" . $row['Eiweiss'] . "</td>";
echo "<td>" . $row['Kohlenhydrate'] ."</td>";
echo "<td>" . $row['Fett'] ."</td>";
echo "</tr>";
}
echo "</table>";
?>
