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

$verbindung = mysqli_connect("mysql.hostinger.de", "u659698584_ilyas", "ilyasmysql")
        or die("Verbindung zur Datenbank konnte nicht hergestellt werden");
mysqli_select_db($verbindung, "u659698584_kalo") or die("Datenbank konnte nicht ausgewählt werden");

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