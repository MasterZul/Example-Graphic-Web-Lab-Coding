<?php
header("Content-type:text/plain");
header("Access-Control-Allow-Origin: *");

// $servername = "localhost";
// $username = "mrazak";
// $password = "mrazak";
// $dbname = "db_mrazak";

$servername = "localhost";
$username = "mzbnz3";
$password = "951106106115";
$dbname = "db_mzbnz3";

//http://gmm-student.fc.utm.my/~mrazak/17182/order.php?
//json={"task":"create",
//      "cust": {"name":"Lionel Messi", "address":"Block L07, Jalan Merbau, KTHO", "area":"UTM"},
//      "order": [{"item":"Chicken Burger", "price":8.8, "qty": 1},
//                {"item":"Lucky Plate", "price":11.9, "qty": 2}]}

// Get JSON data
$odrinfo = json_decode($_REQUEST["json"]);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO `Customer` (name, address, area) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $address, $area);

// set parameters and execute
$name = $odrinfo->{"cust"}->{"name"};
$address = $odrinfo->{"cust"}->{"address"};
$area = $odrinfo->{"cust"}->{"area"};

$stmt->execute();

printf("New records created successfully\n");
printf("New Record has id %d.\n", $conn->insert_id);

// prepare and bind 2nd table
$stmt = $conn->prepare("INSERT INTO `Order` (id_customer, item, price, qty) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isdi", $id_customer, $item, $price, $qty);


$id_customer = $conn->insert_id;

foreach ($odrinfo->{"order"} as $odr) {
    $item =  $odr->{"item"};
    $price =  $odr->{"price"};
    $qty =  $odr->{"qty"};

    $stmt->execute();

    printf("$id_customer $item $price $qty\n");
}

$stmt->close();
$conn->close();

?>
