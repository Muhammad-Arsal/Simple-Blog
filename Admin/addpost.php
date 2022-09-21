<?php
require_once "../database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {
    header("location: ../login.php");
}
$sql = "SELECT * FROM category";
$result = mysqli_query($connection, $sql);

if (isset($_POST['submit'])) {
    $image = $_FILES['image']['name'];
    $directory = "./images/";
    $temp = explode(".", $image);
    $newfilename = time() . "." . end($temp);

    $title = $_POST['title'];
    $content = $_POST['content'];
    $desc = $_POST['desc'];
    $category = $_POST['cat'];
    $date = date('Y-m-d H:i:s');

    $que = "INSERT INTO post (image, title, description, content, created_at, category_id) VALUES 
    ('$newfilename', '$title', '$desc', '$content', '$date', '$category')";

    if (mysqli_query($connection, $que)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $directory . $newfilename)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "Failed to upload image";
        }
        header("location: ./post.php");
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
        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">
            <div class="container">
                <form action="addpost.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Select Images</label>
                        <input type="file" class="form-control" id="" placeholder="" name="image">
                    </div>
                    <div class="form-group">
                        <label for="">Enter title</label>
                        <input type="text" class="form-control" id="" placeholder="Enter post title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Description</label>
                        <input type="text" class="form-control" id="" placeholder="Enter post Description" name="desc">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Content</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="content"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Select Category</label>
                        <select class="custom-select" name="cat">
                            <option value="">Select Category</option>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>

                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                                }
                            } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
        </div>

    </div>
    <?php
    require_once "commonADMIN/commonfooter.php";
    ?>
</body>

</html>