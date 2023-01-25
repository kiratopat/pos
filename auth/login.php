<?php

require "../database/condb.php";


$user = $_POST['employee_id'];
$pass = $_POST['password'];
$sql = "SELECT * FROM employee WHERE employee_id = '" . $user . "' AND password = '" . $pass . "'";
$result = mysqli_query($condb, $sql);
$array_result = mysqli_fetch_array($result);

if (empty($array_result)) {
    // echo "insert OK !!!";
    setcookie("login-result", 0);
    echo "<script>
    location.href = './login.php';
    </script>";
} else {
    // setcookie("login-result", 1);
    setcookie("login-result", "", time() - 3600);
    $_SESSION["id"] = $array_result['id'];
    $_SESSION["user"] = $array_result['user'];
    $_SESSION["firstname"] = $array_result['firstname'];
    $_SESSION["surname"] = $array_result['surname'];
    $_SESSION["role"] = $array_result['role'];

    echo "<script>location.href = './search.php';</script>";
    // echo "insert ERROR !!!";
}
