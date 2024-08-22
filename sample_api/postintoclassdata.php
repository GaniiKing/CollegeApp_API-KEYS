<?php



$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "updatestable";

$con = mysqli_connect($servername, $username, $password, $dbname);
header('Content-Type: application/json');

if(isset($_POST['option']) && isset($_POST['post']) && isset($_POST['name'])){
    $post = $_POST['post'];
    $option = $_POST['option'];
    $name = $_POST['name'];

    $tablename = "recent_updates_for_".$option;

    $sql="INSERT INTO $tablename (Update_by,Update_description) VALUES ('$name','$post')";

    $result=$con->query($sql);

    if($result==true){
        echo json_encode(['message' => 'Successful']);
    }else{
        echo json_encode(['error' => 'Error inserting record: ' . $con->error]);
    }
}




?>