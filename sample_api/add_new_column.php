<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "attendence";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST["number"])){

  $number = $_POST["number"];

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
    $tablename = $year_table.'_'.$department_table;



    $sql_check_cr = "SELECT CR FROM avevstudents.`$tablename` WHERE Student_Registration_Number = '$number'";
    $result5=$conn->query($sql_check_cr);

    if ($result5->num_rows > 0) {
      $row = $result5->fetch_assoc();
      $crValue = $row["CR"];
  
      if ($crValue !== null && $crValue == "yes") {
          

          $table_name1='attendence_for_'.$year_table.'_'.$department_table;

          //YYYY_MM_DD 
          $current_date = date("Y_m_d");
        
          $sql_create_table = "CREATE TABLE IF NOT EXISTS $table_name1 (
                                students varchar(10) not null,
                                $current_date varchar(10) default null
                              )";
          
          
          if ($conn->query($sql_create_table) === TRUE) {
            $sql_insert = "INSERT INTO $table_name1 (students)
                         SELECT Student_Registration_Number	 FROM avevstudents.$tablename
                         WHERE Student_Registration_Number	 NOT IN (SELECT students FROM $table_name1)";
          
                        $result2= $conn->query($sql_insert);
          
          
                         if($conn->query($sql_insert) === TRUE) {
          
                          $sql_select = "SELECT students FROM $table_name1";
          
                          $result3=$conn->query($sql_select);
                          
                          
          
                          $data=array();
          
          
                          if($result3->num_rows>0) {
                            while($row= $result3->fetch_assoc()) {
                                $data[] = array(
                                    "Students"=> $row["students"],
                                );
                            }
                        }
                        echo json_encode($data);
                         }
          
          } else {
            echo "Error creating table: " . $conn->error;
          }
          
          $result = $conn->query("DESCRIBE $table_name1 $current_date");
          
          if ($result->num_rows> 0) {
            echo "". $conn->error;
          } else {
            $sql_add_column = "ALTER TABLE $table_name1 ADD COLUMN $current_date INT DEFAULT 0";
            if ($conn->query($sql_add_column) === TRUE) {
              print "Column $current_date added successfully.\n";
            } else {
              print "Error adding column: " . $conn->error . "\n";
            }
          }


      } else {
          echo "Not Authenticated";
      }
  } else {
      echo "No record found for registration number $number";
  }




}
?>