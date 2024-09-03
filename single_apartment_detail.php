<?php
session_start();
include 'utility/connection.php';
// Process the booking form submission
if (isset($_POST['book'])) {
    if (isset($_SESSION['normalUsername'])) {
        $clientUserName = $_SESSION['normalUsername'];
        $id = intval($_GET['id']); // Ensure $id is sanitized

        // Update the booking status
        $setBooking = "UPDATE `apartment_details` SET `booking_status`='booked', `booked_by`='$clientUserName' WHERE `id` = $id";
        $setBookingExe = mysqli_query($con, $setBooking);

        if ($setBookingExe) {
            echo "<script>alert('Booking Successfull.')</script>";
            echo "<script>location.replace('single_apartment_detail.php?id={$id}')</script>";
        } else {
            echo "<script>alert('Booking Failed. Try Again')</script>";
        }
    } else {
        ?>
        <script>
            alert('You need to log in first');
            location.replace('login.php');
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartment Detail</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Parent Div taking 100% width -->
    <div class="main-section">
        <div class="container">
            <!-- Responsive Navbar -->
            <nav class="navbar navbar-expand-lg sticky-header">
                <a class="navbar-brand" href="index.php">Sweet Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Go to Home
                                Page</a>
                        </li>
                        <li class="nav-item">

                            <?php
                            if (isset($_SESSION['normalUsername'])) {
                                $clientUserName = $_SESSION['normalUsername'];
                                echo "<p class=' ms-lg-3'>" . $clientUserName . " <a href='logout.php' class='btn btn-danger mx-2'>Logout</a></p>";
                            } else {
                                echo "<a href='login.php'><button class='btn btn-primary ms-lg-3'>Login</button></a>";
                            }
                            ?>

                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <!-- Apartment Detail Section -->
    <section class="apartment-detail-section-custom py-5">
        <div class="container">
            <div class="row">
                <?php
                $id = intval($_GET['id']);

                // Prepare and execute the SQL query
                $getApartmentDetails = "SELECT * FROM `apartment_details` WHERE `id` = $id";
                $getApartmentDetailsExe = mysqli_query($con, $getApartmentDetails);

                // Check if query execution was successful
                if (!$getApartmentDetailsExe) {
                    die("Query failed: " . mysqli_error($con));
                }

                // Fetch the result
                $res = mysqli_fetch_assoc($getApartmentDetailsExe);

                // Check if any result was returned
                if ($res) {
                    ?>
                    <div class="col-lg-8">
                        <div class="apartment-carousel-custom">
                            <img src="<?php echo htmlspecialchars($res['image_link']); ?>" alt="Apartment Image"
                                class="img-fluid">
                        </div>
                        <h2 class="apartment-title-custom mt-4">Total Rooms:
                            <?php echo htmlspecialchars($res['total_room_number']); ?>
                        </h2>
                        <h4 class="apartment-title-custom mt-4">Total Bedrooms:
                            <?php echo htmlspecialchars($res['total_bedroom_number']); ?>
                        </h4>
                        <p class="apartment-location-custom"><strong>Location:</strong>
                            <?php echo htmlspecialchars($res['district']); ?>,
                            <?php echo htmlspecialchars($res['division']); ?>
                        </p>
                        <p class="apartment-size-custom"><strong>Size:</strong>
                            <?php echo htmlspecialchars($res['size']); ?> sqft</p>
                        <p class="apartment-description-custom">This luxury apartment features modern amenities and a
                            spacious layout, ideal for families. It is located in the heart of
                            <?php echo htmlspecialchars($res['district']); ?>, offering easy access to schools, shopping
                            centers, and public transport.
                        </p>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-card-custom p-4">
                            <h4>Contact Information</h4>
                            <p><strong>Address:</strong> <?php echo htmlspecialchars($res['full_address']); ?></p>
                            <p><strong>Phone:</strong> <?php echo htmlspecialchars($res['contact_number']); ?></p>
                            <?php
                            if ($res['booking_status'] == 'booked') {
                                echo '<button class="btn btn-success btn-block mt-3" disabled>Already Booked</button>';
                            } else {
                                ?>
                                <form method="POST">
                                    <button name="book" class="btn btn-primary btn-block mt-3">Book Now</button>
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "<p>No apartment details found.</p>";
                }

                // Close the connection
                mysqli_close($con);
                ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="container">
            <p>Project of Fahmida Mahbub<br>Supervised by Abdullah Mohammad Galib</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>