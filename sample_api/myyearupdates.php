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
   



    if($department_code=='44'){
        OnlyCsdM($dept,$con);
        exit();
    }elseif($department_code=='42'){
        OnlyCsdM($dept,$con);
        exit();
    }
    elseif($department_code=='04'){
        $department_table='ece';
    }elseif($department_code=='03'){
        $department_table='mech';
    }elseif($department_code=='05'){
        $department_table='cse';
    } elseif($department_code=='02'){
        $department_table='eee';
    }else {
        echo json_encode(['error'=>'Invalid department code']);
        exit();
    }

    if($year=='21'){
        $year_table = 'third_year';
    } elseif($year=='22'){
        $year_table='second_year';
    }elseif($year=='23'){
        $year_table='first_year';
    }elseif($year=='20'){
        $year_table='fourth_year';
    }else {
        echo json_encode(['error'=>'Invalid Year']);
        exit();
    }


    if($department_code!='44'&& $department_code!='42'){
    UpdatesforBranchesAndYear($con,$year_table,$department_table);
    }



}


    function OnlyCsdM($dept,$con) : void {
        $department_code = substr($dept, 6, 2);
        $year = substr($dept, 0,2);
        
        if($year=='21' && ($department_code== '44' || $department_code=='42') ){
            $department_table2='CSDANDM';
            $year_table='third_year';
            $table_name='recent_updates_for_'.$year_table.'_'.$department_table2;
    
            $sql = "CREATE TABLE IF NOT EXISTS `$table_name`(
                update_by VARCHAR(20) not null,
                update_description  VARCHAR(10000) not null,
                upload_time timestamp DEFAULT CURRENT_TIMESTAMP()
            )";
            $result1=$con->query($sql);
            if($result1==true){
                $sql = "SELECT * FROM `$table_name` ";
                $result2=$con->query($sql);
                $data = array();
                if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) {
                        $data[] = array(
                            'name' => $row["update_by"],
                            'update' => $row["update_description"],
                            'time' => $row["upload_time"]
                        );
                    }
                }
                echo json_encode($data);
                    
            }
            }elseif($year=='22' && ($department_code== '44' || $department_code=='42')){
                $department_table2='CSDANDM';
                $year_table='second_year';
                $table_name='recent_updates_for_'.$year_table.'_'.$department_table2;
    
                $sql = "CREATE TABLE IF NOT EXISTS `$table_name`(
                    update_by VARCHAR(20) not null,
                    update_description  VARCHAR(10000) not null,
                    upload_time timestamp DEFAULT CURRENT_TIMESTAMP()
                )";
                $result1=$con->query($sql);
                if($result1==true){
                    $sql = "SELECT * FROM `$table_name` ";
                    $result2=$con->query($sql);
                    $data = array();
                    if ($result2->num_rows > 0) {
                        while ($row = $result2->fetch_assoc()) {
                            $data[] = array(
                                'name' => $row["update_by"],
                                'update' => $row["update_description"],
                                'time' => $row["upload_time"]
                            );
                        }
                    }
                    echo json_encode($data);
                        
                }
        }elseif($year=='20' &&( $department_code== '44' || $department_code=='42')){
            $department_table2='CSD&M';
            $year_table='fourth_year';
            $table_name='recent_updates_for_'.$year_table.'_'.$department_table2;
    
            $sql = "CREATE TABLE IF NOT EXISTS `$table_name`(
                update_by VARCHAR(20) not null,
                update_description  VARCHAR(10000) not null,
                upload_time timestamp DEFAULT CURRENT_TIMESTAMP()
            )";
            $result1=$con->query($sql);
            if($result1==true){
                $sql = "SELECT * FROM `$table_name` ";
                $result2=$con->query($sql);
                $data = array();
                if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) {
                        $data[] = array(
                            'name' => $row["update_by"],
                            'update' => $row["update_description"],
                            'time' => $row["upload_time"]
                        );
                    }
                }
                echo json_encode($data);
            }
        }else {
            echo json_encode(['error'=>'Invalid Year']);
            exit();
        }
    }
?>