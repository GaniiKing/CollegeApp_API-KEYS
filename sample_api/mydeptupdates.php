<?php


$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "updatestable";

$con = mysqli_connect($servername, $username, $password, $dbname);
header('Content-Type: application/json');

if(isset($_POST['dept'])){
    $dept = $_POST['dept'];

    $department_code = substr($dept, 6, 2);


    if($department_code=='42'){
        onlyCsdandCsm($con,$department_code);
        exit();
    } elseif($department_code=='44'){
        onlyCsdandCsm($con,$department_code);
        exit();
    } elseif($department_code=='04'){
        $department_table='ece';
    } elseif($department_code=='03'){
        $department_table='mech';
    } elseif($department_code=='05'){
        $department_table='cse';
    } elseif($department_code=='02'){
        $department_table='eee';
    } else {
        echo json_encode(['error'=>'Invalid department code']);
        exit();
    }

    if($department_code== '42' || $department_code== '44'){
        otherdepartmenttables($con,$department_table);
        exit();
    }


}

function onlyCsdandCsm($con,$department_code) : void {
    $departmenat_table= 'CSDANDM';
    $table_name = 'recent_updates_for_'.$departmenat_table;
    $sql = "CREATE TABLE IF NOT EXISTS `$table_name`(
        update_by VARCHAR(20) NOT NULL,
        update_description VARCHAR(10000) NOT NULL,
        upload_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
    )";
    $result=$con->query($sql);
    if($result==true){
        $sql = "SELECT * FROM `$table_name`";
        $result2=$con->query($sql);
        $data = array();
        if($result2->num_rows!= 0){
            while($row = $result2->fetch_assoc()){
                $data[] = array(
                    'name' => $row["update_by"],
                    'update' => $row["update_description"],
                    'time' => $row["upload_time"]
                );
            }
        }
        echo json_encode($data);
    }

}

function otherdepartmenttables($con,$department_table) : void {
    $table_name = 'recent_updates_for_'.$department_table;
    $sql = "CREATE TABLE IF NOT EXISTS `$table_name`(
        update_by VARCHAR(20) NOT NULL,
        update_description VARCHAR(10000) NOT NULL,
        upload_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
    )";
    $result=$con->query($sql);
    if($result==true){
        $sql = "SELECT * FROM `$table_name`";
        $result2=$con->query($sql);
        $data = array();
        if($result2->num_rows!= 0){
            while($row = $result2->fetch_assoc()){
                $data[] = array(
                    'name' => $row["update_by"],
                    'update' => $row["update_description"],
                    'time' => $row["upload_time"]
                );
            }
        }
        echo json_encode($data);
    }
}





?>