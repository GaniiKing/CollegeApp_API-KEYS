<?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "avevcrew";

$con =  mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT * FROM avev";
$result = $con->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'name' => $row["User_Name"],
            'post' => $row["User_Post"],
            'Contact' => $row["Contact_No"]
        );
    }
}

header('Content-Type: application/json');
echo json_encode($data);
?>