<?php
require_once "../database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {
    header("location: ../login.php");
}
if (isset($_POST['submit'])) {
    $cat = $_POST['catname'];
    $date = date('Y-m-d H:i:s');
    $mysql = "INSERT INTO category(name,created_at) VALUES('$cat','$date')";
    if (mysqli_query($connection, $mysql)) {
        header("location: category.php");
    } else {
        die();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    include "commonADMIN/head.php"
    ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        require_once "commonADMIN/sidebar.php"
        ?>

        <div class="content-wrapper">
            <div class="container">
                <form action="addcat.php" method="post">
                    <label for="">Enter category name</label>
                    <input type="text" name="catname" class="form-control">

                    <button class="submit btn btn-primary mt-3" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    require_once "commonADMIN/commonfooter.php";
    ?>
</body>

</html>