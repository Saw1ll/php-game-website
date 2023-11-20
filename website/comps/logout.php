<?php
session_start();
session_destroy();
header("Location: loginRegistration/comps/login.php");
?>