<?php
if (
    $information !== "no" && !in_array($information, [
        'gender',
        'address',
        'email',
        'dob',
        'phone',
        'cell',
        'nationality'
    ])
) {
    $information = strtolower(readline("> "));
}
// Gender
if ($information === "gender") {
    for ($i = 0; $i < $amount; $i++) {
        $full_name = $data_array['results'][$i]['name']['title'] . " " . $data_array['results'][$i]['name']['first'] . " " . $data_array['results'][$i]['name']['last'];
        echo $full_name . "'s gender is " . $data_array['results'][$i]['gender'] . "\n";
    }
}
// Address
if ($information === "address") {
    echo "Would you like to know either their address/city/state/country/coordinates?\n";
    $addressChoice = readline("> ");
    if ($addressChoice === "coordinates" || $addressChoice === "coords") {
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
        if ($addressChoice === "city") {
            echo $full_name . "'s lives in the city " . $city . ", in the country " . $country . "\n";
        } elseif ($addressChoice === "country") {
            echo $full_name . " lives in the country " . $country . ".\n";
        } elseif ($addressChoice === "state") {
            echo $full_name . " lives in the state " . $state . "\n";
        } elseif ($addressChoice === "address") {
            echo $full_name . " lives at " . $street . ", " . $city . ", " . $state . ", " . $country . "\n";
        } elseif ($addressChoice === "coordinates" || $addressChoice === "coords") {
            echo $full_name . "'s coordinates are " . $coordinates . "\n";
        }
    }
}
// Date of Birth
if ($information === 'dob' || $information === 'date of birth') {
    for ($i = 0; $i < $amount; $i++) {
        $full_name = $data_array['results'][$i]['name']['title'] . " " . $data_array['results'][$i]['name']['first'] . " " . $data_array['results'][$i]['name']['last'];
        $dob = $data_array['results'][$i]['dob']['date'];
        $age = $data_array['results'][$i]['dob']['age'];
        $dobTimestamp = strtotime($dob);
        $formattedDob = date('d F Y', $dobTimestamp);
        echo $full_name . "'s date of birth is " . $formattedDob . " meaning they are " . $age . " years old." . "\n";
    }
}
// Nationality
if ($information === "nationality") {
    for ($i = 0; $i < $amount; $i++) {
        $nationality = $data_array['results'][$i]['name']['nat'];
        $country = $data_array['results'][$i]['location']['country'];
        echo $full_name . "'s country code is $nationality which means they come from $country." . "\n";
    }
}

if ($information === "phone") {
    for ($i = 0; $i < $amount; $i++) {
        $phone_number = $data_array['results'][$i]['phone'];
        echo $full_name . "'s phone number is $phone_number." . "\n";
    }
}
if ($information === "cell") {
    for ($i = 0; $i < $amount; $i++) {
        $cell_number = $data_array["results"][$i]["cell"];
        echo $full_name . "'s cell number is $cell_number." . "\n";
    }
}
?>