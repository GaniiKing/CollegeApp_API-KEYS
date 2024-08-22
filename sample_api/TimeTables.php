<?php 
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "csd";
$con =  mysqli_connect($servername, $username, $password, $dbname);
    $sql = "SELECT * FROM timetables";
    $result = $con->query($sql);
    $data=array();
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            $data[]=array(
                'dept'=>$row['dept'],
                'sem'=>$row['sem']
            );
        }
    }
    echo json_encode($data);
?>