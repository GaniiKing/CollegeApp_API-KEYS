<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "avevcrew";

$con = mysqli_connect($servername, $username, $password, $dbname);
header('Content-Type: application/json');

if(isset($_POST['crewname'])&& isset( $_POST['password'])){
    $crewname = $_POST['crewname'];
    $password= $_POST['password'];

    $sql = "SELECT * FROM avevcrew.avev WHERE User_Name ='$crewname' AND User_Password ='$password'";
    $result= $con->query($sql);
    $data = array();

    if($result->num_rows ==1 ){
        while($row = $result->fetch_assoc()){
            $data[]=array(
                'dept'=> $row["department"],
            );
        }
    }
    echo json_encode($data);
}
?>