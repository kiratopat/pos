<!DOCTYPE html>
<html lang="en">

<?php include "./component/head_with_auth.php";
include "./db/condb.php";

// query all data in receipt table
$sql = "SELECT * FROM `customer` WHERE `customer`.`customer_id` <> 1 ;";
$result = $condb->query($sql);
if ($result->num_rows > 0) {
    $customer_list = array();
    while ($row = $result->fetch_assoc()) {
        array_push($customer_list, $row);
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
                            <th>Member id</th>
                            <th>Member name</th>
                            <th>Tel</th>
                            <th>Gender</th>
                            <th>Point</th>
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
                        <!-- for each $customer_list echo tr -->
                        <?php foreach ($customer_list as $member) { ?>
                            <tr>
                                <td><?php echo $member['customer_id'] ?></td>
                                <td><a class="" href="#to_member_detail"><?php echo $member['fname'] . " " . $member['lname'] ?></a></td>
                                <td><?php echo $member['tel'] ?></td>
                                <td><?php echo $member['gender'] ?></td>
                                <td><?php echo $member['point'] ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="modal fade" id="modal-new-member">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Register new member</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Firstname</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="first name..." id="fname">
                        </div>
                        <label>Lastname</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="last name..." id="lname">
                        </div>
                        <label>Phone number</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="phone number..." id="tel">
                        </div>
                        <label>Birth day</label>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" placeholder="birth day..." id="birth">
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="Male" value="Male" name="gender" checked="">
                                <label for="Male" class="custom-control-label">Male</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="Female" value="Female" name="gender">
                                <label for="Female" class="custom-control-label">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submit_regis">Regis</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal Add -->
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
                    [0, 'asc'],
                ],
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            // append 1 more button name="regisnew" next to last button
            $('#example1_wrapper .col-md-6:eq(0)').append('<button type="button" class="btn btn-primary" style="margin-left: 1rem;" id="regisnew" data-toggle="modal" data-target="#modal-new-member">Register new </button>');

            // add event listener onclick button that have id=submit_regis then get value from input in form model post to api
            $("#submit_regis").click(async (e) => {
                e.preventDefault();
                let submit_data = {
                    fname: await $("#fname").val(),
                    lname: await $("#lname").val(),
                    tel: await $("#tel").val(),
                    birth: await $("#birth").val(),
                    gender: await $('input[name="gender"]:checked').val()
                }
                console.log(submit_data);
                $.ajax({
                    url: "./api/customer/regis_new.php",
                    type: "POST",
                    data: submit_data,
                    success: (data) => {
                        console.log(data);
                        location.reload();
                        $("#modal-new-member").modal("hide");
                    },
                    error: (err) => {
                        console.log(err);
                    }
                })
            });




        });
    </script>

    <?php include "./component/footer.php" ?>

</body>

</html>