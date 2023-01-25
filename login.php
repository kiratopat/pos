<?php include "./component/head.php" ?>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>POS</b>Kirato</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Employee Id" id="employee_id">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button class="btn btn-primary btn-block" id="submit">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>



                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new cashier</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <script>
        $(document).ready(function() {
            $("#submit").click(function(e) {
                e.preventDefault();
                let employee_id = $("#employee_id").val();
                let password = $("#password").val();
                // alert();
                $.post("./auth/loginOTM.php", {
                        employee_id: employee_id,
                        password: password
                    },
                    function(data, status) {
                        alert("Data: " + data + "\nStatus: " + status);
                        if (data == "pass") {
                            window.location.href = "./dashboard.php";
                        } else {
                            alert("Not Allow");
                        }
                    });

            });
        });
    </script>


</body>