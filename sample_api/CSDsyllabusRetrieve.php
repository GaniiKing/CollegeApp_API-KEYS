<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "csd";

$con =  mysqli_connect($servername, $username, $password, $dbname);
header('Content-Type: application/json');

if(isset($_POST['branch'])&&isset($_POST['sem'])) {
    $Branch =$_POST['branch'];
    $Sem = $_POST['sem'];

    $table_name = $Branch."_".$Sem;
    $sql = "SELECT subjects,lessons FROM $table_name LIMIT 5";

    $result = $con->query($sql);

    $data = array();

    if($result->num_rows>0) {
        while($row= $result->fetch_assoc()) {
            $data[] = array(
                'subjects'=> $row['subjects'],
                'lessons'=> $row['lessons']
            );
        }
    }
    echo json_encode($data);


}
?>