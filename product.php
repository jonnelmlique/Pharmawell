<?php

session_start();

$message = '';

$loginLinkText = '<i class="fas fa-user"></i> Login';
$loginLinkURL = './auth/login.php';

if (isset($_SESSION['userid']) && isset($_SESSION['username'])) {
    $loggedInUsername = $_SESSION['username'];
    $loginLinkText = '<i class="fas fa-user"></i> ' . $loggedInUsername;
    $loginLinkURL = './customer/dashboard.php';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="./public/css/index/nav.css">
    <link rel="stylesheet" href="./public/css/index/product.css">
    <link href="./node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="./index.php">
                <img src="./public/img/logo.png" alt="MedLinkup Logo" class="logo"> MedLinkup
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./shop.php">Shop</a>
                    </li>
                </ul>
                <div class="navbar-icons d-flex align-items-center">
                    <a href="<?php echo $loginLinkURL; ?>" class="nav-link">
                        <?php echo $loginLinkText; ?>
                    </a>
                    <a href="./cart.php" class="nav-link"><i class="fas fa-shopping-cart"></i> Cart </a>
                </div>
            </div>
        </div>
    </nav>

    <?php
    include './src/config/config.php';

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $product_id = $_GET['id'];
        try {
            $sql = "SELECT productname, price, productdetails, image, stock FROM products WHERE productid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
    <div class="container product-details">
        <div class="row">
            <div class="col-md-6 product-details-img">
                <img src="./productimg/<?php echo $row["image"]; ?>" alt="Product Image">
            </div>
            <div class="col-md-6">
                <h2 class="product-details-title">
                    <?php echo $row["productname"]; ?>
                </h2>
                <p class="product-details-price">₱
                    <?php echo $row["price"]; ?>
                </p>
                <!-- <p class="product-details-description"><?php echo $row["productdetails"]; ?></p> -->
                <p class="product-stock">Stock:
                    <?php echo $row["stock"]; ?>
                </p>

                <div class="form-group">
                    <input class="quantity-input" type="number" class="form-control form-control-sm" id="quantity"
                        value="1" min="1" style="width: 100px;">
                    <button class="btn btn-primary" id="addToCartBtn">Add to Cart</button>
                </div>
                <div class="ull">
                    <hr>
                    <?php
                                $usage_data = explode("\n", $row["productdetails"]);
                                ?>
                    <ul class="uldisplay">
                        <?php foreach ($usage_data as $usage_point): ?>
                        <li>
                            <?php echo $usage_point; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                </div>


            </div>
        </div>
    </div>
    <hr>
    <?php
            } else {
                echo "Product not found.";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        $stmt->close();
    } else {
        echo "Invalid product ID.";
    }

    ?>
    <div class="product-section">
        <div class="container">
            <h3 class="mb-4">Other Products</h3>
            <div class="row">
                <div id="productContainer" class="row">

                    <?php

                    try {
                        $sql = "SELECT productid, productname, price, image 
                        FROM products 
                        ORDER BY RAND() 
                        LIMIT 10";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                $productName = strlen($row["productname"]) > 35 ? substr($row["productname"], 0, 35) . '...' : $row["productname"];

                                ?>
                    <div class="col-md-15">
                        <a href="./product.php?id=<?php echo $row["productid"]; ?>" class="product-card-link">

                            <div class="product-card">
                                <img src="./productimg/<?php echo $row["image"]; ?>" alt="Product Image" />
                                <div class="product-card-body">
                                    <h3 class="product-card-title">
                                        <?php echo $productName; ?>
                                    </h3>

                                    <p class="product-card-price">₱
                                        <?php echo $row["price"]; ?>
                                    </p>
                                </div>
                        </a>
                    </div>
                </div>
                <?php
                            }
                        } else {
                            echo "No products available.";
                        }
                    } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                    }

                    $conn->close();
                    ?>


            </div>
        </div>
    </div>

    </div>
    <section class="design-element">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Our Mission</h3>
                    <p>Empowering health through easy access to medications. Your trusted online platform for quality
                        pharmaceuticals.</p>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <p>
                &copy; 2024 MedLinkup. All rights reserved. |
                <a href="./privacypolicy.php">Privacy Policy</a> | <a href="./termsofservice.php">Terms of Service</a>
            </p>
        </div>
    </footer>

    <!-- node -->
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="./public/js/index/productcart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    var productId = <?php echo json_encode($product_id); ?>;

    document.getElementById("addToCartBtn").addEventListener("click", addToCart);

    function addToCart() {
        var quantity = document.getElementById("quantity").value;

        $.ajax({
            type: "POST",
            url: "./addToCart.php",
            data: {
                productId: productId,
                quantity: quantity
            },
            success: function(response) {
                if (response.message === "success") {
                    Swal.fire({
                        title: 'Cart Updated',
                        text: 'You have successfully updated the item in your cart.',
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'OK',
                        cancelButtonText: 'View Cart'
                    }).then((result) => {
                        if (result.isConfirmed) {

                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            window.location.href = './cart.php';
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    }
    </script>



</body>

</html>