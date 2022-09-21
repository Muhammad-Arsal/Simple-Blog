<?php
require_once "./database.php";
$searched = $_GET['search'];
$searchdata = "SELECT * FROM post WHERE title LIKE '%$searched%'";

$searchresult = mysqli_query($connection, $searchdata);

if (mysqli_num_rows($searchresult) > 0) {
  while ($row = mysqli_fetch_assoc($searchresult)) {
    $search[] = $row;
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
        if (!empty($search)) {
          foreach ($search as $record) {
        ?>
            <div class="posts">
              <!-- Author -->
              <p class="lead">
                by
                <a href="#">Start Bootstrap</a>
              </p>

              <hr>

              <!-- Date/Time -->
              <p><?php echo $record['created_at']; ?></p>

              <hr>

              <!-- Preview Image -->
              <img class="img-fluid rounded" src="<?php echo "./Admin/images/" . $record['image']; ?>" alt="">

              <hr>
              <h2><?php echo $record['title'] ?></h2>
              <p> <?php echo $record['description'] ?> </p>

              <a type="button" class="btn btn-primary" href="<?php ?>"> READ MORE </a>

            </div>
        <?php
          }
        } else {
          echo "<h3 class='mt-3' > Nothing related found </h3>";
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