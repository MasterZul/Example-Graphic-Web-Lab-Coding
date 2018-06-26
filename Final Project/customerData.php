<?php
header("Content-type:text/plain");
header("Access-Control-Allow-Origin: *");

$servername = "localhost";
$username = "mzbnz3";
$password = "951106106115";
$dbname = "db_mzbnz3";

// Get list page
$list = $_REQUEST["list"];
$numInList = $_REQUEST["listNum"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlall = "SELECT * FROM `Customer`";
$resultall = $conn->query($sqlall);
$rowNum = $resultall->num_rows;

$sql = "SELECT * FROM `Customer` LIMIT ".($list*$numInList).", ".$numInList;
$result = $conn->query($sql);
echo ($rowShow);
if ($rowNum > 0) {
	echo"<h3>List Order</h3>";
    echo'<table class="w3-table-all w3-striped">
		<tr class="w3-blue">
		  <th>ID</th>
		  <th>Name</th>
		  <th>Address</th>
		  <th>Area</th>
		  <th>Detail</th>
		</tr>';
	
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<tr>
				<td>'.$row["id_customer"].'</td>
				<td>'.$row["name"].'</td>
				<td>'.$row["address"].'</td>
				<td>'.$row["area"].'</td>
				<td class="w3-center">
				  <button id="btnDetail" class="w3-button w3-red w3-round w3-small" onclick="viewOrd('.$row["id_customer"].')">Show</button>
				</td>
			  </tr>';
    }
	echo '<tr><td colspan="5" style="text-align: center">';
	for ($i = 0; $i < (floor($rowNum/$numInList) + 1); $i++) {
		echo '&nbsp;<button class="w3-button w3-red w3-round w3-tiny"onclick="viewCust('.$i.')">'.($i+1).'</button>';
	} 
	echo '&nbsp;</td></tr>';
    echo "</table>";
} 
else {
    echo "There is no data";
}
$conn->close();

?>
