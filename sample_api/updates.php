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
    $year = substr($dept, 0,2);


    if($year=='21'){
        $year_table = 'third_year';
    }elseif($year=='22'){
        $year_table='second_year';
    }elseif($year=='23'){
        $year_table='first_year';
    }elseif($year=='20'){
        $year_table='fourth_year';
    }else {
        echo json_encode(['error'=>'Invalid Year']);
        exit();
    }

    
    if($department_code=='42'){
        $department_table='csm';
    } elseif($department_code=='44'){
        $department_table='csd';
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

    UpdatesforBranchesAndYear($con,$year_table,$department_table);
    
    
}


function UpdatesforBranchesAndYear($con,$year_table,$department_table) : void {
    $table_name7 = 'recent_updates_for_'.$year_table.'_'.$department_table;
    $sql_create = "CREATE TABLE IF NOT EXISTS `$table_name7` (
        update_by varchar(20) not null,
        update_description varchar(10000) not null,
        upload_time timestamp default CURRENT_TIMESTAMP()
    )";
    $con->query($sql_create);
    $sql = "SELECT * FROM $table_name7";
    $result = $con->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                'name' => $row["update_by"],
                'update' => $row["update_description"],
                'time' => $row["upload_time"]
            );
        }
    }

    echo json_encode($data);
}


?>