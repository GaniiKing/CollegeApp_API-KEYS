<?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "avevcrew";

$con =  mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT * FROM businfo limit 100";
$result = $con->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'driver_name' => $row["driver_name"],
            'bus_number' => $row["bus_number"],
            'contact' => $row["contact"]
        );
    }
}

header('Content-Type: application/json');
echo json_encode($data);
?>