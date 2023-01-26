<?php
//<!-- write php code to get all data from pos database table product -->
include "../../db/condb.php";
if (isset($_GET)) {
    $sql = "SELECT * FROM product";
    $result = mysqli_query($condb, $sql);
    $res = [];
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            // push data to $res
            array_push($res, $row);
        }
        // echo var_dump($res);
        // echo $res;
        echo json_encode($res);
    } else {
        echo "0 results";
    }
    mysqli_close($condb);
}
