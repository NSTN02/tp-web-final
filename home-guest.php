<?php
session_start();
include("./include/connections.php");

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
  $id = $_SESSION['id'];
  $user = $_SESSION['username'];
  $getUser = mysqli_query($conn, "SELECT * FROM users WHERE id =$id");
  $getUser = mysqli_fetch_array($getUser);

  if (isset($_POST['parent-find']) && $result) {
    $_SESSION['parent-find'] = $_POST['parent-find'];
  }



?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/Home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>home</title>
  </head>

  <body>
    <form action="find-post.php" method="post">
      <div id="top-container">

        <div class="findByDate">
          <h3>find post by date :</h3>
          <h4>date start :</h4>
          <input type="date" class="postfind" name="post-date1">
          <h4>date end :</h4>
          <input type="date" class="postfind2" name="post-date2">
          <button type="submit">Find</button>
        </div>

        <a href="logout.php">Logout</a>
      </div>
    </form>

    <div id="center">
      <h2>this is where the school's description goes</h2>

      <div id="post-bar">
        <?php
        $getPost = mysqli_query($conn, "SELECT * FROM posts");
        $row_count = mysqli_num_rows($getPost);
        if ($row_count > 0) {
          while ($post = mysqli_fetch_assoc($getPost)) {
            include("single-post.php");
          }
        }

        ?>
      </div>
    </div>

    </div>
  </body>

  </html>
<?php

} else {
  header('location: login.php');
  exit();
}
?>