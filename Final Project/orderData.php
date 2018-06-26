<?php
header("Content-type:text/plain");
header("Access-Control-Allow-Origin: *");

$servername = "localhost";
$username = "mzbnz3";
$password = "951106106115";
$dbname = "db_mzbnz3";

//get order id
$id = $_REQUEST["id"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `Order` WHERE `id_customer`=".$id;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo"<h3>Order Details</h3>";
    echo'<table class="w3-table-all w3-striped">
		<tr class="w3-blue">
		  <th>ID</th>
		  <th>Item</th>
		  <th>Price</th>
		  <th>Quantity</th>
		</tr>';
	
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<tr>
				<td>'.$row["id_customer"].'</td>
				<td>'.$row["item"].'</td>
				<td>'.$row["price"].'</td>
				<td>'.$row["qty"].'</td>
			  </tr>';
    }
    echo "</table>";
} 
else {
    echo "There is no data";
}
$conn->close();

?>
