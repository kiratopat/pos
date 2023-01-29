<!DOCTYPE html>
<html lang="en">

<?php include "./component/head_with_auth.php" ?>

<head>
    <script src="./dist/js/promptpay-qr.js"></script>
    <script src="./dist/js/qrcode.min.js"></script>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <?php include "./component/navbar.php" ?>
    <?php include "./component/sidebar.php" ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="height:100%;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Cashier </h1>
                        <!-- create input type=text id=barcode -->
                        <div class="input-group mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <!-- <i class="fa-solid fa-barcode"></i> -->
                                    <i class="fa-solid fa-qrcode"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Product id..." id="barcode">
                        </div>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-default ">
                        <div class="card-header ">
                            <h3 class="card-title">
                                <i class="fas fa-shopping-cart"></i>
                                Cart
                            </h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body overflow-auto" style="height:65vh;padding:0;">
                            <table class="table table-head-fixed text-nowrap text-center">
                                <thead style="padding: 10%;">
                                    <tr>
                                        <th scope="col">Product id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr key="1">
                                        <td>1</td>
                                        <td>Product A</td>
                                        <td>$10.00</td>
                                        <td class="d-flex justify-content-center">
                                            <input type="number" min="0" value="2" class="form-control text-center" style="width: 30%;" id="quantity" placeholder="Qua.">
                                            <button type="button" class="btn btn-danger ml-2 delete-button"><i class="fas fa-trash"></i></button>
                                        </td>
                                        <td>
                                            <h5><b>$20.00</b></h5>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <div class="card card-default">
                        <div class="card-body" style="padding-bottom: 0;">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-dollar-sign"></i></span>

                                <div class="info-box-content">
                                    <h5 class="info-box-text">Total</h5>
                                    <h2 class="info-box-number"><span id="total">0</span> THB</h2>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                    <!-- /.card up -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h6 class="card-title">
                                <i class="fas fa-ticket-alt"></i>
                                Discount
                            </h6>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h6>
                                <div style="display: flex; justify-content: space-between;">
                                    <div>
                                        <i class="fas fa-check-circle text-success" style="display: none;" id="coupon_status_success"></i>
                                        <i class="fas fa-times-circle text-danger" style="display: none;" id="coupon_status_danger"></i>
                                        <span id="coupon_name"></span>
                                    </div>
                                    <p>
                                        <span class="coupon_value_paragraph">-</span>
                                        <span id="coupon_value"></span>
                                        <span class="coupon_value_paragraph">$</span>
                                    </p>
                                </div>
                            </h6>
                            <!-- create input type text id="coupon" -->
                            <div class="d-flex">
                                <input type="text" class="form-control mr-2" id="coupon" placeholder="Coupon...">
                                <button type="button" style="width: 30%;" class="btn btn-success" id="apply_coupon">Apply</button>
                            </div>
                            <label class="mt-2">Member
                                <span id="member_name"></span>
                            </label>
                            <div class="d-flex">
                                <input type="text" class="form-control mr-2" id="member_tel" placeholder="Phone number...">
                                <button type="button" style="width: 30%;" class="btn btn-info" id="apply_member">Apply</button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <h6 class="card-title">
                                <i class="fas fa-dollar"></i>
                                Payment
                            </h6>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex  justify-content-between">
                                <button class="btn-outline-success">
                                    <i class="fas fa-money-bill-wave"></i>
                                    Cash
                                </button>
                                <button class="btn-outline-success">
                                    <i class="fas fa-credit-card"></i>
                                    Credit
                                </button>
                                <button data-toggle="modal" data-target="#modal-qr-payment" class="btn-outline-success" id="transfer">

                                    <i class="fas fa-money-bill-wave"></i>
                                    Transfer
                                </button>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </section>
        <div class="modal fade" id="modal-qr-payment">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">QR Payment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="card-body">
                                <!-- /.form-group -->
                                <div class="col-md-12 d-flex justify-content-center">
                                    <div id="qrcode"></div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success" id="paid">Paid</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal Remove-->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>


        <?php include "./component/footer.php" ?>

</body>

<script>
    let total = new Decimal(0.00);
    $(document).ready(function() {
        // create function useEffect like a react

        function render_qr() {
            let acc_id = "0992324617";
            let amount = parseFloat($('#total').text());
            let txt = PromptPayQR.gen_text(acc_id, amount);
            qr_dom = document.getElementById("qrcode");
            qr_dom.innerHTML = "";
            if (txt) {
                new QRCode(qr_dom, txt);
            }
        }

        $('#transfer').on('click', async (e) => {
            e.preventDefault();
            render_qr();
        })

        $('.coupon_value_paragraph').hide();

        let numberFormat = new Intl.NumberFormat('th-TH', {
            minimumFractionDigits: 2
        });

        // set span id="total"
        $('#total').text(total.toFixed(2));

        // if (total < 0) total = 0;

        // console.warn(total)
        // $('#total').text(total.toFixed(2));
        async function updateTotal() {
            // get text from all <br class="amount"> and sum them using Decimal.js then update $('#total')
            let amount = await $('.amount');
            let total = new Decimal(0);
            amount.each(function() {
                let amount = $(this).text();
                amount = new Decimal(parseFloat(amount));
                total = total.plus(amount);
            });
            // then get value discount from <span id="coupon_value"> then minus total
            let coupon_value = $('#coupon_value').text();
            coupon_value = parseFloat(coupon_value);
            // check if coupon_value is Nan coupon_value = 0
            if (isNaN(coupon_value)) coupon_value = 0;
            coupon_value = new Decimal(coupon_value);
            total = total.minus(coupon_value);
            // if total < 0 then total = 0
            if (total < 0) total = 0;
            $('#total').text(numberFormat.format(total));

        }


        // when total update update $('#total') too
        // $(document).on('change', function() {
        //     $('#total').text(total);
        // });


        $('#barcode').focus();
        $('#barcode').on('keyup', function(e) {
            if (e.keyCode == 13) {
                let barcode = $(this).val();
                barcode = parseInt(barcode);
                if (isNaN(barcode)) {
                    barcode = null;
                }
                console.log(barcode);
                total += 1
                // empty this value
                $(this).val('');
                $.ajax({
                    url: "api/stock/get_product_by_id.php",
                    type: "POST",
                    data: {
                        product_id: barcode
                    },
                    success: async function(data) {
                        data = JSON.parse(data);
                        console.log(data);
                        // // price = parseFloat(data.price);
                        // let old_total = new Decimal(total)
                        // // let new_total = new Decimal(0.2)
                        // // let price = a.add(b);
                        // let price = new Decimal(parseFloat(data.price))
                        // console.log(price.toString());
                        // total = old_total.add(price)
                        // updateTotal()
                        // create new tr element from data that have response {product_id: '10001', name: 'Camera', price: '10.99', stock: '100', file_id: '1'}

                        // check if product_id is already in tbody add quantity that tr one else append new tr
                        let tr = $(`tr[key="${data.product_id}"]`);
                        if (tr.length > 0) {
                            let quantity = parseInt(tr.find('#quantity').val());
                            quantity += 1;
                            // calculate new amount of tr using Decimal.js then find and update last child
                            let price = new Decimal(parseFloat(data.price));
                            let amount = price.mul(quantity);
                            tr.find('td:last-child').html(`<h5><b class="amount">${numberFormat.format(amount)}</b></h5>`);
                            // update quantity
                            tr.find('#quantity').val(quantity);
                            updateTotal()

                        } else {
                            let tr = `<tr key="${data.product_id}"><td>${data.product_id}</td><td>${data.name}</td><td>${numberFormat.format(data.price)}</td><td class="d-flex justify-content-center"><input type="number" min="0" value="1" class="form-control text-center" style="width: 30%;" id="quantity" placeholder="Qua."><button type="button" class="btn btn-danger ml-2 delete-button"><i class="fas fa-trash"></i></button></td><td><h5><b class="amount">${numberFormat.format(data.price)}</b></h5></td></tr>`;
                            // append to tbody
                            $('tbody').append(tr);
                            updateTotal()
                        }
                        // let tr = `<tr key="${data.product_id}"><td>${data.product_id}</td><td>${data.name}</td><td>$${data.price}</td><td class="d-flex justify-content-center"><input type="number" min="0" value="1" class="form-control text-center" style="width: 30%;" id="quantity" placeholder="Qua."><button type="button" class="btn btn-danger ml-2 delete-button"><i class="fas fa-trash"></i></button></td><td><h5><b>$${data.price}</b></h5></td></tr>`;
                        // // append to tbody
                        // $('tbody').append(tr);

                    }
                });
            }
        });
        $('#apply_coupon').on('click', async function() {
            let coupon = $('#coupon').val();
            console.log(coupon)
            $.ajax({
                url: "api/coupon/get_value_by_name.php",
                type: "POST",
                data: {
                    coupon_name: coupon
                },
                success: async function(data) {
                    console.log(data);
                    if (data) {
                        data = JSON.parse(data);
                        console.log(data);
                        let total = new Decimal($('#total').text());
                        let discount = new Decimal(parseFloat(data.value));
                        let new_total = total.minus(discount);
                        // $('#total').text(numberFormat.format(new_total));
                        // update span coupon_name and coppon_value 
                        $('#coupon_name').text(coupon);
                        $('#coupon_value').text(numberFormat.format(data.value));
                        $('#coupon_status_danger').hide();
                        $('#coupon_status_success').show();
                        updateTotal();
                        $('#coupon').val('');
                        $('.coupon_value_paragraph').show();
                    } else {
                        $('#coupon_name').text(coupon);
                        $('#coupon_value').text("Coupon not valid");
                        $('#coupon_status_danger').show();
                        $('#coupon_status_success').hide();
                        updateTotal();
                        $('#coupon').val('');
                        $('.coupon_value_paragraph').hide();
                    }
                },
                error: function(error) {
                    console.log(error)
                }
            });
        })
        $('#apply_member').on('click', async (e) => {
            e.preventDefault();
            let member_tel = $('#member_tel').val();
            console.log(member_tel)
            $.ajax({
                url: "api/customer/get_member_by_id.php",
                type: "POST",
                data: {
                    tel: member_tel
                },
                success: async function(data) {
                    console.log(data);
                    if (data != "NotFound") {
                        data = JSON.parse(data);
                        console.log(data);
                        $('#member_name').text(` ${data.fname}`);
                        $('#member_name').removeClass("text-danger");
                        $('#member_name').addClass("text-info")
                    } else {
                        $('#member_name').text("Not Found!");
                        $('#member_name').removeClass("text-info");
                        $('#member_name').addClass("text-danger");
                    }
                },
                error: function(error) {
                    console.log(error)
                }
            });
        });


        // onchange of <b> id="amount" => cal new total using Decimal.js and update element have id=total it
        $(document).on('change', '#quantity', async function() {
            let quantity = parseInt($(this).val());
            let price = parseFloat($(this).closest('tr').find('td:nth-child(3)').text());
            let amount = new Decimal(price).mul(quantity);
            $(this).closest('tr').find('td:last-child').html(`<h5><b class="amount">${amount.toFixed(2)}</b></h5>`);
            await updateTotal();
        });


        $(document).on('click', '.delete-button', async function() {
            $(this).closest('tr').remove();
            await updateTotal();
        });
    });
</script>

</html>