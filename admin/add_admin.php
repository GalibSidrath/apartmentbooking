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
    <title>Add New Admin</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Add New Admin Form Section -->
    <div class="container mt-5">
        <h2 class="admin-form-heading mb-4">Add New Admin</h2>
        <form class="admin-form" method="POST">
            <div class="form-group">
                <label for="adminUserName">User Name</label>
                <input name="username" type="text" class="form-control admin-form-control" id="adminUserName" placeholder="Enter user name" required>
            </div>
            <div class="form-group">
                <label for="adminEmail">Email</label>
                <input name="email" type="email" class="form-control admin-form-control" id="adminEmail" placeholder="Enter email address" required>
            </div>
            <div class="form-group">
                <label for="adminPassword">Password</label>
                <input name="password" type="password" class="form-control admin-form-control" id="adminPassword" placeholder="Enter password" required>
            </div>
            <button name="submit" type="submit" class="btn btn-primary admin-submit-btn">Add Admin</button>
        </form>
    </div>
</body>
</html>

<?php 
    include '../utility/connection.php';
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $encryptPass = password_hash($password, PASSWORD_BCRYPT);

        $registerAdminQuery = "INSERT INTO `admin`(`username`, `email`, `password`) VALUES ('$username','$email','$encryptPass')";
        $registerAdminQueryExe = mysqli_query($con, $registerAdminQuery);

        if ($registerAdminQueryExe) {
            ?>
                <script>
                    alert('Admin added!');
                    location.replace('all_admin.php');
                </script>
            <?php
        }else {
            ?>
                <script>
                    alert('Failed! Try again');
                </script>
            <?php
        }
    }
?>
