<!DOCTYPE html>
<html lang="en">

<?php include "./component/head_with_auth.php";
include "./db/condb.php";

$receipt_id = (int) basename($_SERVER['QUERY_STRING']);
// validate to avoid sql injection
if (!is_numeric($receipt_id)) {
    echo "Invalid receipt id";
    exit();
}

// query all data in receipt table
$sql = "SELECT 
Receipt.receipt_id, 
Customer.fname AS customer_fname, 
Customer.lname AS customer_lname, 
Employee.fname AS employee_fname, 
Employee.lname AS employee_lname, 
Receipt.total, 
Receipt.timestamp,
Receipt.coupon
FROM 
Receipt 
JOIN Customer ON Receipt.customer_id = Customer.customer_id 
JOIN Employee ON Receipt.employee_id = Employee.employee_id
WHERE Receipt.receipt_id = $receipt_id;
";
$result = $condb->query($sql);
if ($result->num_rows > 0) {
    $receipt = $result->fetch_assoc();
    // while ($row = $result->fetch_assoc()) {
    //     array_push($receipt, $row);
    // }
} else {
    // echo "NotFound";
}

// query all data in receiptProduct table
$sql = "SELECT `productreceipt`.`quantity`,`productreceipt`.`amount`,`product`.`name`,`product`.`price`
FROM `productreceipt` 
JOIN `product` ON `productreceipt`.`product_id`=`product`.`product_id`
WHERE `receipt_id`=$receipt_id";
$result = $condb->query($sql);
if ($result->num_rows > 0) {
    $receipt_product_list = array();
    while ($row = $result->fetch_assoc()) {
        array_push($receipt_product_list, $row);
    }
} else {
    // echo "NotFound";
}

// query all data in receiptProduct table
// $sql = "SELECT * FROM `receipt` WHERE `receipt_id`=$receipt_id";
// $result = $condb->query($sql);
// if ($result->num_rows > 0) {
//     $receipt_product_list = array();
//     while ($row = $result->fetch_assoc()) {
//         array_push($receipt_product_list, $row);
//     }
// } else {
//     // echo "NotFound";
// }

?>

<body>
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <?php include "./component/navbar.php" ?>
    <?php include "./component/sidebar.php" ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <button class="btn btn-info mt-3 ml-4 text-center align-middle" onclick="history.back()"><i class="fa-solid fa-caret-left"></i> Back</button>
        <!-- Content Header (Page header) -->
        <!-- <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard </h1> -->
        <!--</div> /.col -->
        <!--</div> /.row -->
        <!--</div> /.container-fluid -->
        <!-- </div> -->
        <!-- /.content-header -->
        <!-- <div id="container" style="width:100%; height:400px;"></div> -->
        <div class="row m-3">
            <div class="col-md-6">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- for each $receipt_list echo tr -->
                                <?php foreach ($receipt_product_list as $product) { ?>
                                    <tr>
                                        <td><?php echo $product['name'] ?></td>
                                        <td><?php echo $product['price'] ?></td>
                                        <td><?php echo $product['quantity'] ?></td>
                                        <td><?php echo $product['amount'] ?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <!-- /.card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="padding: 1rem;">
                        <h3>Receipt id : <?= var_dump($receipt_id); ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <dl>
                            <dt>Employee</dt>
                            <dd><?php echo $receipt['employee_fname'] . " " . $receipt['employee_lname'] ?></dd>
                            <dt>Customer</dt>
                            <dd><?php echo $receipt['customer_fname'] . " " . $receipt['customer_lname'] ?></dd>
                            <dt>Timestamp</dt>
                            <dd><?= $receipt['timestamp'] ?></dd>
                            <dt>Total</dt>
                            <dd><?= $receipt['total'] ?></dd>
                            <dt>Coupon</dt>
                            <dd><?= $receipt['coupon'] === "" ? "N/A" : $receipt['coupon'] ?></dd>
                        </dl>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

        <!-- /.card -->
    </div>

    <!-- jQuery -->
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="./plugins/jszip/jszip.min.js"></script>
    <script src="./plugins/pdfmake/pdfmake.min.js"></script>
    <script src="./plugins/pdfmake/vfs_fonts.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                "order": [
                    [0, 'desc'],
                ],
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            // append new tr mock up data
            // $('#example1').append('<tr><td>Trident</td><td>Internet Explorer 4.0</td><td>Win 95+</td><td> 4</td><td>X</td></tr>');

        });
    </script>

    <?php include "./component/footer.php" ?>

</body>

</html>