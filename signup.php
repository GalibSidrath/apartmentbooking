<?php 
    include 'utility/connection.php';
    include 'utility/districts.php';
    include 'utility/division.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="body-signup">
    <div class="signup-container d-flex align-items-center justify-content-center">
        <div class="signup-form">
            <h2 class="text-center">Sign Up</h2>
            <form method="POST">
                <div class="form-group mb-3">
                    <input name="fullname" type="text" class="form-control" id="fullName" placeholder="Full Name" required>
                </div>
                <div class="form-group mb-3">
                    <input name="username" type="text" class="form-control" id="username" placeholder="Username" required>
                </div>
                <div class="form-group mb-3">
                    <input name="email" type="email" class="form-control" id="email" placeholder="Email" required>
                </div>
                <div class="form-group mb-3">
                    <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
                </div>
                <div class="form-row mb-4">
                    <div class="form-group col-md-6">
                        <select name="division" class="form-select" id="thana" required>
                        <option selected disabled>Select Division</option>
                            <?php 
                                for ($i=0; $i < 8; $i++) { 
                                    ?>
                                    <option value="<?php echo $divisions[$i] ?>"><?php echo $divisions[$i] ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <select name="district" class="form-select" id="district" required>
                        <option selected disabled>Select District</option>
                            <?php 
                                for ($i=0; $i < 63; $i++) { 
                                    ?>
                                    <option value="<?php echo $districts[$i] ?>"><?php echo $districts[$i] ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <button name="submit" type="submit" class="btn btn-primary btn-block signup-btn">Sign Up</button>
                <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $division = $_POST['division'];
        $district = $_POST['district'];

        $encryptPass = password_hash($password, PASSWORD_BCRYPT);

        $checkEmailQuery = "SELECT * FROM `user` WHERE email = '$email'";
        $checkEmailQueryExe = mysqli_query($con, $checkEmailQuery);

        if (mysqli_num_rows($checkEmailQueryExe) > 0){
            ?>
                <script>alert('Email already in use. Try again with another email')</script>
            <?php
        } else{
            $registerUserQuery = "INSERT INTO `user`(`username`, `email`, `password`, `division`, `district`) VALUES ('$username','$email','$encryptPass','$division','$district')";
            $registerUserQueryExe = mysqli_query($con, $registerUserQuery);
            if($registerUserQueryExe){
                ?>
                    <script>
                        alert('Account created successfylly!');
                        location.replace('login.php');
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
    }
?>