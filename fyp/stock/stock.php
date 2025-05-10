<?php

include_once('../connection.php');

/**
 * todo: real-time validation of category name
 * todo: change alert messages
 */

if (isset($_POST['submit'])) {
    $db = new DB_con();
    $p_id = $_POST['p_dropdown'];
    $color_id = $_POST['color_dropdown'];
    $stock_qty = $_POST['stock_qty'];
    $stock_price = $_POST['stock_price'];
    $unit_id = $_POST['unit_dropdown'];


    // File upload path
    $targetDir = "product_image/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (!empty($_FILES["file"]["name"])) {
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server

            // Insert image file name into database
            $result = $db->addStock($stock_qty, $stock_price, $p_id, $color_id, $unit_id, $fileName);
            if ($result) {
                echo "<script>alert('Stock successfully added')</script>";
            } else {
                echo "<script>alert('Stock already exists')</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Add new category </title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../style.css" rel="stylesheet" />
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
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
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
                                <a class="nav-link" href="../product_type/product_type.php">Add new product type</a>
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
                                <a class="nav-link" href="../category/category.php">Add new category</a>
                                <a class="nav-link" href="../category/category-view.php">View category</a>
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
                                <a class="nav-link" href="../color/color.php">Add new color</a>
                                <a class="nav-link" href="../color/color-view.php">View color</a>
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
                                <a class="nav-link" href="../product/product.php">Add new product</a>
                                <a class="nav-link" href="../product/product-view.php">View product</a>
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
                                <a class="nav-link" href="../stock/stock.php">Add new stock</a>
                                <a class="nav-link" href="../stock/stock-view.php">View stock</a>
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
                                <a class="nav-link" href="../unit/unit.php">Add new unit</a>
                                <a class="nav-link" href="../unit/unit-view.php">View unit</a>
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
                <div class="container-fluid px-4">
                    <div class="row justify-content-md-center">
                        <div class="col-md-8">
                            <h1 class="mt-4">Add new stock </h1>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-8">
                            <form action="" method="post" enctype="multipart/form-data">

                                <select id="p_dropdown" name="p_dropdown" class="form-control mt-3">
                                    <option value="0"> Select product </option>
                                    <?php

                                    $fetchProduct = new DB_con();
                                    $result = $fetchProduct->productDropdown();
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $p_name = $row['p_name'];
                                        $p_id = $row['p_id'];

                                        echo  "<option value='" . $p_id . "' >" . $p_name . "</option>";
                                    }

                                    ?>
                                </select>


                                <select id="color_dropdown" name="color_dropdown" class="form-control mt-3">
                                    <option value="0"> Select color </option>
                                    <?php

                                    $fetchColor = new DB_con();
                                    $result = $fetchColor->getColor();
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $color_name = $row['color_name'];
                                        $color_id = $row['color_id'];

                                        echo  "<option value='" . $color_id . "' >" . $color_name . "</option>";
                                    }

                                    ?>
                                </select>
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" id="stock_price" name="stock_price" placeholder="Price">
                                </div>

                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" id="stock_qty" name="stock_qty" placeholder="Quantity">
                                </div>

                                <select id="unit_dropdown" name="unit_dropdown" class="form-control mt-3">
                                    <option value="0"> Select size </option>
                                    <?php

                                    $fetchUnit = new DB_con();
                                    $result = $fetchUnit->unitDropdown();
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $unit_name = $row['unit_name'];
                                        $unit_id = $row['unit_id'];

                                        echo  "<option value='" . $unit_id . "' >" . $unit_name . "</option>";
                                    }

                                    ?>
                                </select>
                                <div class="form-group mt-3">
                                    <input type="file" name="file" />
                                </div>
                                <div class="form-group mt-3">
                                    <input type="submit" class="btn btn-success form-control" value="Add stock" name="submit" />
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            $("#pt_dropdown").change(function() {
                var pt_id = $(this).val();
                console.log(pt_id);
                $.ajax({
                    url: '../getCategory.php',
                    type: 'post',
                    data: {
                        depart: pt_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                        var len = response.length;

                        $("#category").empty();
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['cat_id'];
                            var name = response[i]['cat_name'];

                            $("#category").append("<option value='" + id + "'>" + name + "</option>");

                        }
                    }
                });
            });

        });
    </script>
</body>

</html>