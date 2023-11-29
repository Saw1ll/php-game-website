<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/styles.css">
    <title>Random Name Generator</title>
</head>

<body>
    <div class="redirects">
        <a href='/website/index.php' class='btn btn-secondary'>Go back to dashboard!</a>
        <a href="/website/projects/rng/index.php" class='btn btn-secondary'>Go back to start of RNG</a>
        <a onclick="goBack()" class='btn btn-warning'>Go back one page</a>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </div>
    <div class="container">

        <?php
        session_start();
        global $data_array;
        $data_array = $_SESSION['data_array'];
        if (
            isset($_POST['information']) && $_POST['information'] !== "no" && in_array($_POST['information'], [
                'gender',
                'address',
                'email',
                'dob',
                'phone',
                'cell',
                'nationality'
            ])
        ) {
            $information = $_POST['information'];
            $amount = $_SESSION['amount'];
        }
        if (isset($information)) {

            // Gender
            if ($information === "gender") {
                for ($i = 0; $i < $amount; $i++) {
                    $full_name = $data_array['results'][$i]['name']['title'] . " " . $data_array['results'][$i]['name']['first'] . " " . $data_array['results'][$i]['name']['last'];
                    echo "<div class='information'><p>", $full_name . "'s gender is " . ucfirst($data_array['results'][$i]['gender']), "</p></div>";
                }
            }
            // Address
            if ($information === "address") {
                if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['addressChoice'])) {
                    $addressChoice = $_POST['addressChoice'];
                    echo "<div class='choice'>Address Choice: " . ucfirst($addressChoice) . "</div>";

                    foreach ($data_array['results'] as $result) {
                        $full_name = $result['name']['title'] . " " . $result['name']['first'] . " " . $result['name']['last'];
                        $street = $result["location"]['street']['number'] . " " . $result["location"]['street']['name'];
                        $city = $result['location']['city'];
                        $state = $result['location']['state'];
                        $country = $result['location']['country'];
                        $coordinates = $result['location']['coordinates']['latitude'] . ", " . $result['location']['coordinates']['longitude'];

                        // determines output based on type of address inputted
                        if ($addressChoice === "city") {
                            echo "<div class='information'><p>" . $full_name . "'s lives in the city " . $city . ", in the country " . $country . "</p></div>";
                        } elseif ($addressChoice === "country") {
                            echo "<div class='information'><p>" . $full_name . " lives in the country " . $country . "</p></div>";
                        } elseif ($addressChoice === "state") {
                            echo "<div class='information'><p>" . $full_name . " lives in the state " . $state . "</p></div>";
                        } elseif ($addressChoice === "address") {
                            echo "<div class='information'><p>" . $full_name . " lives at " . $street . ", " . $city . ", " . $state . ", " . $country . "</p></div>";
                        } elseif ($addressChoice === "coords") {
                            echo "<div class='information'><p>" . $full_name . "'s coordinates are " . $coordinates . "</p></div>";
                        }
                    }
                } else {
                    // displays form
                    ?>
                    <form method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" required>
                        <input type="hidden" name="information" value="address">
                        <label for='addressChoice'>Select Address Information</label>
                        <select name='addressChoice'>
                            <option value="null">Select</option>
                            <option value='address'>Exact address</option>
                            <option value='city'>City</option>
                            <option value='state'>State</option>
                            <option value='country'>Country</option>
                            <option value='coordinates'>Coordinates</option>
                        </select>
                        <input type='submit' class='btn btn-secondary' value='Get Info'>
                    </form>
                    <?php
                }
            }
            if ($information === 'email') {
                for ($i = 0; $i < $amount; $i++) {
                    $full_name = $data_array['results'][$i]['name']['title'] . " " . $data_array['results'][$i]['name']['first'] . " " . $data_array['results'][$i]['name']['last'];
                    $email = $data_array['results'][$i]['email'];
                    echo "<div class='information'><p>", $full_name . "'s email is " . $data_array['results'][$i]['email'], "</p></div>";
                }
            }
            // Date of Birth
            if ($information === 'dob') {
                for ($i = 0; $i < $amount; $i++) {
                    $full_name = $data_array['results'][$i]['name']['title'] . " " . $data_array['results'][$i]['name']['first'] . " " . $data_array['results'][$i]['name']['last'];
                    $dob = $data_array['results'][$i]['dob']['date'];
                    $age = $data_array['results'][$i]['dob']['age'];
                    $dobTimestamp = strtotime($dob);
                    $formattedDob = date('d F Y', $dobTimestamp);
                    echo "<div class='information'><p>" . $full_name . "'s date of birth is " . $formattedDob . " meaning they are " . $age . " years old." . "</p></div>";
                }
            }

            if ($information === "phone") {
                for ($i = 0; $i < $amount; $i++) {
                    $full_name = $data_array['results'][$i]['name']['title'] . " " . $data_array['results'][$i]['name']['first'] . " " . $data_array['results'][$i]['name']['last'];
                    $phone_number = $data_array['results'][$i]['phone'];
                    echo "<div class='information'><p>" . $full_name . "'s phone number is $phone_number." . "</p></div>";
                }
            }
            if ($information === "cell") {
                for ($i = 0; $i < $amount; $i++) {
                    $full_name = $data_array['results'][$i]['name']['title'] . " " . $data_array['results'][$i]['name']['first'] . " " . $data_array['results'][$i]['name']['last'];
                    $cell_number = $data_array["results"][$i]["cell"];
                    echo "<div class='information'><p>" . $full_name . "'s cell number is $cell_number." . "</p></div>";
                }
            }
            // Nationality
            if ($information === "nationality") {
                for ($i = 0; $i < $amount; $i++) {
                    $full_name = $data_array['results'][$i]['name']['title'] . " " . $data_array['results'][$i]['name']['first'] . " " . $data_array['results'][$i]['name']['last'];
                    $nationality = $data_array['results'][$i]['nat'];
                    $country = $data_array['results'][$i]['location']['country'];
                    echo "<div class='information'><p>" . $full_name . "'s country code is $nationality which means they come from $country." . "</p></div>";
                }
            }
        }
        ?>
    </div>