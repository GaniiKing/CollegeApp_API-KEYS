<?php 

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "complaints";

$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_POST["complaint"])){
    $complaint = $_POST["complaint"];
    $sql="INSERT INTO anonycomplaintstable(complaint) VALUES('$complaint')";
    $result = $conn->query($sql);
    if($result==true){
        echo "Done anonymously";
    }


}else if(isset($_POST["number"]) && isset( $_POST["identitycomplaint"])){
    $number = $_POST["number"];
    $complaint2= $_POST["identitycomplaint"];

    $sql= "INSERT INTO identitycomplaints (Student_Registration_Number,complaint)VALUES ('$number','$complaint2')";
    $result = $conn->query($sql);
    if($result==true){
        echo "done with identity";
    }

}






?>