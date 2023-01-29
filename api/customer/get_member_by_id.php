<?php
include "../../db/condb.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tel = $_POST['tel'];
    $sql = "SELECT * FROM customer WHERE tel = '$tel'";
    $result = $condb->query($sql);
    // if have result return
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo "NotFound";
    }
}
