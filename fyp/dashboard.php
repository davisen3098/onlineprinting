<?php

include_once('../config.php');
if (!isset($_SESSION['aid'])) {
    header('location:adminLogin.php');
}

$dbh = new DB_con();
$no_user = $dbh->getUserCount();
$no_order = $dbh->getOrderCount();
$no_stock = $dbh->getStockCount();
$no_sale = $dbh->getSaleCount();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Admin Dashboard</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="admin_logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <!-- Sidebar Collapase Product Type -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Product type
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="product_type/product_type.php">Add new product type</a>
                                <a class="nav-link" href="layout-sidenav-light.html">View product type</a>
                            </nav>
                        </div>
                        <!--End of Sidebar Collapase Product Type -->

                        <!-- Sidebar Collapase Category -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Category
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="category/category.php">Add new category</a>
                                <a class="nav-link" href="category/category-view.php">View category</a>
                            </nav>
                        </div>
                        <!--End of Sidebar Collapase Category -->

                        <!-- Sidebar Collapase Color -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseColor" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Color
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseColor" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="color/color.php">Add new color</a>
                                <a class="nav-link" href="color/color-view.php">View color</a>
                            </nav>
                        </div>
                        <!--End of Sidebar Collapase Color -->

                        <!-- Sidebar Collapase Color -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Product
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="product/product.php">Add new product</a>
                                <a class="nav-link" href="product/product-view.php">View product</a>
                            </nav>
                        </div>
                        <!--End of Sidebar Collapase Color -->


                        <!-- Sidebar Collapase Color -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStock" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Stock
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseStock" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="stock/stock.php">Add new stock</a>
                                <a class="nav-link" href="stock/stock-view.php">View stock</a>
                            </nav>
                        </div>
                        <!--End of Sidebar Collapase Color -->

                        <!-- Sidebar Collapase Color -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUnit" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Unit
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseUnit" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="unit/unit.php">Add new unit</a>
                                <a class="nav-link" href="unit/unit-view.php">View unit</a>
                            </nav>
                        </div>
                        <!--End of Sidebar Collapase Color -->
                        <!-- Sidebar Collapase Color -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCustomer" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Customer
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCustomer" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="customer-view.php">View customer</a>
                                <!-- <a class="nav-link" href="../unit/unit-view.php">View unit</a> -->
                            </nav>
                        </div>
                        <!--End of Sidebar Collapase Color -->

                        <!-- Sidebar Collapase Color -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseOrders" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Orders
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseOrders" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="orders.php">View Orders</a>
                            </nav>
                        </div>
                        <!--End of Sidebar Collapase Color -->
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <!-- TODO : insert admin name here -->
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>

                <div class="container-fluid" id="main">
                    <div class="row row-offcanvas row-offcanvas-left">

                        <div class="row mb-3">
                            <div class="col-xl-3 col-sm-6 py-2">
                                <div class="card bg-success text-white h-25">
                                    <div class="card-body bg-success">
                                        <div class="rotate">
                                            <i class="fa fa-users fa-2x"></i>
                                        </div>
                                        <h6 class="text-uppercase">Users</h6>
                                        <h1 class="display-4"><?= $no_user ?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 py-2">
                                <div class="card text-white bg-danger h-100">
                                    <div class="card-body bg-danger">
                                        <div class="rotate">
                                            <i class="fa fa-list fa-2x"></i>
                                        </div>
                                        <h6 class="text-uppercase">Profit</h6>
                                        <h1 class="display-4">Rs <?= $no_sale ?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 py-2">
                                <div class="card text-white bg-info h-100">
                                    <div class="card-body bg-info">
                                        <div class="rotate">
                                            <i class="fa fa-credit-card fa-2x"></i>
                                        </div>
                                        <h6 class="text-uppercase">Orders</h6>
                                        <h1 class="display-4"><?= $no_order ?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 py-2">
                                <div class="card text-white bg-warning h-100">
                                    <div class="card-body">
                                        <div class="rotate">
                                            <i class="fa fa-bar-chart fa-2x"></i>
                                        </div>
                                        <h6 class="text-uppercase">Stock Available</h6>
                                        <h1 class="display-4"><?= $no_stock ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
 
                        <!--/row-->
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>