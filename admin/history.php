<?php
include '../src/config/config.php';
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: ../auth/login.php");
    exit();
}

$userid = $_SESSION['userid'];

try {


    $sql_completed = "SELECT COUNT(DISTINCT(transactionid)) AS num_completed_orders FROM adminorderprocess WHERE userid = ? AND status = 'Completed'";
    $stmt_completed = $conn->prepare($sql_completed);
    $stmt_completed->bind_param("i", $userid);
    $stmt_completed->execute();
    $result_completed = $stmt_completed->get_result();
    $row_completed = $result_completed->fetch_assoc();
    $num_completed_orders = $row_completed['num_completed_orders'];

    $num_completed_orders = $num_completed_orders ? $num_completed_orders : 0;
} catch (Exception $e) {

    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>History</title>
    <!-- <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../public/css/admin/sidebar.css">
    <link rel="stylesheet" href="../public/css/customer/history.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
    <section id="sidebar">
        <a href="../admin/dashboard.php" class="brand">
            <img src="../public/img/logo.png" alt="MedLinkup Logo" class="logo">
            <span class="text"> MedLinkup</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="../admin/dashboard.php">
                    <i class='fas fa-clone'></i>
                    <span class="text"> Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='fas fa-capsules'></i>
                    <span class="text">Inventory</span>
                </a>
                <ul class="submenu">
                    <li><a href="../admin/products.php">Products</a></li>
                    <li><a href="../admin/lowstock.php">Low Stock</a></li>
                    <li><a href="../admin/categories.php">Categories</a></li>

                </ul>
            </li>
            <li>
                <a href="../admin/order.php">
                    <i class='fas fa-shopping-bag'></i>
                    <span class="text"> Orders</span>
                </a>
            </li>
            <li>
                <a href="../admin/sales.php">
                    <i class='fas fa-chart-bar'></i>
                    <span class="text"> Sales</span>
                </a>
            </li>
            <li>
                <a href="../admin/customer.php">
                    <i class='fas fa-portrait'></i>
                    <span class="text"> Customers</span>
                </a>
            </li>
            <li>
                <a href="../admin/contact.php">
                    <i class='fas fa-envelope'></i>
                    <span class="text"> Contact</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='fas fa-clone'></i>
                    <span class="text">Shipping Settings</span>
                </a>
                <ul class="submenu">
                    <li><a href="../admin/location.php">Location</a></li>
                    <li><a href="../admin/shippingfee.php">Shipping Fee</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='fas fa-clone'></i>
                    <span class="text"> Supplier</span>
                </a>
                <ul class="submenu">
                    <li><a href="../supplier/suppliershop.php">Order</a></li>
                    <li><a href="../admin/orderstatus.php">Order Status</a></li>
                    <li class="active"><a href="../admin/history.php">History</a></li>
                </ul>
            </li>
            <ul class="side-menu">
                <li>
                    <a href="#">
                        <i class='fa fa-user-cog'></i>
                        <span class="text">System Maintenane</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="../admin/about.php">About</a></li>
                        <li><a href="../admin/privacypolicy.php">Privacy Policy</a></li>
                        <li><a href="../admin/termsofservice.php">Terms of Service</a></li>

                    </ul>
                </li>
                <ul class="side-menu">
                    <li>
                        <a href="#">
                            <i class='fa fa-cogs'></i>
                            <span class="text"> Settings</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="../admin/delivery.php">Delivery Address</a></li>


                        </ul>
                    </li>
                    <li>
                        <a href="../logout.php" class="logout">
                            <i class='fas fa-user'></i>
                            <span class="text"> Logout</span>
                        </a>
                    </li>
                </ul>
    </section>

    <section id="content">
        <nav>
            <i class='fa-pills'></i>
            <a href="#" class="profile">
                <img src="https://i.pinimg.com/originals/f1/0f/f7/f10ff70a7155e5ab666bcdd1b45b726d.jpg">
            </a>
        </nav>
    </section>

    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="history-section">

                        <h1 class="lefth">History (<?php echo $num_completed_orders; ?>)</h1>
                        <?php

                        try {
                            $sql_completed_orders = "SELECT p.productname, op.totalprice, op.ordercompleted, op.status, op.transactionid
                            FROM adminorderprocess op
                            JOIN products p ON op.productid = p.productid
                            WHERE op.status = 'Completed'
                            GROUP BY op.transactionid";

                            $stmt_completed_orders = $conn->prepare($sql_completed_orders);
                            $stmt_completed_orders->execute();
                            $result_completed_orders = $stmt_completed_orders->get_result();
                        } catch (Exception $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Total Price</th>
                                    <th>Date Completed</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try {
                                    while ($row = $result_completed_orders->fetch_assoc()) {
                                        echo "<tr onclick=\"window.location='supplierorderdetails.php?transactionid=" . $row['transactionid'] . "';\" style=\"cursor: pointer;\">";
                                        echo "<td>" . $row['productname'] . "</td>";
                                        $formatted_price = number_format($row['totalprice'], 2);
                                        echo "<td class='totalprice'>₱" . $formatted_price . "</td>";
                                        echo "<td>" . date("d-m-Y", strtotime($row['ordercompleted'])) . "</td>";
                                        echo "<td><span class='status completed'>" . $row['status'] . "</span></td>";
                                        echo "</tr>";
                                    }
                                } catch (Exception $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                                ?>
                            </tbody>

                        </table>


                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>

</html>