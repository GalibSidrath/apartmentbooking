<?php
session_start();
include 'utility/connection.php';
include 'utility/districts.php';
include 'utility/division.php';
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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about-section">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact-section">Contact</a>
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

    <!-- Main Content -->
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="overlay"></div>
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col text-center text-white">
                    <h1 class="hero-text">Your new home in your hand!</h1>
                    <form class="search-form mt-4" method="POST">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <select class="form-select" name="bedrooms" aria-label="Size">
                                    <option selected>Size</option>
                                    <option value="1">1 Bedroom</option>
                                    <option value="2">2 Bedrooms</option>
                                    <option value="3">3 Bedrooms</option>
                                    <option value="4">4+ Bedrooms</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select name="district" class="form-select" aria-label="Distric">
                                    <option selected disabled>Distric</option>
                                    <?php
                                    for ($i = 0; $i < 63; $i++) {
                                        ?>
                                        <option value="<?php echo $districts[$i] ?>"><?php echo $districts[$i] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select name="division" class="form-select" aria-label="Thana">
                                    <option selected disabled>Division</option>
                                    <?php
                                    for ($i = 0; $i < 8; $i++) {
                                        ?>
                                        <option value="<?php echo $divisions[$i] ?>"><?php echo $divisions[$i] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <button name="search" type="submit" class="btn btn-search w-100">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Recommended For You Section -->
    <section class="recommended-section mt-5">
        <div class="container">
            <h2 class="section-heading">Recommended For You</h2>
            <div class="slick-slider">
                <!-- Slider Elements (Cards) -->
                <?php
                if (isset($_SESSION["normalUsername"])) {
                    $clientUserName = $_SESSION["normalUsername"];
                    $searchingForClient = "SELECT * FROM `user` WHERE username = '$clientUserName'";
                    $searchingForClientExe = mysqli_query($con, $searchingForClient);
                    $res = mysqli_fetch_array($searchingForClientExe);
                    $clientDistrict = $res["district"];
                    $clientDivision = $res["division"];
                    $searchApartment = "SELECT * FROM `apartment_details` WHERE `division` = '$clientDivision' AND `district` = '$clientDistrict' LIMIT 15";
                    $searchApartmentExe = mysqli_query($con, $searchApartment);
                    while ($res = mysqli_fetch_array($searchApartmentExe)) {
                        ?>
                        <div class="card">
                            <img src="<?php echo $res['image_link'] ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $res['size'] ?> sqft</h5>
                                <p class="card-text"><?php echo $res['full_address'] ?></p>
                                <a href="single_apartment_detail.php?id=<?php echo $res['id'] ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    $defaultApartmentSearch = "SELECT * FROM `apartment_details` ORDER BY `id` DESC LIMIT 15";
                    $defaultApartmentSearchExe = mysqli_query($con, $defaultApartmentSearch);
                    while ($res = mysqli_fetch_array($defaultApartmentSearchExe)) {
                        ?>
                        <div class="card">
                            <img src="<?php echo $res['image_link'] ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $res['size'] ?> sqft</h5>
                                <p class="card-text"><?php echo $res['full_address'] ?></p>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-us-section mt-5" id="about-section">
        <div class="container">
            <h2 class="section-heading">About Us</h2>
            <p class="about-text">
                Welcome to Sweet Home, where we help you find the perfect apartment for you and your family. We are
                committed to providing exceptional service and a seamless experience in your apartment search. Our team
                works tirelessly to ensure that you have access to the best properties available.
            </p>
            <p class="about-text">
                At Sweet Home, we prioritize your needs and preferences. Whether you're looking for a cozy studio or a
                spacious family home, we have a wide range of options to fit your lifestyle. Our user-friendly platform
                allows you to browse listings, compare options, and make informed decisions with ease.
            </p>
            <!-- Add more paragraphs as needed -->
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="contact-us-section mt-5" id="contact-section">
        <div class="container">
            <h2 class="section-heading">Contact Us</h2>
            <div class="row">
                <!-- Left Section -->
                <div class="col-md-6 contact-info">
                    <p><strong>Address:</strong> 1234 Sweet Home St, Apartment City, AP 56789</p>
                    <p><strong>Phone:</strong> +123 456 7890</p>
                    <p><strong>Email:</strong> contact@sweethome.com</p>
                </div>
                <!-- Right Section -->
                <div class="col-md-6 contact-form">
                    <h4>Send Us a Message</h4>
                    <form method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea name="message" class="form-control" id="message" rows="4"
                                placeholder="Your Message"></textarea>
                        </div>
                        <button name="sendmsg" type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
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
    <!-- Include Slick Slider JS -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.slick-slider').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: true,
                dots: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        });
    </script>


</body>

</html>

<?php
if (isset($_POST['sendmsg'])) {
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sendMessage = "INSERT INTO `contact_message`(`email`, `message`) VALUES ('$email','$message')";
    $sendMessageExe = mysqli_query($con, $sendMessage);

    if ($sendMessageExe) {
        ?>
        <script>
            alert('Your messege successfully sent to the authority. Please wait for a replay.Thank you!');
        </script>
        <?php
        exit();
    }
}
?>
<?php
if (isset($_POST["search"])) {
    $bedrooms = urlencode($_POST['bedrooms']); 
    $division = urlencode($_POST['division']);
    $district = urlencode($_POST['district']);

    // Redirect with JavaScript
    echo "<script>
    location.replace('home_search_result.php?bedrooms={$bedrooms}&division={$division}&district={$district}');
    </script>";
}
?>