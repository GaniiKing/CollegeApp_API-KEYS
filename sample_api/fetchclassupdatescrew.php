<?php


$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "updatestable";

$con = mysqli_connect($servername, $username, $password, $dbname);
header('Content-Type: application/json');

    if(isset($_POST['option'])){
        $option = $_POST['option'];
        $tablename = "recent_updates_for_".$option;
        $sql = "SELECT * FROM $tablename";
        $result = $con->query($sql);
        $data=array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            
                $data[]=array(
                    'name' => $row["update_by"],
                    'update' => $row["update_description"],
                    'time' => $row["upload_time"]
                );
            
            }

        }
        echo json_encode($data);
    
    }



?>