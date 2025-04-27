<?php
session_start();
error_reporting(error_level: E_ALL);
ini_set(option: 'display_errors', value: 1);


// Function to calculate the result or set an error message
$result = null;
function calculate($num01, $oper, $num02): mixed
{
    if (is_numeric(value: $num01) && is_numeric(value: $num02)) {
        switch ($oper) {
            case "add":
                return $num01 + $num02;
            case "sub":
                return $num01 - $num02;
            case "mul":
                return $num01 * $num02;
            case "div":
                if ($num02 != 0) {
                    return $num01 / $num02;
                } else {
                    $_SESSION['error'] = "You can't divide by zero.";
                    return null;
                }
            case "mod":
                if ($num02 != 0) {
                    return $num01 % $num02;
                } else {
                    $_SESSION['error'] = "You're not able to use modulo on zero.";
                    return null;
                }
            default:
                $_SESSION['error'] = "Invalid operation";
                return null;
        }
    } else {
        $_SESSION['error'] = "Invalid input, input should be numeric.";
        return null;
    }
}

// Handle form submission and display result or error message
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (empty($_GET['num01']) || empty($_GET['num02']) || empty($_GET['oper'])) {
        $_SESSION['error'] = "Invalid input, check your inputs.";
    } else {
        $num01 = $_GET['num01'];
        $oper = $_GET['oper'];
        $num02 = $_GET['num02'];
        $result = calculate($num01, $oper, $num02);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../../css/styles.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Calculator</title>
</head>

<body>
    <div class="dashboard">
        <a href='../../index.php' class='btn btn-primary'>Go back to dashboard!</a>
    </div>
    <br>
    <form method='get' action="<?php echo htmlspecialchars(string: $_SERVER['PHP_SELF']); ?>">
        First Number: <input type='number' name='num01' minlength="1" required>
        <select name='oper'>
            <label for="Choose operation"></label>
            <option value="add">Add!</option>
            <option value="sub">Subtract!</option>
            <option value="mul">Multiply!</option>
            <option value="div">Divide!</option>
            <option value="mod">Modulo</option>
        </select>
        <br>
        Second Number: <input type='number' name='num02' minlength="1" required>
        <button type="submit">Submit Query</button>
    </form>
    <div class="answer">
        Result:
        <?php if ($result !== null) {
            echo $result;
        } ?>
    </div>
    <?php
    // Display any error messages stored in the session
    if (!empty($_SESSION['error'])) {
        echo "<p style='color:red;'>Error: {$_SESSION['error']}</p>";
        unset($_SESSION['error']);
    }
    ?>
</body>

</html>