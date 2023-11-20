<?php
// if user login isn't cached, user will be sent to login screen
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: comps/loginRegistration/comps/login.php");
}
function generateCards($cardData)
{
    $cardsHTML = '';


    foreach ($cardData as $card) {
        $cardsHTML .= generateCardItem($card['src'], $card['text'], $card['label'], $card['path']);
    }

    return $cardsHTML;
}

require_once 'comps/cards/cardItem.php';

// 1st Row
require_once 'comps/cards/cards/1stRow.php';
$cards1HTML = generateCards($cards1);

require_once 'comps/cards/cards/2ndRow.php';
$cards2HTML = generateCards($cards2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BootstrapCDN css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="comps/loginRegistration/css/styles.css">
    <link rel="stylesheet" href="comps/cards/css/cards.css">
    <title>User Dashboard</title>

</head>

<body>
    <div class="container">
        <h1>Welcome to the dashboard.</h1>
        <div class="cards__container">
            <div class="cards__wrapper">
                <ul class="cards__items">
                    <?php
                    echo $cards1HTML;
                    ?>
                </ul>
                <ul class="cards__items">
                    <?php
                    echo $cards2HTML;
                    ?>
                </ul>
            </div>
        </div>
        <a href="comps/logout.php" class='btn btn-warning'>Log out</a>
    </div>
</body>

</html>