<?php
session_start();
include "../db/condb.php";
// {
//     "total": 49.95,
//     "coupon": "WinterPromo",
//     "member_tel": "0999999999",
//     "product_list": [
//         {
//             "id": "10002",
//             "name": "Nike",
//             "price": "15.99",
//             "quantity": "1",
//             "amount": "15.99"
//         },
//         {
//             "id": "10003",
//             "name": "Bag",
//             "price": "20.99",
//             "quantity": "1",
//             "amount": "20.99"
//         },
//         {
//             "id": "10001",
//             "name": "Camera",
//             "price": "10.99",
//             "quantity": "3",
//             "amount": "32.97"
//         }
//     ]
// }
// got this object from post method
if ($_POST) {
    $employee_id = $_SESSION['employee_id'];
    $total = (float) $_POST['total'];
    $coupon = $_POST['coupon'];
    $member_tel = $_POST['member_tel'];
    $products = $_POST['product_list'];
    //echo var_dump($employee_id, $total, $coupon, $member_tel, $product);
    // echo $products;
    // echo var_dump($products);
    // echo count($products);


    // check if member_tel is empty

    $tel = $member_tel;
    $sql = "SELECT customer_id FROM customer WHERE tel = '$tel'";
    $result = $condb->query($sql);
    // if have result return
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_id = $row['customer_id'];
        //echo "\n" . $customer_id;
    } else {
        $customer_id = 1;
        // echo "NotFound";
    }

    $sql = "UPDATE `coupon` SET `stock`= stock-1 WHERE coupon.name = '$coupon';";
    // $result = $condb->query($sql);
    // if have result return
    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     $coupon_value = $row['value'];
    //     echo "\n" . $coupon_value . "\n";
    //     echo var_dump($coupon_value) . "\n";
    //     $coupon_value = (float) $coupon_value;
    //     echo "\n" . $coupon_value . "\n";
    //     echo var_dump($coupon_value);
    // } else {
    //     echo "NotFound";
    // }

    $sql = "INSERT INTO receipt (employee_id, customer_id, total, coupon) VALUES ($employee_id, $customer_id, '$total', '$coupon')";
    //echo "\n$sql\n";
    if ($condb->query($sql) === TRUE) {
        //echo "New record created successfully";
        $receipt_id;

        $sql = "SELECT MAX(receipt_id) AS receipt_id FROM receipt";
        $result = $condb->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $receipt_id = $row['receipt_id'];

            // for each item in $products array echo them
            foreach ($products as $product) {
                $product_id = $product['id'];
                $product_quantity = $product['quantity'];
                $sql = "UPDATE `product` SET `stock`=stock-$product_quantity WHERE `product`.`product_id`=$product_id;";
                $result = $condb->query($sql);
                if ($result !== TRUE) {
                    echo http_response_code(501);
                    echo "Can't insert product_receipt";
                }
                $sql = "INSERT INTO productreceipt (receipt_id, product_id, quantity, amount) VALUES ($receipt_id, " . $product['id'] . ", " . $product['quantity'] . ", " . $product['amount'] . ")";
                $result = $condb->query($sql);
                if ($result !== TRUE) {
                    echo http_response_code(501);
                    echo "Can't insert product_receipt";
                }
            }
            echo http_response_code(200);
            // echo $products;
            // echo var_dump($products);
            // echo count($products);
        } else {
            echo http_response_code(501);
            echo "something wrong when get max receipt id";
        }
    } else {
        echo http_response_code(501);
        echo "Error: " . $sql . "<br>" . $condb->error;
    }
}
