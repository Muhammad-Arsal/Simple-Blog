<?php
require_once "../database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {
    header("location: ../login.php");
}
$sql = "SELECT * FROM category";
$result = mysqli_query($connection, $sql);
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
            <div class="container my-3">
                <a href="./addcat.php" class="btn btn-primary float-right">Add category</a>
            </div>
            <div class="container mt-3">
                <table class="table">

                    <thead>

                        <tr>
                            <th>ID</th>

                            <th>Category Name</th>

                            <th>Created on</th>

                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>
                        <?php
                        $i = 1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $i++; ?> </td>

                                    <td><?php echo $row['name'] ?></td>

                                    <td><?php echo $row['created_at'] ?></td>

                                    <td>
                                        <a href="editcat.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="deletecat.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <?php
    require_once "commonADMIN/commonfooter.php";
    ?>
</body>

</html>