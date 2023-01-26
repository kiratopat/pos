<!DOCTYPE html>
<html lang="en">

<?php include "./component/head_with_auth.php" ?>

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
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Stock </h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- write html and css(bootstrap 4.6) to create a product card with picture from ./asset/product/*, name and stock remaining -->
        <div class="d-flex justify-between ml-3 mx-3">
            <div class="card bg-white p-3">
                <img src="./asset/product/camera.jpg" class="img-fluid" style="width: 200px;">
            </div>
        </div>
        <!-- /.content -->


        <?php include "./component/footer.php" ?>

</body>

<srcipt>
    <!-- write js get array from  -->
</srcipt>

</html>