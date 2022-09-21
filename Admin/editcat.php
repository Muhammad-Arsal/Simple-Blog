<?php
require_once "../database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {
    header("location: ../login.php");
}
$id = $_GET['id'];
$sql = "SELECT * FROM category where id = $id";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $data = array_shift($data);
}
if (isset($_POST['update'])) {
    $name = $_POST['catname'];
    $newdate =  $date = date('Y-m-d H:i:s');
    $new = "UPDATE category SET name = '$name' , created_at = '$newdate' WHERE id=$id";
    if (mysqli_query($connection, $new)) {
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
                <form action="" method="post">
                    <label for="">Enter category name</label>
                    <input type="text" name="catname" class="form-control" value="<?php echo $data['name'] ?>">

                    <button class="submit btn btn-primary mt-3" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    require_once "commonADMIN/commonfooter.php";
    ?>
</body>

</html>