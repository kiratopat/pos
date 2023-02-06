 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="./dashboard.php" class="brand-link">
         <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light"><b>POS</b> kirato</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-between">
             <div class="image">
                 <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block"><?= $_SESSION["fname"] . " " . $_SESSION["lname"] ?></a>
             </div>
             <button class="btn btn-danger text-center align-middle mr-2" id="logout">
                 <i class="fas fa-sign-out-alt"></i> logout
             </button>

         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                 <li class="nav-item">
                     <a href="./dashboard.php" class="nav-link <?= basename($_SERVER['REQUEST_URI']) == "dashboard.php" ? "active" : "" ?>">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                             <!-- <span class="right badge badge-danger">New</span> -->
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="./cashier.php" class="nav-link <?= basename($_SERVER['REQUEST_URI']) == "cashier.php" ? "active" : "" ?>">
                         <i class="nav-icon fas fa-money-bill-wave"></i>
                         <p>
                             Cashier
                             <!-- <span class="right badge badge-danger">New</span> -->
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="./history.php" class="nav-link <?= basename($_SERVER['REQUEST_URI']) == "history.php" ? "active" : "" ?>">
                         <i class="nav-icon fas fa-history"></i>
                         <p>
                             History
                             <!-- <span class="right badge badge-danger">New</span> -->
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="./stock.php" class="nav-link <?= basename($_SERVER['REQUEST_URI']) == "stock.php" ? "active" : "" ?>">
                         <i class="nav-icon fas fa-warehouse"></i>
                         <p>
                             Stock
                             <!-- <span class="right badge badge-danger">New</span> -->
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="./member.php" class="nav-link <?= basename($_SERVER['REQUEST_URI']) == "member.php" ? "active" : "" ?>">
                         <i class="nav-icon fas fa-user-friends"></i>
                         <p>
                             Member
                             <!-- <span class="right badge badge-danger">New</span> -->
                         </p>
                     </a>
                 </li>

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>

 <script>
     $("#logout").click(function() {
         $.ajax({
             url: "auth/logout.php",
             type: "POST",
             success: function(data) {
                 window.location.href = "./login.php";
             }
         });
     });
 </script>