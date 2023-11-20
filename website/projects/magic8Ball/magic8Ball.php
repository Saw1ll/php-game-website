<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='../../css/styles.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Magic 8 Ball</title>

</head>

<body>
    <div class="heading">
        <p>Welcome to the glorious Magic 8 Ball, this game has an intention of helping you with your yes/no questions!
        </p>
    </div>
    <div class="form">
        <form method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <textarea type="text" name="question" minlength='5' maxlength='255' required
                placeholder='Ask your question here!'></textarea>
            <input type="submit" value='Submit Question' class='btn btn-primary'>
        </form>
    </div>
</body>

</html>
<?php

function magic8Ball()
{
    if (!$_POST['question']) {
        return null;
    } else {
    $outcome = rand(0, 17);
    switch ($outcome) {
        case 0:
            echo "<div class='outcome__text'>Certainly so.</div>";
            break;
        case 1:
            echo "<div class='outcome__text'>It is decidely so.</div>";
            break;
        case 2:
            echo "<div class='outcome__text'>Without a doubt!</div>";
            break;
        case 3:
            echo "<div class='outcome__text'>Yes - definitely!</div>";
            break;
        case 4:
            echo "<div class='outcome__text'>You may rely on it.</div>";
            break;
        case 5:
            echo "<div class='outcome__text'>As I see it, yes.</div>";
            break;
        case 6:
            echo "<div class='outcome__text'>Most likely.</div>";
            break;
        case 7:
            echo "<div class='outcome__text'>Likely but not certain.</div>";
            break;
        case 8:
            echo "<div class='outcome__text'>Probably.</div>";
            break;
        case 9:
            echo "<div class='outcome__text'>Probably not.</div>";
            break;
        case 10:
            echo "<div class='outcome__text'>Not likely but not impossible.</div>";
            break;
        case 11:
            echo "<div class='outcome__text'>Most likely not.</div>";
            break;
        case 12:
            echo "<div class='outcome__text'>As I see it, no.</div>";
            break;
        case 13:
            echo "<div class='outcome__text'>You shouldn't rely on it.</div>";
            break;
        case 14:
            echo "<div class='outcome__text'>No - definitely not!</div>";
            break;
        case 15:
            echo "<div class='outcome__text'>Very doubtful!</div>";
            break;
        case 16:
            echo "<div class='outcome__text'>It is decidely not so.</div>";
            break;
        case 17:
            echo "<div class='outcome__text'>Certainly not</div>";
            break;
    }
}
magic8Ball();
}
?>