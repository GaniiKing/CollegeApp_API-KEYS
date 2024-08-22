<?php


include("dbconnection.php");
$con = dbconnection();
header('Content-Type: application/json');


if( isset($_POST["registerer"])){
    $registernumber = $_POST["registerer"];


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
    $stmt = $con->prepare("SELECT Student_Name FROM $table_name WHERE Student_Registration_Number=?");
    $stmt->bind_param("s", $registernumber);

    $stmt->execute();

    $result = $stmt->get_result();

    $data=array();


    if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        $data[]=array(
            "name"=>$row["Student_Name"],
        );
    }
}

echo json_encode($data);

}

?>