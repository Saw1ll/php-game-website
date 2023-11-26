<?php
// if user login is cached, user will be sent to dashboard
session_start();
if (isset($_SESSION['user'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/styles.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            require_once "comps/database.php";
            // prepared sql statement
            $sql = "SELECT * FROM logins WHERE email = '$email'";
            $result = mysqli_query($connect, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = "yes";
                    header("Location: ../../../index.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password doesn't match</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email doesn't match.</div>";
            }
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="text" name="email" placeholder="Email address" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="password-field form-control">
            </div>
            <div class="form-btn">
                <span class='password-toggle-btn btn btn-secondary' toggle='.password-field'>Show password input</span>
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div>
            <p>Not registered yet? <a href="registration.php">Register here!</a></p>
        </div>
    </div>
    <script>
        <?php require_once "comps/hideshowpw.php"; ?>
    </script>
</body>

</html>