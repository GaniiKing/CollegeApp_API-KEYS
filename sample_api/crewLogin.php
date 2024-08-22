<?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "avevcrew";

$con =  mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST["Username"]) && isset($_POST['Password'])){
    $username = $_POST["Username"];
    $password = $_POST["Password"];

$sql="SELECT * FROM avev WHERE User_Name='$username' AND User_Password='$password'";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result);

if($count == 1){
    echo json_encode(['message'=>'Success']);
}else{
    echo json_encode(['error'=>'Failed']);
}


}


?>