<!DOCTYPE html>
<html lang="en">

<?php include "./component/head_with_auth.php" ?>

<head>
    <!-- DataTables -->
    <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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

    <title>
        Stock
    </title>
</head>

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
                        <h1 class="m-0">Stock</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6 text-right">
                        <button class="btn btn-info" data-toggle="modal" data-target="#modal-new-product">Add New Product</button>
                        <button class="btn btn-danger ml-3" data-toggle="modal" data-target="#modal-remove-product" id="outside-remove-product">Remove Product</button>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable with default features</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>Product Id</th>
                                            <th>Product Name</th>
                                            <th>Stock</th>
                                            <th>Add Action</th>
                                            <th>Remove Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>Rendering engine</th>
                                            <th>Browser</th>
                                            <th>Platform(s)</th>
                                            <th>Engine version</th>
                                            <th>CSS grade</th>
                                        </tr>
                                    </tfoot> -->
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <div class="modal fade" id="modal-add">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">How much you want to add?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="number..." aria-label="add_quantity" aria-describedby="add_quantity" id="add_quantity">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="add">Add</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal Add -->
            <div class="modal fade" id="modal-remove">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">How much you want to remove?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="number..." aria-label="remove_quantity" aria-describedby="remove_quantity" id="remove_quantity">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="remove">Remove</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal Remove-->

            <div class="modal fade" id="modal-new-product">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add new product to stcok</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- write html form tp get product data [name,stock,image] -->
                            <label for="product_name">Product Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="product name..." aria-label="new_product_name" aria-describedby="new_product_name" id="new_product_name">
                            </div>
                            <label for="product_name">Quantity</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="quantity..." aria-label="new_product_quantity" aria-describedby="new_product_quantity" id="new_product_quantity">
                            </div>
                            <label for="product_name">Price</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="price..." aria-label="new_product_price" aria-describedby="new_product_price" id="new_product_price">
                            </div>
                            <label for="product_name">Product image</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <!-- write html input file type jpg,jpeg,png and make text in element change to file name that user input  -->
                                    <input type="file" class="custom-file-input" id="product_image" accept="image/*">
                                    <label class="custom-file-label" for="product_image">Choose file...</label>
                                </div>
                            </div>
                            <!-- make img div to center img -->
                            <div class="d-flex justify-content-center">
                                <!-- create img to preview image 200px*200px when user choosed file-->
                                <img src="" style="display: none;" alt="" id="img_preview" width="200px" height="200px">

                            </div>
                            <!-- create img to preview image 200px*200px when user choosed file-->
                            <!-- <img src="" style="display: none;" alt="" id="img_preview" width="200px" height="200px"> -->

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="add_new_product">Add new product</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal Add new product -->
            <div class="modal fade" id="modal-remove-product">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">What is product that you want to remove ?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label>Product id name</label>
                                        <select class="form-control select2" style="width: 100%; height: 100%;" id="preview_product_name">
                                            <!-- <option selected="selected">Alabama</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option> -->
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="col-md-6">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" id="remove_product">Remove</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal Remove-->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <?php include "./component/footer.php" ?>

    <script>
        let product_id = 0;
        let quantity = 0;
        // when document ready write jquery get array data from ./api/stock/get_stock.php
        $("document").ready((e) => {
            $.ajax({
                url: "./api/stock/get_stock.php",
                type: "GET",
                success: (data) => {
                    data = JSON.parse(data);
                    console.log(data);
                    // remove td that have class dataTables_empty
                    $("td.dataTables_empty").remove();
                    // for each data render element on html
                    data.forEach((element) => {
                        let tr = document.createElement("tr");
                        let td1 = document.createElement("td");
                        let td2 = document.createElement("td");
                        let td3 = document.createElement("td");
                        let td4 = document.createElement("td");
                        let td5 = document.createElement("td");
                        let span1 = document.createElement("span");
                        let span2 = document.createElement("span");
                        tr.setAttribute("key", element.product_id);
                        td4.classList.add("text-center");
                        td5.classList.add("text-center");
                        td1.innerHTML = element.product_id;
                        td2.innerHTML = element.name;
                        td3.innerHTML = element.stock;
                        td3.classList.add("text-center");
                        span1.innerHTML = "add";
                        span1.classList.add("btn");
                        span1.classList.add("btn-success");
                        span1.classList.add("outside-add");
                        span1.setAttribute("data-toggle", "modal");
                        span1.setAttribute("data-target", "#modal-add");
                        span1.setAttribute("data-product_id", element.product_id);
                        span1.setAttribute("data-product_name", element.product_name);
                        span1.setAttribute("data-stock", element.stock);
                        span2.innerHTML = "remove";
                        span2.classList.add("btn");
                        span2.classList.add("btn-warning");
                        span2.classList.add("outside-remove");
                        span2.setAttribute("data-toggle", "modal");
                        span2.setAttribute("data-target", "#modal-remove");
                        span2.setAttribute("data-product_id", element.product_id);
                        span2.setAttribute("data-product_name", element.name);
                        span2.setAttribute("data-stock", element.stock);
                        td4.classList.add("text-center");
                        // add onclick callback function to span1
                        span1.onclick = (e) => {
                            e.preventDefault();
                            // get key value from attribute ket on parent td
                            product_id = e.target.parentElement.parentElement.getAttribute("key");
                        }
                        span2.onclick = (e) => {
                            e.preventDefault();
                            // get key value from attribute ket on parent td
                            product_id = e.target.parentElement.parentElement.getAttribute("key");
                        }
                        td4.appendChild(span1);
                        td5.appendChild(span2);
                        tr.appendChild(td1);
                        tr.appendChild(td2);
                        tr.appendChild(td3);
                        tr.appendChild(td4);
                        tr.appendChild(td5);
                        document.querySelector("tbody").appendChild(tr);
                    })
                },
                error: (err) => {
                    console.log(err);
                }
            })
        })


        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            // $("#example1").DataTable({
            //     "responsive": true,
            //     "lengthChange": false,
            //     "autoWidth": false,
            //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $("#add").click(async (e) => {
                e.preventDefault();
                quantity = await $("#add_quantity").val();
                console.log(product_id, quantity);
                $.ajax({
                    url: "./api/stock/add_stock.php",
                    type: "POST",
                    data: {
                        product_id: parseInt(product_id),
                        quantity: parseInt(quantity)
                    },
                    success: (data) => {
                        console.log(data);
                        data = JSON.parse(data)
                        console.log(data);
                        let product_id = parseInt(data[0]["product_id"])
                        let new_stock_to_update = parseInt(data[0]["stock"])
                        // update text in element that contain stock of this product_id
                        $(`tr[key=${product_id}] td:nth-child(3)`).text(new_stock_to_update);
                        // clear value of $("#add_quantity").val();
                        $("#add_quantity").val("");
                        // close modal
                        $("#modal-add").modal("hide");
                    },
                    error: (err) => {
                        console.log(err);
                    }
                })
            });
            $("#remove").click(async (e) => {
                e.preventDefault();
                quantity = await $("#remove_quantity").val();
                console.log(product_id, quantity);
                $.ajax({
                    url: "./api/stock/remove_stock.php",
                    type: "POST",
                    data: {
                        product_id: parseInt(product_id),
                        quantity: parseInt(quantity)
                    },
                    success: (data) => {
                        console.log(data);
                        data = JSON.parse(data)
                        console.log(data);
                        let product_id = parseInt(data[0]["product_id"])
                        let new_stock_to_update = parseInt(data[0]["stock"])
                        // update text in element that contain stock of this product_id
                        $(`tr[key=${product_id}] td:nth-child(3)`).text(new_stock_to_update);
                        // clear value of $("#add_quantity").val();
                        $("#remove_quantity").val("");
                        // close modal
                        $("#modal-remove").modal("hide");
                    },
                    error: (err) => {
                        console.log(err);
                    }
                })
            });
            // when user choose file to $("#product_image") browser should buffer file to send for ajax
            $("#product_image").change(function() {
                // set text in sibling labal element to filename
                $(this).siblings("label").text(this.files[0].name);
                // make img preview to preview image
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#img_preview').attr('src', e.target.result);
                        // remove strye display none
                        $('#img_preview').css("display", "block");
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            // when user click on button with id="add_new_product" ajax should send data to api
            $("#add_new_product").click(async (e) => {
                e.preventDefault();
                // get value from input
                let name = await $("#new_product_name").val();
                let price = await $("#new_product_price").val();
                let quantity = await $("#new_product_quantity").val();
                let image = await $("#product_image").prop("files")[0];
                // create form data to send to api
                let form_data = new FormData();
                form_data.append("name", name);
                form_data.append("price", price);
                form_data.append("stock", quantity);
                form_data.append("image", image);
                console.log(form_data)
                // send ajax
                $.ajax({
                    url: "./api/stock/add_new_product.php",
                    type: "POST",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        console.log(data);
                        // clear value of input
                        $("#new_product_name").val("");
                        $("#new_product_price").val("");
                        $("#new_product_quantity").val("");
                        $("#image").val("");
                        // clear text in label
                        $("#image").siblings("label").text("Choose file");
                        // remove image preview
                        $("#img_preview").css("display", "none");
                        // close modal
                        $("#modal-add-product").modal("hide");
                        // reload page
                        location.reload();
                    },
                    error: (err) => {
                        console.log(err);
                    }
                })
            });
            // when user click on button with id="outside-remove-product" send ajax method get to ./api/stock/get_stock.php than fetch data to create option in select have id="preview_product_name"
            $("#outside-remove-product").click(async (e) => {
                e.preventDefault();
                $.ajax({
                    url: "./api/stock/get_stock.php",
                    type: "GET",
                    success: (data) => {
                        console.log(data);
                        data = JSON.parse(data);
                        console.log(data);
                        // clear option in select
                        $("#preview_product_name").html("");
                        // create option in select
                        data.forEach((product) => {
                            $("#preview_product_name").append(`
                                <option value="${product["product_id"]}">${product["name"]}</option>
                            `);
                        });
                        // open modal
                        $("#modal-remove-product").modal("show");
                    },
                    error: (err) => {
                        console.log(err);
                    }
                })
            });
            // when user click on button with id="remove_product" send ajax method post to ./api/stock/remove_product.php then if success reload page
            $("#remove_product").click(async (e) => {
                e.preventDefault();
                let product_id = await $("#preview_product_name").val();
                // get product name
                console.log(product_id);
                $.ajax({
                    url: "./api/stock/remove_product.php",
                    type: "POST",
                    data: {
                        product_id: parseInt(product_id)
                    },
                    success: (data) => {
                        console.log(data);
                        // close modal
                        $("#modal-remove-product").modal("hide");
                        // reload page
                        location.reload();
                    },
                    error: (err) => {
                        console.log(err);
                    }
                })
            });

        });
    </script>
</body>


</html>