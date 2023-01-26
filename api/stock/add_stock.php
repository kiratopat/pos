<?php
include "../../db/condb.php";
// if post is set function
if (isset($_POST["product_id"])) {
    // get quantity from post ["quantity"] and parseInt it
    $quantity =  $_POST["quantity"];
    $product_id =  $_POST["product_id"];
    // update product stock by product_id in product table
    $add_sql = "UPDATE `product` SET `stock`=`stock`+ $quantity WHERE `product`.`product_id` = $product_id;";
    if (mysqli_query($condb, $add_sql)) {
        $get_sql = "SELECT `product_id`,`stock` FROM `product` WHERE `product`.`product_id` = $product_id;";
        $result = mysqli_query($condb, $get_sql);
        $res = [];
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                // push data to $res
                array_push($res, $row);
            }
            // echo var_dump($res);
            // echo $res;
            $stock = $res[0]["stock"];
        } else {
            echo "0 results";
        }
        echo json_encode($res);
        // echo "New stock of id 5 : " . $stock;
    } else {
        echo "Error updating record: " . mysqli_error($condb) . $add_sql;
    }
    mysqli_close($condb);
}
