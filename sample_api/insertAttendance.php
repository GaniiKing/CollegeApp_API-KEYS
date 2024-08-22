<?php


$servername = "localhost:3307";
    $username = "root"; 
    $password = ""; 
    $dbname = "attendence"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_POST['data'])&&isset($_POST['Number'])) {
    $attendanceData = json_decode($_POST['data'], true);
    $number = $_POST["Number"];

  $year = substr($number,0,2);
    $department_code = substr($number,6,2);

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


    $table_name1='attendence_for_'.$year_table.'_'.$department_table;


    $current_date=date('Y_m_d');
    


    foreach($attendanceData as $record) {
        $student_name = $record['student_name'];
        $attendance_status = $record['attendance_status'];

        $sql = "UPDATE $table_name1 SET `$current_date` = '$attendance_status' WHERE students = '$student_name'";

        if ($conn->query($sql) === TRUE) {
            echo "Attendance record inserted successfully.\n";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }


}
?>
