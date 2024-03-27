<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Categories</title>
    <link rel="stylesheet" href="../public/css/admin/sidebar.css">
    <link rel="stylesheet" href="../public/css/admin/addcategories.css">
    <!-- <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
   
</head>

<body>

    <section id="sidebar">
        <a href="../supplier/dashboard.php" class="brand">
            <img src="../public/img/logo.png" alt="Pharmawell Logo" class="logo">
            <span class="text"> Pharmawell</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="../admin/dashboard.php">
                    <i class='fas fa-clone' ></i>
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
                <a href="#">
                    <i class='fas fa-shopping-bag' ></i>
                    <span class="text"> Orders</span>
                </a>
                <ul class="submenu">
                    <li><a href="../admin/pending.php">Pending</a></li>
                    <li><a href="../admin/completed.php">Completed</a></li>
                </ul>
            </li>
            <li>
                <a href="../admin/sales.php">
                    <i class='fas fa-chart-bar' ></i>
                    <span class="text"> Sales</span>
                </a>
            </li>
            <li>
                <a href="../admin/customer.php">
                    <i class='fas fa-portrait' ></i>
                    <span class="text"> Customers</span>
                </a>
            </li>
            <li>
             <a href="#">
                    <i class='fas fa-clone' ></i>
                    <span class="text"> Supplier</span>
                </a>
                <ul class="submenu">
                    <li><a href="../public/Shared/Layout/error.php">Order</a></li>
                    <li><a href="../public/Shared/Layout/error.php">Pending Order</a></li>
                    <li><a href="../public/Shared/Layout/error.php">Completed Order</a></li>
                    <li><a href="../public/Shared/Layout/error.php">Add Supplier</a></li>
                </ul>
            </li>

        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='fa fa-cogs' ></i>
                    <span class="text"> Settings</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout">
                    <i class='fas fa-user' ></i>
                    <span class="text"> Logout</span>
                </a>
            </li>
        </ul>
    </section>

    <section id="content">
    <nav>
        <i class='fa-pills' ></i>
        <a href="#" class="profile">
            <img src="https://i.pinimg.com/originals/f1/0f/f7/f10ff70a7155e5ab666bcdd1b45b726d.jpg">
        </a>
    </nav>
    </section>


    <main>
        <div class="box-section">

            <div class="head-title">
                <div class="left">
                    <h1 class="lefth">Edit Category</h1>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="add-category-section">
                            <div id="image-container">
                                <div id="preview-image">
                                    <img src="https://via.placeholder.com/350x350" alt="Preview Image">
                                </div>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                    onchange="previewImage(event)" required>
                            </div>
                            <div id="form-container">
                                <form action="#" method="POST" class="needs-validation" novalidate>
                                    <div class="mb-3">
                                        <label for="categoryname">Category Name</label>
                                        <input type="text" class="form-control" id="categoryname" name="categoryname"
                                            placeholder="Category Name" required>
                                    </div>
                                    <button type="submit" class="btn btn-submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </main>


    <!-- node -->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>