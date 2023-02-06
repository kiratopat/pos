<!DOCTYPE html>
<html lang="en">

<?php include "./component/head_with_auth.php";
include "./db/condb.php";

// query all data in receipt table
$sql = "SELECT 
Receipt.receipt_id, 
Customer.fname AS customer_fname, 
Customer.lname AS customer_lname, 
Employee.fname AS employee_fname, 
Employee.lname AS employee_lname, 
Receipt.total, 
Receipt.timestamp
FROM 
Receipt 
JOIN Customer ON Receipt.customer_id = Customer.customer_id 
JOIN Employee ON Receipt.employee_id = Employee.employee_id
";
$result = $condb->query($sql);
if ($result->num_rows > 0) {
    $receipt_list = array();
    while ($row = $result->fetch_assoc()) {
        array_push($receipt_list, $row);
    }
} else {
    // echo "NotFound";
}


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
        <div class="card">
            <!-- <div class="card-header" style="padding: 1rem;">
                <h3>DataTable with default features</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>Receipt id</th>
                            <th>Customer name</th>
                            <th>Employee name</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td>Trident</td>
                            <td>Internet
                                Explorer 4.0
                            </td>
                            <td>Win 95+</td>
                            <td> 4</td>
                            <td>X</td>
                        </tr> -->
                        <!-- for each $receipt_list echo tr -->
                        <?php foreach ($receipt_list as $receipt) { ?>
                            <tr>
                                <td><?php echo $receipt['timestamp'] ?></td>
                                <td><a class="" href="./receipt.php?<?php echo $receipt['receipt_id'] ?>"><?php echo $receipt['receipt_id'] ?></a></td>
                                <td><?php echo $receipt['customer_fname'] . " " . $receipt['customer_lname'] ?></td>
                                <td><?php echo $receipt['employee_fname'] . " " . $receipt['employee_lname'] ?></td>
                                <td><?php echo $receipt['total'] ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
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
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            // append new tr mock up data
            // $('#example1').append('<tr><td>Trident</td><td>Internet Explorer 4.0</td><td>Win 95+</td><td> 4</td><td>X</td></tr>');

        });
    </script>

    <?php include "./component/footer.php" ?>

</body>

</html>