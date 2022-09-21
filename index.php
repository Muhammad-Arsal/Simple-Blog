<?php
require_once "./database.php";
$sql = "SELECT * FROM post";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once('./common/common-header.php');
  ?>
</head>

<body>

  <!-- Navigation -->
  <?php
  require_once('./common/header.php');
  ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">Recently added posts</h1>

        <?php
        foreach ($data as $records) {

        ?>
          <div class="posts shadow py-3 px-3">
            <!-- Author -->
            <p class="lead">
              by
              <a href="#">Start Bootstrap</a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><?php echo $records['created_at']; ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-fluid rounded" src="<?php echo "./Admin/images/" . $records['image'] ?>" alt="">

            <hr>
            <h2><?php echo $records['title']; ?></h2>

            <!-- Post Description -->
            <p><?php echo $records['description'] ?></p>

            <a type="button" class="btn btn-primary" href="./readmore.php?id=<?php echo $records['id']; ?>"> READ MORE </a>

          </div>
        <?php
        }
        ?>

      </div>

      <!-- Sidebar Widgets Column -->
      <?php
      require_once('./common/sidebar.php');
      ?>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php
  require_once('common/footer.php')
  ?>
  <?php
  require_once('./common/common-footer.php');
  ?>

</body>

</html>