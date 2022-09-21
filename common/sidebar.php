<?php
require_once "./database.php";
$sql = "SELECT * FROM category";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $cat[] = $row;
  }
}
?>
<div class="col-md-4">

  <!-- Search Widget -->
  <div class="card my-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
      <form action="search.php" method="GET">
        <div class="input-group">
          <input type="text" name="search" id="search" class="form-control" placeholder="Search for...">
          <span class="input-group-append">
            <button class="btn btn-secondary" type="submit" name="" id="searchButton" type="button">Go!</button>
          </span>
        </div>
      </form>
    </div>
  </div>

  <!-- Categories Widget -->
  <div class="card my-4">
    <h5 class="card-header">Categories</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-6">
          <ul class="list-unstyled mb-0">
            <?php
            foreach ($cat as $main) { ?>
              <li>
                <a href="./categoryposts.php?id=<?php echo $main['id']; ?>"><?php echo $main['name']; ?></a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Side Widget -->
  <div class="card my-4">
    <h5 class="card-header">Side Widget</h5>
    <div class="card-body">
      You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
    </div>
  </div>

</div>