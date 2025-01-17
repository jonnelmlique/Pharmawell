<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Details</title>
    <link rel="stylesheet" href="../public/css/customer/sidebar.css">
    <link rel="stylesheet" href="../public/css/customer/orderdetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
    <section id="sidebar">
        <a href="../customer/dashboard.php" class="brand">
            <img src="../public/img/logo.png" alt="MedLinkup Logo" class="logo">
            <span class="text"> MedLinkup</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="../customer/dashboard.php">
                    <i class='fas fa-clone'></i>
                    <span class="text"> Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='fas fa-portrait'></i>
                    <span class="text"> Profile</span>
                </a>
                <ul class="submenu">
                    <li><a href="../customer/myprofile.php">My Profile</a></li>
                    <li><a href="../customer/delivery.php">Delivery Address</a></li>

                </ul>
            </li>

            <li>
                <a href="../cart.php">
                    <i class='fas fa-cart-plus'></i>
                    <span class="text"> Cart</span>
                </a>
            </li>
            <li class="active">
                <a href="../customer/order.php">
                    <i class='fas fa-cart-arrow-down'></i>
                    <span class="text">Order</spvan>
                </a>
            </li>
            <li>
                <a href="../customer/history.php">
                    <i class='fas fa-shopping-basket'></i>
                    <span class="text"> History</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='fa fa-cogs'></i>
                    <span class="text"> Settings</span>
                </a>
                <ul class="submenu">
                    <li><a href="../customer/changepassword.php">Change Password</a></li>
                </ul>
            </li>
            <li>
                <a href="../index.php">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="text"> Continue Shopping</span>
                </a>
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
    <?php
    include '../src/config/config.php';
    session_start();

    if (!isset($_SESSION['userid'])) {
        header("Location: ../auth/login.php");
        exit();
    }

    if (isset($_GET['transactionid'])) {
        $transactionid = $_GET['transactionid'];

        $query = "SELECT 
            o.transactionid,
            u.username, 
            p.productid,
            p.productname, 
            p.price, 
            p.image,
            o.quantity, 
            o.shippingfee,
            o.totalproductprice,
            o.totalprice, 
            o.orderdate, 
            o.ordercompleted,
            o.status, 
            o.paymentmethod,
            o.quantity,
            CONCAT(s.firstname, ' ', s.lastname) AS flname,
            CONCAT(s.addressline1, ', ', s.addressline2, ', ', s.city, ', ', s.province, ', ', s.country) AS address 
        FROM 
            orderprocess o
        JOIN 
            users u ON o.userid = u.userid
        JOIN 
            products p ON o.productid = p.productid
        JOIN 
            shippingaddresses s ON o.addressid = s.addressid
        WHERE 
            o.transactionid = '$transactionid'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $transactionDetails = mysqli_fetch_assoc($result); // Fetch the transaction details
    ?>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="pending-section">
                        <h1 class="lefth">Order Details</h1>
                        <?php
                            if (!empty($transactionDetails['status']) && $transactionDetails['status'] === 'Completed') {
                            echo '<button class="printReceipt" data-transactionid="' . $transactionid . '">Print Receipt</button>';
                            }
                            ?>
                        <div class="customerinformation">
                            <p><strong>Name:</strong> <?php echo $transactionDetails['flname']; ?></p>
                            <p><strong>Username:</strong> <?php echo $transactionDetails['username']; ?></p>
                            <p><strong>Shipping Address:</strong> <?php echo $transactionDetails['address']; ?></p>
                        </div>
                        <hr>

                        <?php
                            mysqli_data_seek($result, 0); 
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                        <a href="../product.php?id=<?php echo $row['productid']; ?>"
                            style="text-decoration: none; color: inherit;">
                            <div class="product-box">
                                <div class="product-details">
                                    <img src="../productimg/<?php echo $row['image']; ?>"
                                        alt="<?php echo $row['productname']; ?>" class="product-image">
                                    <div class="product-info">
                                        <div class="product-name"><?php echo $row['productname']; ?></div>
                                        <div class="product-status">Quantity: <span
                                                class="status <?php echo strtolower($row['quantity']); ?>"><?php echo $row['quantity']; ?></span>
                                        </div>
                                        <div class="product-price price">₱<?php echo $row['price']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                            ?>

                        <hr>
                        <div class="transactiondetails">
                            <p><strong>Transaction ID:</strong> <?php echo $transactionDetails['transactionid']; ?></p>
                            <p><strong>Merchandise Subtotal:</strong>
                                ₱<?php echo $transactionDetails['totalproductprice']; ?></p>
                            <p><strong>Shipping Fee:</strong> ₱<?php echo $transactionDetails['shippingfee']; ?></p>
                            <p><strong>Order Total:</strong> ₱<?php echo $transactionDetails['totalprice']; ?></p>
                            <p><strong>Payment Method:</strong> <?php echo $transactionDetails['paymentmethod']; ?></p>
                            <p><strong>Order Date:</strong> <?php echo $transactionDetails['orderdate']; ?></p>
                            <?php if (!empty($transactionDetails['ordercompleted'])): ?>
                            <p><strong>Order Completed:</strong> <?php echo $transactionDetails['ordercompleted']; ?>
                            </p>
                            <?php endif; ?>
                            <p><strong>Status: </strong><?php echo $transactionDetails['status']; ?></p>

                        </div>

                    </div>
                </div>

            </div>


        </div>

    </main>
    <?php
    } else {
        echo "<p>No products found for this order.</p>";
    }
} else {
    echo "<p>Transaction ID not provided.</p>";
}
?>





    <!-- node -->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script>
    $(document).ready(function() {
        $(".printReceipt").click(function(e) {
            e.preventDefault();
            var transactionid = $(this).data("transactionid");
            window.open('orderreceipt.php?transactionid=' + transactionid, '_blank',
                'width=800,height=600');
        });
    });
    </script>

</body>

</html>