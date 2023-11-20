<?php 

$hostname = "localhost";
$dbuser = "root";
$dbPassword = "";
$dbname = "login_register";
$connect = mysqli_connect($hostname, $dbuser, $dbPassword, $dbname);
if (!$connect) {
    die("Something went wrong: ");
}