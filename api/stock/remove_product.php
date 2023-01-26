<?php
include "../../db/condb.php";

// if got post request get a param [product_id] 
if (isset($_POST["product_id"])) {
    // get product_id from post ["product_id"] and parseInt it
    $product_id =  $_POST["product_id"];
    // use sql tp get $file_name from product table join file_id to File table feild file_id where product_id=product_id
    $get_sql = "SELECT `product_id`,`path` FROM `product` JOIN `file` ON `product`.`file_id` = `file`.`file_id` WHERE `product`.`product_id` = $product_id;";
    // query and get result to $file_name variable
    $file_name = mysqli_fetch_assoc(mysqli_query($condb, $get_sql))["path"];

    // delete product by product_id in product table
    $delete_sql = "DELETE FROM `product` WHERE `product`.`product_id` = $product_id;";
    if (mysqli_query($condb, $delete_sql)) {
        $file_path = "../../asset/product/" . $file_name;
        // delete file by file_path
        if (!is_dir($file_path) && is_writable($file_path)) {
            unlink($file_path);
            echo "200";
        } else {
            echo "201";
        }
    } else {
        echo "Error deleting record: " . mysqli_error($condb) . $delete_sql;
    }
    mysqli_close($condb);
}
