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
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST['submit'])) {
            // GRABS FROM HTML FORM
            $fName = $_POST['fName'];
            $lName = $_POST['lName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cfPassword = $_POST['password'];
            // HASHES PASSWORD FOR DATABASE USAGE
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            // INITIALISES $ERRORS AS AN ARRAY
            $errors = array();


            // VALIDATION
            if (empty($fName) || empty($lName) || empty($email) || empty($password) || empty($cfPassword)) {
                array_push($errors, "All fields are required");
            }
            $fName = ucfirst(preg_replace('/\s/', '', $fName));
            $lName = ucfirst(preg_replace('/\s/', '', $lName));
            if (!ctype_alpha($fName) || !ctype_alpha($lName)) {
                array_push($errors, "Ensure you've typed your name correctly.");
            }
            if ((strlen($fName) >= 3) && (strlen($lName) >= 3)) {
                $fullName = "$fName $lName";
            } else {
                array_push($errors, "Ensure you've typed both your first and last names.");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Please enter a valid email address.");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Please enter a password at least eight characters long.");
            }
            if ($cfPassword != $password) {
                array_push($errors, "Please check your confirmation of password.");
            }

            require_once "database.php";
            $sql = "SELECT * FROM logins WHERE email = '$email'";
            $result = mysqli_query($connect, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors, "Email already exists on the database!");
            }
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {

                $sql = "INSERT INTO logins (full_name, email, password) VALUES ( ?, ?, ?)";
                $stmt = mysqli_stmt_init($connect);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Registration successful.</div>";
                } else {
                    echo "<div class='alert alert-danger>Something went wrong</div>";
                    die("Something went wrong");
                }
            }
        }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fName" placeholder="First Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="lName" placeholder="Last Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input class="form-control password-field" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input class="form-control password-field" type="password" name="cfPassword"
                    placeholder="Confirm Password">
            </div>
            <div class="form-btn">
                <span class='password-toggle-btn btn btn-secondary' toggle='.password-field'>Show password input</span>
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
            <p>Already have an account? <a href="login.php">Login here!</a></p>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('.password-toggle-btn');
            togglePassword.addEventListener('click', function () {
                const passwordFields = document.querySelectorAll(this.getAttribute('toggle'));
                passwordFields.forEach(function (field) {
                    field.type = field.type === 'password' ? 'text' : 'password';
                })
                this.textContent = passwordFields[0].type === 'password' ? "Show password input" : "Hide password input";
            })
        })
    </script>
</body>

</html>