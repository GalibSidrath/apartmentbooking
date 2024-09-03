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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
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

    <!-- All Bookings Table Section -->
    <div class="container mt-5">
        <h2 class="mb-4">All Bookings</h2>

        <table id="bookingsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Apartment Location</th>
                    <th>Thana</th>
                    <th>District</th>
                    <th>Booked By</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include '../utility/connection.php';
                    $searchAllBookings = "SELECT * FROM `apartment_details` WHERE booking_status = 'booked' ";
                    $searchAllBookingsExe = mysqli_query($con, $searchAllBookings);
                    while ($booking = mysqli_fetch_array($searchAllBookingsExe)){
                        ?>
                            <tr>
                                <td><?php echo $booking['full_address'] ?></td>
                                <td><?php echo $booking['division'] ?></td>
                                <td><?php echo $booking['district'] ?></td>
                                <td><?php echo $booking['booked_by'] ?></td>
                            </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#bookingsTable').DataTable();
        });
    </script>
</body>

</html>