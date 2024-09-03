<?php 
    session_start();
    if (!$_SESSION['adminUsername']) {
        ?>
            <script>location.replace('../login.php');</script>
        <?php
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Sticky Header -->
    <div class="admin-header sticky-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <!-- Logo on the Left -->
                <a class="navbar-brand" href="index.php">Sweet Home</a>

                <!-- Navbar Toggler for Mobile View -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Menu in the Middle -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="all_bookings.php">All Bookings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="all_apartment_details.php">All Apartment Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="all_user.php">All Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="all_admin.php">Admins</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="message.php">Messages</a>
                        </li>
                    </ul>
                </div>

                <!-- Admin Username and Logout Button on the Right -->
                <div class="d-flex align-items-center">
                    <span class="me-3 px-3"><?php 
                        echo $_SESSION['adminUsername'];
                    ?></span>
                    <a href="logout.php"><button class="btn btn-outline-danger">Logout</button></a>
                </div>
            </nav>
        </div>
    </div>


    <!-- Card Widgets Section -->
    <div class="container mt-5">
        <div class="row">
            <!-- Card for All Bookings -->
            <div class="col-md-6 mb-4">
                <a href="all_bookings.php" class="card admin-card text-center text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">All Bookings</h5>
                    </div>
                </a>
            </div>

            <!-- Card for All Apartment Details -->
            <div class="col-md-6 mb-4">
                <a href="all_apartment_details.php" class="card admin-card text-center text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">All Apartment Details</h5>
                    </div>
                </a>
            </div>

            <!-- Card for All Users -->
            <div class="col-md-6 mb-4">
                <a href="all_user.php" class="card admin-card text-center text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">All Users</h5>
                    </div>
                </a>
            </div>

            <!-- Card for Admins -->
            <div class="col-md-6 mb-4">
                <a href="all_admin.php" class="card admin-card text-center text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">Admins</h5>
                    </div>
                </a>
            </div>

            <!-- Card for Messages -->
            <div class="col-md-6 mb-4">
                <a href="message.php" class="card admin-card text-center text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">Messages</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>