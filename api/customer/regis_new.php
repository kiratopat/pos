<?php
session_start();
include "../../db/condb.php";
// data in $_POST is {
//     "fname": "ertser",
//     "lname": "sergesrg",
//     "tel": "0992324617",
//     "birth": "2023-02-15",
//     "gender": "Female"
// }
// if post then get fname:string,lname:string,tel:string,birth:date,gender:string value from $_post then insert to customer table
if ($_POST) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $tel = $_POST['tel'];
    $birth = $_POST['birth'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO customer (fname, lname, tel, birth, gender) VALUES ('$fname', '$lname', '$tel', '$birth', '$gender')";
    if ($condb->query($sql) === TRUE) {
        // echo $fname . $lname . $tel . $birth . $gender;
        echo http_response_code(200);
    } else {
        echo http_response_code(501);
        echo "Error: " . $sql . "<br>" . $condb->error;
    }
}
