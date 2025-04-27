<?php 

$hostname = "localhost";
$dbuser = "root";
$dbPassword = "";
$dbname = "login_register";
$connect = mysqli_connect(hostname: $hostname, username: $dbuser, password: $dbPassword, database: $dbname);
if (!$connect) {
    die("Something went wrong: ");
}