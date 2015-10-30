<HTML>
   <HEAD>
      <TITLE>Anzeige</TITLE>
      <link href="css/table.css" rel='stylesheet' type='text/css' />
      
      <style>
#navi {
	margin: 0;
	padding: 0 0 20px 0;
	border-bottom: 1px solid #000000;
}

#navi ul, #navi li{
	margin: 0;
	padding: 0;
	display: inline;
	list-style-type: none;
}

#navi a:link, #navi a:visited {
	float: left;
	line-height: 14px;
	font-weight: bold;
	margin: 0 10px 0 10px;
	text-decoration: none;
	color: #909090;
}

#navi #akt {
	padding-bottom: 2px;
	color: #000000;
	border-bottom: 4px solid #000000;
}

#navi a:hover, #navi a:hover#akt {
	padding-bottom: 2px;
	color: #000000;
	border-bottom: 4px solid #000000;
}
</style>
      
      
      
   </HEAD>
   <BODY>
       <ul id="navi">
<li>
<a href="login.php" id="akt">Login</a>
</li>
<li>
<a href="kalorienberechnung.php">Kalorien</a>
</li>
<li>
<a href="">Logout</a>
</li>
</ul>
   </BODY>
</HTML>
<?php
        session_start();
     ?>
    
<?php
include "mysqlcon.php";

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