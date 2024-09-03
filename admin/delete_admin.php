<?php 
    session_start();
    if (!$_SESSION['adminUsername']) {
        ?>
            <script>location.replace('../login.php');</script>
        <?php
    }
    include '../utility/connection.php';
    $id = $_GET['id'];
    $deleteAdminQuery = "DELETE FROM `admin` WHERE id = $id";
    $deleteAdminQueryExe = mysqli_query( $con, $deleteAdminQuery );
    if ($deleteAdminQueryExe) {
        ?>
            <script>
                alert('Admin deleted!');
                location.replace('all_admin.php');
            </script>
        <?php
    }else {
        ?>
            <script>
                alert('Failed to delete! Try again');
                location.replace('all_admin.php');
            </script>
        <?php
    }
?>