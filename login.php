<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="body-login">
    <div class="login-container d-flex align-items-center justify-content-center">
        <div class="login-form">
            <h2 class="text-center">Login</h2>
            <form method="POST">
                <div class="form-floating mb-3">
                    <input name="email" type="email" class="form-control" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form-floating mb-3">
                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group mb-4">
                    <label class="form-label">User Type:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="userType" id="normalUser" value="normal" checked>
                        <label class="form-check-label" for="normalUser">
                            Normal User
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="userType" id="admin" value="admin">
                        <label class="form-check-label" for="admin">
                            Admin
                        </label>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block login-btn">Login</button>
                <p class="mt-3 text-center">Don't have an account? <a href="signup.php">Sign up</a></p>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
    include 'utility/connection.php';
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $userType = $_POST['userType'];

        //if it is a normal user
        if ($userType == 'normal') {
            $findUserQuery = "SELECT * FROM `user` WHERE email = '$email'";
            $findUserQueryExe = mysqli_query($con, $findUserQuery);
            //checking user exist in database
            if (mysqli_num_rows($findUserQueryExe) > 0){
                //if exist then verifying password
                $res = mysqli_fetch_array($findUserQueryExe);
                $getDbPass = $res["password"];
                $isPasswordValid = password_verify($password, $getDbPass);
                if ($isPasswordValid) {
                    //if password of then redirecting to home page
                    $_SESSION['normalUsername'] = $res['username'];
                    ?>
                        <script>
                            alert('Login Successfull');
                            location.replace('index.php');
                        </script>
                    <?php
                }else {
                    //if password is wrong
                    ?>
                        <script>
                            alert('Login failed! Invalid informations');
                        </script>
                    <?php
                }
            }else {
                ?>
                    <script>
                        alert('Invalid Information');
                    </script>
                <?php
            }
        }else {
            //if it is an admin
            $findAdminQuery = "SELECT * FROM `admin` WHERE email = '$email'";
            $findAdminQueryExe = mysqli_query($con, $findAdminQuery);
            //checking admin exist in database
            if (mysqli_num_rows($findAdminQueryExe) > 0){
                //if exist then verifying password
                $res = mysqli_fetch_array($findAdminQueryExe);
                $getDbPass = $res["password"];
                $isPasswordValid = password_verify($password, $getDbPass);
                if ($isPasswordValid) {
                    //if password of then redirecting to home page
                    $_SESSION['adminUsername'] = $res['username'];
                    ?>
                        <script>
                            alert('Login Successfull');
                            location.replace('admin/index.php');
                        </script>
                    <?php
                }else {
                    //if password is wrong
                    ?>
                        <script>
                            alert('Login failed! Invalid informations');
                        </script>
                    <?php
                }
            }else {
                ?>
                    <script>
                        alert('Invalid Information');
                    </script>
                <?php
            }
        }
    }
?>