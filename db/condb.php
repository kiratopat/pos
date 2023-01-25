<?php
error_reporting(1);
session_start();

// define connection string
$host = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "pos";

// init connection
$condb = mysqli_connect($host, $user_db, $pass_db, $db_name);
global $condb;

// clear db cookie
setcookie("db_status", "", time() - 3600);

// check connection
if (!$condb) {
    // die("failed to connect to database " . mysqli_error($condb));
    setcookie("db_status", "ERROR");
} else {
    // echo "Connection OK!!!";
    setcookie("db_status", "OK");
}
mysqli_set_charset($condb, 'utf-8');
