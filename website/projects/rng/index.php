<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Name Generator</title>
    <link rel='stylesheet' href='../../css/styles.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="dashboard">
        <a href='../../index.php' class='btn btn-secondary'>Go back to dashboard!</a>
    </div>
    <div class="container">
        <div class="title">
            <h2>Random Name Generator</h3>
        </div>
        <div class="intro">
            <h4>Hello, welcome to the Random Name Generator</h4>
            <h4>There will be a series of questions that you need to answer in order to generate your random names.</h4>
            <h4>Let's get started,</h4>
        </div>
        <div class="questions">
            <form method="post" action="./comps/randomuser.php">
                <label for="amount">How many names would you like to generate? (Max 250)</label>
                <input type="number" name='amount' min='1' max='250' id="amount" required>
                <br><br>
                <label for="nationality">Select a nationality or enter 'no' to generate without constraints</label>
                <select name="nationality" id="nationality" required>
                    <option value="null">Select one</option>
                    <option value="ag">Algerian</option>
                    <option value="us">American</option>
                    <option value="au">Australian</option>
                    <option value="br">Brazillian</option>
                    <option value="ca">Canadian</option>
                    <option value="da">Danish</option>
                    <option value="nl">Dutch</option>
                    <option value="fi">Finnish</option>
                    <option value="fr">French</option>
                    <option value="de">German</option>
                    <option value="gb">British</option>
                    <option value="ie">Irish</option>
                    <option value="nz">New Zealander</option>
                    <option value="es">Spanish</option>
                    <option value="ch">Swiss</option>
                    <option value="tr">Turkish</option>
                </select>
                <br><br>
                <button class='btn btn-primary' type="submit">Submit Query</button>
            </form>
        </div>
    </div>
</body>

</html>