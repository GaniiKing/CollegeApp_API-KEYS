<?php
include("dbconnection.php");
$con = dbconnection();
header('Content-Type: application/json');


    if(isset($_POST["name"]) && isset($_POST["register-number"]) && isset($_POST["password"])){
        $name2 = $_POST["name"];
        $registernumber = $_POST["register-number"];
        $password = $_POST["password"];
    
        $sql = "CREATE TABLE IF NOT EXISTS second_year_CSM(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS second_year_CSD(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
        $con->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS third_year_CSM(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
        $con->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS third_year_CSD(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS first_year_CSD(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS first_year_CSM(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS first_year_ECE(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS first_year_MECH(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS first_year_EEE(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
        
        $sql = "CREATE TABLE IF NOT EXISTS second_year_ECE(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS third_year_ECE(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
        
    
        $sql = "CREATE TABLE IF NOT EXISTS second_year_MECH(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS third_year_MECH(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS third_year_EEE(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS second_year_EEE(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS first_year_CSE(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
        
        $sql = "CREATE TABLE IF NOT EXISTS second_year_CSE(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL

        )";
    
        $con->query($sql);
    
        
        $sql = "CREATE TABLE IF NOT EXISTS third_year_CSE(
            Student_Name VARCHAR(150),
            Student_Registration_Number VARCHAR(10) UNIQUE,
            Student_Password VARCHAR(20),
            CR VARCHAR(10) DEFAULT NULL
        )";
    
        $con->query($sql);

        $roll_number = $registernumber;
        $year = substr($roll_number,0,2);
        $department_code = substr($roll_number,6,2);

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
        $stmt = $con->prepare("INSERT INTO $table_name (Student_Name, Student_Registration_Number,Student_Password) 
                                VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name2, $registernumber, $password);
        
        if ($stmt->execute()===true) {
            echo json_encode(['message' => 'Successful']);
        } else {
            echo json_encode(['error' => 'Error inserting record: ' . $con->error]);
        }
        
        $stmt->close();
        
    }
?>