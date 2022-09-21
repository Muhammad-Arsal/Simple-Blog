<?php
require_once "../database.php";
$post_id = $_GET['id'];

$delsql = "DELETE FROM post WHERE id = $post_id";
$selectsql = "SELECT * FROM post where id = $post_id";

$res = mysqli_query($connection, $selectsql);
if (mysqli_num_rows($res)) {
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    $data = array_shift($data);
}

$imageName = $data['image'];
if (file_exists('./images/' . $imageName)) {
    unlink("./images/" . $imageName);
}

if (mysqli_query($connection, $delsql)) {
    header("location: ./post.php");
}
