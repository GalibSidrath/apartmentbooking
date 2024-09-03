<?php 
session_start();
if (!$_SESSION['adminUsername']) {
    ?>
        <script>location.replace('../login.php');</script>
    <?php
}
include '../utility/connection.php';
    $id = $_GET['id'];
    $deleteApartmentQuery = "DELETE FROM `apartment_details` WHERE id = $id";
    $deleteApartmentQueryExe = mysqli_query($con, $deleteApartmentQuery);
    if ($deleteApartmentQueryExe) {
        ?>
            <script>
                alert('Apartment details deleted!');
                location.replace('all_apartment_details.php');
            </script>
        <?php
    }else {
        ?>
            <script>
                alert('Failed to delete apartment details. Please try again');
                location.replace('all_apartment_details.php');
            </script>
        <?php
    }
?>