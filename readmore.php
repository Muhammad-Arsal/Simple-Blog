<?php
require_once "./database.php";
$post_id = $_GET['id'];
$sql = "SELECT * FROM post WHERE id=$post_id";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  $data =  array_shift($data);
}

if (isset($_POST['submit_comment'])) {
  $commentor = $_POST['commentor'];
  $comment = $_POST['comments'];
  $postID = $data['id'];

  $mysql = "INSERT INTO comment(name,comment,post_id) VALUES('$commentor','$comment','$postID')";
  if (!mysqli_query($connection, $mysql)) {
    die();
  }
}
$comkey = $data['id'];
$commentsql = "SELECT * FROM comment WHERE post_id=$comkey";
$comres = mysqli_query($connection, $commentsql);
if (mysqli_num_rows($comres) > 0) {
  while ($row = mysqli_fetch_assoc($comres)) {
    $along[] = $row;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once('./common/common-header.php');
  ?>
  <style>
    .error {
      color: red;
    }
  </style>
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
        <h1 class="mt-4">Full Post</h1>

        <div class="posts">
          <hr>

          <!-- Date/Time -->
          <p><?php echo $data['created_at']; ?></p>

          <hr>

          <!-- Preview Image -->
          <img class="img-fluid rounded" src="<?php echo "./Admin/images/" . $data['image']; ?>" alt="">

          <hr>

          <!-- Post Content -->
          <p> <?php echo $data['content']; ?></p>

        </div>
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form id="commentForm" action="readmore.php?id=<?php echo $post_id; ?>" method="POST">
              <div class="form-group">
                <input type="text" name="commentor" placeholder="Your Name" id="commentor-name" class="form-control">
                <label class="error" style="color: red"></label>
              </div>
              <div class="form-group">
                <textarea name="comments" id="comments" placeholder="Add your comment" class="form-control" rows="3"></textarea>
                <label class="error" style="color: red"></label>

              </div>
              <button type="submit" name="submit_comment" id="submit_comment" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
        <?php
        if (!empty($along)) {
          foreach ($along as $val) {
        ?>
            <div class="media mb-4 border">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0"><?php echo $val['name']; ?></h5>
                <?php echo $val['comment'] ?>
                <hr>
              </div>
            </div>
        <?php  }
        } else {
          echo "No comment Found";
        } ?>
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
  require_once('common/footer.php');
  ?>
  <?php
  require_once('./common/common-footer.php');
  ?>

  <script>
    $(function() {
      $("#commentForm").validate({
        rules: {
          comments: 'required',
          commentor: 'required',
        },
        message: {
          comments: "This field is required",
          commentor: "This field is reqruired",
        }
      })
    })
  </script>

</body>