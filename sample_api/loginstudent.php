<?php

include("dbconnection.php");
$con = dbconnection();
header('Content-Type: application/json');

if( isset($_POST["registerer"]) &&  isset($_POST["password"])){
    $registernumber = $_POST["registerer"];
    $password = $_POST["password"];

    $year = substr($registernumber,0,2);
    $department_code = substr($registernumber,6,2);

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

    if($department_code=='42'){
        $department_table='csm';
    } elseif($department_code=='44'){
        $department_table='csd';
    }elseif($department_code=='04'){
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


    $table_name=$year_table . "_" . $department_table;
    $stmt = $con->prepare("SELECT Student_Name FROM $table_name WHERE Student_Registration_Number=? AND Student_Password=?");
    $stmt->bind_param("ss", $registernumber, $password);

    $stmt->execute();

    $result = $stmt->get_result();

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $row = $result->fetch_assoc();
        $studentName = $row['Student_Name'];
        echo json_encode(['message' => 'Success', 'Student_Name' => $studentName]);
    }  else {
        echo json_encode(['error' => 'Failed']);
    }
    
}

?>