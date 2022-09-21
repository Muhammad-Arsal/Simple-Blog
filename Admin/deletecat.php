<?php
require_once "../database.php";
$id = $_GET['id'];
$mysql = "DELETE FROM category WHERE id = $id";
if (mysqli_query($connection, $mysql)) {
    header("location: category.php");
} else {
    die();
}
