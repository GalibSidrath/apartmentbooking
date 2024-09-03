<?php 
    session_start();
    include 'utility/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="js/slick.css">
    <link rel="stylesheet" href="js/slick-theme.css">
    <link rel="stylesheet" href="style.css"> <!-- Link to the external CSS file -->
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
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Go to Home</a>
                        </li>
                        <li class="nav-item">
                            
                            <?php 
                                if (isset($_SESSION['normalUsername'])) {
                                    $clientUserName = $_SESSION['normalUsername'];
                                    echo "<p class=' ms-lg-3'>".$clientUserName." <a href='logout.php' class='btn btn-danger mx-2'>Logout</a></p>";
                                }else {
                                    echo "<a href='login.php'><button class='btn btn-primary ms-lg-3'>Login</button></a>";
                                }
                            ?>
                            
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>


    <!-- Search Results Section -->
    <section class="search-results-updated py-5">
        <div class="container">
            <?php 
                $bedrooms = $_GET['bedrooms'];
                $division = $_GET['division'];
                $district = $_GET['district'];
            ?>
            <h2 class="section-heading">Search Results...</h2>
            <div class="row">
                <?php 
                    $SearchQuery;
                    if ($bedrooms > 3) {
                        $SearchQuery = "SELECT * FROM `apartment_details` WHERE `total_bedroom_number` > 3 AND `district` = '$district' AND `division` = '$division'";
                    }else {
                        $SearchQuery = "SELECT * FROM `apartment_details` WHERE `total_bedroom_number` = $bedrooms AND `district` = '$district' AND `division` = '$division'";
                    }
                    $SearchQueryExe = mysqli_query($con, $SearchQuery);
                    while ($row = mysqli_fetch_array($SearchQueryExe)) {
                        ?>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card custom-card-updated">
                                    <img src="<?php echo $row['image_link'] ?>" class="card-img-top" alt="Apartment 1">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['size'] ?> sqft</h5>
                                        <p class="card-text">Total Rooms: <?php echo $row['total_room_number'] ?> <br> Total Bedrooms: <?php echo $row['total_bedroom_number'] ?> <br><?php echo $row['district'] ?>, <?php echo $row['division'] ?> </p>
                                        <a href="single_apartment_detail.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </section>








    <!-- Footer Section -->
    <footer class="footer-section">
        <div class="container">
            <p>Project of Fahmida Mahbub<br>Supervised by Abdullah Mohammad Galib</p>
        </div>
    </footer>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>

</html>