<?php
require_once "../database.php";
$id = $_GET['id'];
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {
    header("location: ../login.php");
}


$sql = "SELECT * FROM category";
$result = mysqli_query($connection, $sql);



$querry = "SELECT * FROM post WHERE id=$id";
$q_result = mysqli_query($connection, $querry);
if (mysqli_num_rows($q_result) > 0) {
    while ($row = mysqli_fetch_assoc($q_result)) {
        $data[] = $row;
    }
    $data = array_shift($data);
}


if (isset($_POST['update'])) {
    $image = $_FILES['image']['name'];
    $directory = "./images/";


    $title = $_POST['title'];
    $content = $_POST['content'];
    $desc = $_POST['desc'];
    $category = $_POST['cat'];
    $date = date('Y-m-d H:i:s');


    if ($data['image'] && $image) {
        unlink("./images/" . $data['image']);
    }


    if ($image) {
        $temp = explode(".", $image);
        $newfilename = time() . "." . end($temp);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $directory . $newfilename)) {
            echo "submitted successfully";
        } else {
            die();
        }
    } else {
        $newfilename = $data['image'];
    }

    $updatesql = "UPDATE post SET image='$newfilename', title='$title', description='$desc', content='$content', created_at = '$date', category_id='$category' WHERE id= $id";
    if (mysqli_query($connection, $updatesql)) {
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
                <form action="editpost.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Select Images</label>
                        <input type="file" class="form-control" id="" placeholder="" name="image" value="">
                        <img src="<?php echo "./images/" . $data['image']; ?>" style="width: 200px; height: 200px" alt="">
                    </div>
                    <div class="form-group">
                        <label for="">Enter title</label>
                        <input type="text" class="form-control" id="" placeholder="Enter post title" name="title" value="<?php echo $data['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Description</label>
                        <input type="text" class="form-control" id="" placeholder="Enter post Description" name="desc" value="<?php echo  $data['description']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Content</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="content"><?php echo $data['content'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Select Category</label>
                        <select class="custom-select" name="cat">
                            <option value="">Select Category</option>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $match = $row['id'];
                            ?>

                                    <option <?php if ($match == $data['category_id']) {
                                                print "selected";
                                            } ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                                }
                            } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </form>
            </div>
        </div>

    </div>
    <?php
    require_once "commonADMIN/commonfooter.php";
    ?>
</body>

</html>