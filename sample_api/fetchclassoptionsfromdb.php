<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "avevcrew";

$con =mysqli_connect($servername, $username, $password,$dbname);
    if(isset($_POST['department'])){
        $department = $_POST['department'];
        $tablename= 'class_options_'.$department;
        $sql = "SELECT * FROM $tablename";
        $result = $con->query($sql);
        $data=array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[]=array(
                    "options"=> $row["options"],
                );
            }
        }
        echo json_encode($data);
    }
?>