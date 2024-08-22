<?php
 function  dbconnection() {
    $conn = mysqli_connect("localhost:3307","root","","avevstudents");
    return $conn;
 }

?>