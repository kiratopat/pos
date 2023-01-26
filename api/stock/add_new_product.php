<?php
include "../../db/condb.php";

// if got post request validate image then change filename to timestamp number and save file image to /asset/product then insert sql INSERT INTO `file`(`file_id`, `path`, `type`) VALUES ('[value-1]','[value-2]','[value-3]') to file table then get new image (as file id) then insert sql INSERT INTO `product`(`product_id`, `name`, `price`, `stock`, `file_id`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]') to product finally select new product data and echo with json encode"

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $file = $_FILES['image'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_type = $file['type'];
    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));
    $allow = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($file_ext, $allow)) {
        if ($file_error == 0) {
            if ($file_size <= 2097152) {
                $file_name_new = time() . '.' . $file_ext;
                $file_destination = '../../asset/product/' . $file_name_new;
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $sql = "INSERT INTO `file`(`path`, `type`) VALUES ('$file_name_new','$file_type')";
                    $result = $condb->query($sql);
                    $file_id = $condb->insert_id;
                    $sql = "INSERT INTO `product`(`name`, `price`, `stock`, `file_id`) VALUES ('$name','$price','$stock','$file_id')";
                    $result = $condb->query($sql);
                    $product_id = $condb->insert_id;
                    $sql = "SELECT * FROM product WHERE product_id = '$product_id'";
                    $result = $condb->query($sql);
                    $row = $result->fetch_assoc();
                    echo json_encode($row);
                }
            }
        }
    }
}
