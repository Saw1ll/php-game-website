<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Random Name Generator</title>
</head>

<body>
  <?php
  $nationality = isset($_POST['nationality']) ? $_POST['nationality'] : "";
  $amount = isset($_POST['amount']) ? $_POST['amount'] : "";
  $information = isset($_POST['information']) ? $_POST['information'] : "";
  $nationalities = ['algerian', 'ag', 'american', 'us', 'australian', 'au', 'brazilian', 'br', 'canadian', 'ca', 'danish', 'da', 'dutch', 'nl', 'finnish', 'fi', 'french', 'fr', 'german', 'de', 'british', 'gb', 'irish', 'ie', 'new zealander', 'nz', 'spanish', 'es', 'swiss', 'ch', 'turkish', 'tr'];
  if ($nationality != "no") {
    if (
      strlen($nationality) === 2 && in_array($nationality, $nationalities)
    ) {
      echo "<div class='heading'><p>Random names generated from the nationality: " . strtoupper($nationality) . "</p></div>";
    } elseif (
      strlen($nationality) != 2 && in_array($nationality, $nationalities)
    ) {
      echo "<div class='heading'><p>Random names generated from the nationality: " . ucfirst($nationality) . "</p></div>";
    }
  } else {
    echo "<div class='heading'><p>Random names generated: </p></div>";
  }

  $user_response = file_get_contents("https://randomuser.me/api/?nat=$nationality&results=$amount&format=json");
  $data_array = json_decode($user_response, true);
  ?>
  <div class="names_container">
    <?php
    for ($i = 0; $i < $amount; $i++) {
      $full_name = $data_array['results'][$i]['name']['title'] . " " . $data_array['results'][$i]['name']['first'] . " " . $data_array['results'][$i]['name']['last'];
      echo "<div class='names'><p>$full_name</p></div>";
    }
    ?>
  </div>
  <form method="post" action="randomuser.php" required>
    <select name='information'>
      <option value='gender'>Gender</option>
      <option value="address">Address</option>
      <option value="email">Email</option>
      <option value="dob">Date of Birth</option>
      <option value="phone">Telephone Number</option>
      <option value="cell">Cellphone Number</option>
      <option value="nationality">Nationality</option>
    </select>
    <input type='submit' class='btn btn-primary'>
  </form>
</body>

</html>