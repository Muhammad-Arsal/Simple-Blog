<?php
$connection = mysqli_connect("localhost", "root", "", "simpleblog");

if (!$connection) {
    die("No connection established");
}
