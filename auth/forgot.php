<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/index/nav.css">
    <link rel="stylesheet" href="../public/css/auth/forgotpassword.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
   
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../public/img/logo.png" alt="Pharmawell Logo" class="logo"> Pharmawell
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../shop.php">Shop</a>
                    </li>
                </ul>
                <div class="navbar-icons d-flex align-items-center">
                    <a href="../auth/login.php" class="nav-link"><i class="fas fa-user"></i> Login </a>
                    <a href="../cart.php" class="nav-link"><i class="fas fa-shopping-cart"></i> Cart </a>
                </div>
            </div>
        </div>
        </nav>
    <main>
        <section class="forgot-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="logoforgot text-center">
                            <img src="../public/img/Auth/CoverRegistration.png" alt="Logo" class="img-fluid custom-image">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h1>Forgot Password</h1>
                        <p>Enter your email to receive the reset link.</p>

                        <form action="#" method="POST" class="needs-validation" novalidate>
                            <div class="row">
                                
                            </div>
                     
                            <div class="mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                <div class="invalid-feedback">Please enter your email.</div>
                            </div>
                   
                            <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
                        </form>
    
                        <div class="signup-link text-center">
                            Remember you're password? <a href="../auth/login.php">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <section class="design-element">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Our Mission</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec dictum nunc. Nullam vitae
                        ligula sed nisi sagittis facilisis vitae nec velit. Integer scelerisque magna sit amet dui
                        suscipit, sed aliquam nunc scelerisque.</p>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <p>
                &copy; 2024 Pharmawell. All rights reserved. |
                <a href="../privacypolicy.php">Privacy Policy</a> | <a href="../termsofservice.php">Terms of Service</a>
                </p>
        </div>
    </footer>   



    <!-- node -->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    
</body>

</html>