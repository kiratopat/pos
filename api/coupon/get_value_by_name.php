<?php
include "../../db/condb.php";
if (isset($_POST['coupon_name'])) {
    $name = $_POST['coupon_name'];
    $sql = "SELECT value,stock FROM `coupon` WHERE coupon.name = '$name';";
    $result = mysqli_query($condb, $sql);
    // if have result sent json of that product else sent 404
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['stock'] > 0) {
            echo json_encode($row);
        } else {
            echo NULL;
        }
    } else {
        // echo mysqli error
        echo mysqli_error($condb);
        // http_response_code(404);
    }
    mysqli_close($condb);
}
