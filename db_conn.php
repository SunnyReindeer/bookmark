<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "4922";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
