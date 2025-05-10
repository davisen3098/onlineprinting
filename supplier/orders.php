<?php
include_once('../config.php');
if (!isset($_SESSION['supplier_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new DBConnection();
$no_order = $conn->getOrderfromCustomer();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['OrderID']) && isset($_POST['status'])) {

    $orderID = $_POST['OrderID'];
    $newStatus = $_POST['status'];

    $stmt = $conn->conn->prepare("UPDATE `order` SET `Status` = ? WHERE `OrderID` = ?");
    $stmt->bind_param("si", $newStatus, $orderID);

    if ($stmt->execute()) {
        echo "<script>
        alert('Order status updated successfully!');
        window.location.href = 'orders.php'; // Redirects back to orders page
      </script>";
    } else {
        echo "Error updating order status: " . $stmt->error;
    }

    $stmt->close();
    $db->conn->close();
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
    <title>View Orders</title>
    <link href="../fyp/style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Supplier Dashboard</a>
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

                        <a class="nav-link" href="dashboard.php">
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
                                <!-- <a class="nav-link" href="">View product type</a> -->
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

                        <!-- Sidebar Collapase product -->
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
                        <!--End of Sidebar Collapase product -->

                        <!-- Sidebar Collapase Color -->

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
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center">Orders
                                    </h4>
                                </div>
                                <div class="card-body">

                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer Id</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total Price </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($no_order) > 0) {
                                                foreach ($no_order as $order) {
                                            ?>
                                                    <tr>
                                                        <td><?= $order['OrderID']; ?></td>
                                                        <td>
                                                            <?php
                                                            include_once('../config.php'); // Ensure correct path to config file
                                                            require_once '../vendor/autoload.php';
                                                            // Create DB connection instance
                                                            $db = new DBConnection();

                                                            // Ensure $order['CustomerID'] exists before calling function
                                                            if (isset($order['CustomerID'])) {
                                                                $name = $db->getCustomerName($order['CustomerID']);
                                                                echo $name;
                                                            } else {
                                                                echo "Unknown Customer";
                                                            }
                                                            ?>
                                                        </td>

                                                        <td><?php
                                                            $date = date('d-m-Y', strtotime($order['OrderDate']));
                                                            echo $date;
                                                            ?></td>

                                                        <td><?php $order['Status']; ?></td>
                                                        <td>Rs 1000</td>

                                                        <td>
                                                            <form action="" method="post" class="d-inline">
                                                                <input type="hidden" name="OrderID" value="<?= $order['OrderID'] ?>">
                                                                <input type="hidden" name="CustomerID" value="<?= $order['CustomerID'] ?>">

                                                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                                    <?php
                                                                    $statuses = ['Pending', 'Processing', 'Shipped', 'Completed', 'Cancelled'];
                                                                    foreach ($statuses as $status) {
                                                                        $selected = ($order['Status'] == $status) ? 'selected' : '';
                                                                        echo "<option value='$status' $selected>$status</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </form>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "<h5> No Record Found </h5>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Nathan 2022</div>
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