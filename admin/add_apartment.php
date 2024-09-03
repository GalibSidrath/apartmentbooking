<?php
session_start();
if (!$_SESSION['adminUsername']) {
    ?>
        <script>location.replace('../login.php');</script>
    <?php
}
include "../utility/connection.php";
include "../utility/districts.php";
include "../utility/division.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Apartment</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Add New Apartment Form Section -->
    <div class="container my-5">
        <h2 class="apartment-form-heading mb-4">Add New Apartment</h2>
        <form class="apartment-form" method="POST">
            <div class="form-group">
                <label for="apartmentSize">Size in sqft</label>
                <input name="size" class="form-control apartment-form-control" id="apartmentSize"
                    placeholder="Enter size in sqft" required>
            </div>
            <div class="form-group">
                <label for="apartmentTotalRooms">Total Room Number</label>
                <input name="room" type="text" class="form-control apartment-form-control" id="apartmentTotalRooms"
                    placeholder="Enter total room number" required>
            </div>
            <div class="form-group">
                <label for="apartmentTotalBedrooms">Total Bedroom Number</label>
                <input name="bedroom" type="number" class="form-control apartment-form-control" id="apartmentTotalBedrooms"
                    placeholder="Enter total bedroom number" required>
            </div>
            <div class="form-group">
                <label for="apartmentThana">Division</label>
                <select name="division" class="form-control apartment-form-control" id="apartmentThana" required>
                <?php
                    for ($i = 0; $i < 8; $i++) {
                        ?>
                        <option value="<?php echo $divisions[$i]; ?>"><?php echo $divisions[$i]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="apartmentDistrict">District</label>
                <select name="district" class="form-control apartment-form-control" aria-placeholder="Select Districts"
                    id="apartmentDistrict" required>
                    <?php
                    for ($i = 0; $i < 63; $i++) {
                        ?>
                        <option value="<?php echo $districts[$i]; ?>"><?php echo $districts[$i]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="apartmentSize">Apartment image</label>
                <input name="img" type="text" class="form-control apartment-form-control" id="apartmentSize"
                    placeholder="Enter the image link" required>
            </div>
            <div class="form-group">
                <label for="apartmentSize">Contact Number</label>
                <input name="contact" type="text" class="form-control apartment-form-control" id="apartmentSize"
                    placeholder="Enter contact number" required>
            </div>
            <div class="form-group">
                <label for="apartmentFullAddress">Full Address</label>
                <textarea name="address" class="form-control apartment-form-control" id="apartmentFullAddress" rows="3"
                    placeholder="Enter full address" required></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary apartment-submit-btn">Add Apartment</button>
        </form>
    </div>
</body>

</html>

<?php 
    if (isset($_POST["submit"])) {
        $size = $_POST['size'];
        $room = $_POST['room'];
        $bedroom = $_POST['bedroom'];
        $division = $_POST['division'];
        $district = $_POST['district'];
        $img = $_POST['img'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];

        $insertAppartmentQuery = "INSERT INTO `apartment_details`(`size`, `total_room_number`, `total_bedroom_number`, `division`, `district`, `image_link`, `full_address`, `booking_status`, `contact_number`) VALUES ('$size',$room,$bedroom,'$division','$district','$img','$address','available','$contact')";

        $insertAppartmentQueryExe = mysqli_query($con, $insertAppartmentQuery);

        if ($insertAppartmentQueryExe) {
            ?>
                <script>
                    alert('Successfully added new apartmet details');
                    location.replace('all_apartment_details.php');
                </script>
            <?php
        }else {
            ?>
                <script>
                    alert('Something went wrong. Please try again');
                </script>
            <?php
        }
    }
?>