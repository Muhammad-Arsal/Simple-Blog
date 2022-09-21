<?php
require_once "../database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {
    header("location: ../login.php");
}
$sql = "SELECT * FROM post";
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
        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">
            <div class="container">
                <a href="addpost.php"><button class="btn btn-primary float-right my-3">Add new post</button></a>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Category</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $i = 1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $data = [];
                                $key = $row['category_id'];
                                $my = "SELECT * FROM category WHERE id = $key";
                                $outcome = mysqli_query($connection, $my);
                                if (mysqli_num_rows($outcome) > 0) {
                                    while ($run = mysqli_fetch_assoc($outcome)) {
                                        $data[] = $run;
                                    }
                                    $data = array_shift($data);
                                }
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $i++ ?></th>
                                    <td><img src="<?php echo './images/' . $row['image']; ?>" style="width: 100px; height: 100px;" alt=""></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['description'] ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td>
                                        <a href="editpost.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a href="deletepost.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } ?>
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