<?php
session_start();

if (
    isset($_POST['information']) && $_POST['information'] !== "no" && !in_array($_POST['information'], [
        'gender',
        'address',
        'email',
        'dob',
        'phone',
        'cell',
        'nationality'
    ])
) {
    $_SESSION['information'] = $_POST['information'];
}
if (isset($_SESSION['information'])) {
    // Gender
    if ($_SESSION['information'] === "gender") {
        for ($i = 0; $i < $amount; $i++) {
            $full_name = $data_array['results'][$i]['name']['title'] . " " . $data_array['results'][$i]['name']['first'] . " " . $data_array['results'][$i]['name']['last'];
            echo $full_name . "'s gender is " . $data_array['results'][$i]['gender'] . "\n";
        }
    }
    // Address
    if ($_SESSION['information'] === "address") {
        echo
            "<form method='post' action='{$_SERVER['PHP_SELF']}' required>
            <label for='addressChoice'>Select Address Information</label>
            <select name='information'>
                <option value='address'>Exact address</option>
                <option value='city'>City</option>
                <option value='state'>State</option>
                <option value='country'>Country</option>
                <option value='coords'>Coordinates</option>
            </select>
            <input type='submit' class='btn btn-secondary' value='Get Info'>
        </form>
            ";
        $_SESSION['addressChoice'] = $_POST['addressChoice'];
        if ($_SESSION['addressChoice'] === "coords") {
            echo "\n";
            echo "The format is as follows:\n";
            echo "Latitude, Longitude\n";
        }
        for ($i = 0; $i < $amount; $i++) {
            $full_name = $data_array['results'][$i]['name']['title'] . " " . $data_array['results'][$i]['name']['first'] . " " . $data_array['results'][$i]['name']['last'];
            $street = $data_array["results"][$i]["location"]['street']['number'] . " " . $data_array["results"][$i]["location"]['street']['name'];
            $city = $data_array['results'][$i]['location']['city'];
            $state = $data_array['results'][$i]['location']['state'];
            $country = $data_array['results'][$i]['location']['country'];
            $coordinates = $data_array['results'][$i]['location']['coordinates']['latitude'] . ", " . $data_array['results'][$i]['location']['coordinates']['longitude'];
            if ($_SESSION['addressChoice'] === "city") {
                echo $full_name . "'s lives in the city " . $city . ", in the country " . $country . "\n";
            } elseif ($_SESSION['addressChoice'] === "country") {
                echo $full_name . " lives in the country " . $country . ".\n";
            } elseif ($_SESSION['addressChoice'] === "state") {
                echo $full_name . " lives in the state " . $state . "\n";
            } elseif ($_SESSION['addressChoice'] === "address") {
                echo $full_name . " lives at " . $street . ", " . $city . ", " . $state . ", " . $country . "\n";
            } elseif ($_SESSION['addressChoice'] === "coords") {
                echo $full_name . "'s coordinates are " . $coordinates . "\n";
            }
        }
    }
    // Date of Birth
    if ($_SESSION['information'] === 'dob') {
        for ($i = 0; $i < $amount; $i++) {
            $full_name = $data_array['results'][$i]['name']['title'] . " " . $data_array['results'][$i]['name']['first'] . " " . $data_array['results'][$i]['name']['last'];
            $dob = $data_array['results'][$i]['dob']['date'];
            $age = $data_array['results'][$i]['dob']['age'];
            $dobTimestamp = strtotime($dob);
            $formattedDob = date('d F Y', $dobTimestamp);
            echo $full_name . "'s date of birth is " . $formattedDob . " meaning they are " . $age . " years old." . "\n";
        }
    }

    if ($_SESSION['information'] === "phone") {
        for ($i = 0; $i < $amount; $i++) {
            $phone_number = $data_array['results'][$i]['phone'];
            echo $full_name . "'s phone number is $phone_number." . "\n";
        }
    }
    if ($_SESSION['information'] === "cell") {
        for ($i = 0; $i < $amount; $i++) {
            $cell_number = $data_array["results"][$i]["cell"];
            echo $full_name . "'s cell number is $cell_number." . "\n";
        }
    }
    // Nationality
    if ($_SESSION['information'] === "nationality") {
        for ($i = 0; $i < $amount; $i++) {
            $nationality = $data_array['results'][$i]['name']['nat'];
            $country = $data_array['results'][$i]['location']['country'];
            echo $full_name . "'s country code is $nationality which means they come from $country." . "\n";
        }
    }
}
?>