<?php
require "../db/condb.php";

// echo $_POST['employee_id'];

if (isset($_POST['employee_id']) && isset($_POST['password'])) {
    $employee_id = mysqli_real_escape_string($condb, $_POST['employee_id']);
    $pass = mysqli_real_escape_string($condb, $_POST['password']);
    $sql = "SELECT * FROM employee WHERE employee_id = '$employee_id' AND password = '$pass'";
    $result = mysqli_query($condb, $sql);
    $array_result = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (empty($array_result)) {
        // header("Location: ./login.php");
        echo "NotAllow";
    } else {
        session_start();
        $_SESSION["id"] = $array_result['id'];
        $_SESSION["employee_id"] = $array_result['employee_id'];
        $_SESSION["fname"] = $array_result['fname'];
        $_SESSION["lname"] = $array_result['lname'];
        $_SESSION["role"] = $array_result['role'];
        echo "pass";
        // echo $_SESSION["id"] . $_SESSION["employee_id"] . $_SESSION["fname"] . $_SESSION["lname"] . $_SESSION["role"];
        // header("Location: ../dashboard.php");
    }
}
