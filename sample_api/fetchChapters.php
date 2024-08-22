<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "csd";

$con =  mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['subject'])) {
    $Subject =$_POST['subject'];

    $sql = "SELECT lessons,pdfs FROM $Subject";

    $result = $con->query($sql);

    $data = array();

    if($result->num_rows>0) {
        while($row= $result->fetch_assoc()) {
            $data[] = array(
                'lessons'=> $row['lessons'],
                'pdf'=> $row['pdfs'],
            );
        }
    }
    echo json_encode($data);
    header('Content-Type: application/json');



}
?>