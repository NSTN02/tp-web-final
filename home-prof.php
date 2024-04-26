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
        <link rel="stylesheet" href="./styles/home.css">
        <title>home</title>
    </head>

    <body>
        <form method="post" action="post-find">
            <div id="top-container">
                <div>
                    <img src="./images/no-picture.jpg" alt="" id="pfp">
                    <?php echo  $getUser['username']  ?>
                </div>
                <input type="text" id="post-search" name="post-find" placeholder="search for a post">

                <a href="logout.php">logout</a>
            </div>
        </form>
        <div id="main-box">
            <div id="">
                <h1>Operations Menu</h1>
                <ul>
                    <li><a href="signup.php">add a parent</a></li>
                    <br>
                    <li>
                        <form action="find-parent.php" method="Post">
                            <input type="text" name="parent-find" placeholder="find,modify and delete a parent account">
                            <button type="submit">find</button>

                        </form>
                    </li>

                </ul>
            </div>
            <div id="center">
                <div>this is where the school's description goes</div>
                <form action="backend-includes/post-create.php" method="post">
                    <div id="posts-container">
                        <div id="create-post">
                            <textarea name="content" id="post-creation" cols="30" rows="10" placeholder="here the teacher writes the post"></textarea>

                            <button>post</button>
                        </div>
                    </div>
                </form>
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
            <div id="parents-container">
                <?php
                $getTeacher = mysqli_query($conn, "SELECT * FROM `users` WHERE job='Student'");
                $teacher_row_count = mysqli_num_rows($getTeacher);

                if ($teacher_row_count > 0) {
                    while ($teacher = mysqli_fetch_assoc($getTeacher)) {
                        include("single-teacher.php");
                    }
                }

                ?></div>
        </div>
    </body>

    </html>

<?php

} else {
    header('location: login.php');
    exit();
}
?>