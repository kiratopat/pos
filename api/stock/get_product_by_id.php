<?php
//<!-- write php code to get all data from pos database table product -->
include "../../db/condb.php";
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $sql = "SELECT * FROM product WHERE product.product_id = $product_id;";
    $result = mysqli_query($condb, $sql);
    // if have result sent json of that product else sent 404
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        // echo mysqli error
        echo mysqli_error($condb);
        http_response_code(404);
    }
    mysqli_close($condb);
}
