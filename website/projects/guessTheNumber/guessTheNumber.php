<?php
session_start();

if (!isset($_SESSION['playcount'])) {
    $_SESSION['playcount'] = 0;
    $_SESSION['correctguesses'] = 0;
    $_SESSION['guess_high'] = 0;
    $_SESSION['guess_low'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['playerguess'])) {
        $playerguess = intval($_POST['playerguess']);

        if (!isset($_SESSION['last_guess']) || $_SESSION['last_guess'] !== $playerguess) {
            $_SESSION['last_guess'] = $playerguess;
            $_SESSION['playcount']++;

            $outcome = rand(1, 10);
            $_SESSION['outcome'] = $outcome;
            if ($playerguess < 1 || $playerguess > 10) {
                echo "<div class='message_error'>Invalid input, please enter a number between one and ten in a numerical format</div>";
            } else {
                if ($playerguess == $outcome) {
                    $_SESSION['correctguesses']++;
                } elseif ($playerguess > $outcome) {
                    $_SESSION['guess_high']++;
                } else {
                    $_SESSION['guess_low']++;
                }
            }
        }

        // Redirect to prevent form resubmission on page refresh
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
    // Reset button logic
    if (isset($_POST['resetPlayCount'])) {
        $_SESSION['playcount'] = 0;
        $_SESSION['correctguesses'] = 0;
        $_SESSION['guess_high'] = 0;
        $_SESSION['guess_low'] = 0;
        $_SESSION['roundpercent'] = 0;
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guess The Number</title>
    <link rel='stylesheet' href='../../css/styles.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class='heading'>
        <p>This game is a guessing game, you have choices 1-10. If you choose the same outcome as the computer, then
            you win!</p>
    </div>
    <div class="form__input">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for='playerguess'>Make your guess (1-10)</label>
            <input type="number" name="playerguess" placeholder='Guess a Number' min='1' max='10' required>
            <input type="submit" value="Guess!" class='btn btn-primary'>
            <br>
        </form>
    </div>
    <div class="outcome">
        <?php
        if (!empty($_SESSION['outcome'])) {
            echo "<p class='outcome__text'>Computer guessed {$_SESSION['outcome']}";
        }
        ?>
    </div>
    <div class="stats">
        <?php
        echo "<p class='stats__text'>Play Count: {$_SESSION['playcount']}</p>";
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type='submit' name='resetPlayCount' value='Reset playcount' class='btn btn-secondary'>
        </form>
        <?php
        if ($_SESSION['playcount'] > 0) {
            $percent_correct = ($_SESSION['correctguesses'] / $_SESSION['playcount']) * 100;
            $_SESSION['roundpercent'] = round($percent_correct, 2);
            echo "<p class='stats__text'>Correct Guesses: {$_SESSION['correctguesses']}</p>";
            echo "<p class='stats__text'>Guesses above the computer: {$_SESSION['guess_high']}</p>";
            echo "<p class='stats__text'>Guesses below the computer: {$_SESSION['guess_low']}</p>";
            echo "<p class='stats__text'>Win percentage: {$_SESSION['roundpercent']}%</p>";
        }
        ?>
    </div>
</body>

</html>