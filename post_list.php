<?php
require_once dirname(__FILE__) . './database/dboperation.php';
require_once dirname(__FILE__) . './database/dbconnect.php';
require  dirname(__FILE__) . './header.php';

require_once dirname(__FILE__) . './inc/utils.php';

// $db = new dboperation();

$blogTable = "user_post";

$database = new dbconnect();

$mysqli = $database->connect();

$query = "SELECT * FROM " . $blogTable . " WHERE user_id = " . $_SESSION['user_id'];

// $statement = $mysqli->prepare($query);
// $statement->bind_param('i', $_SESSION['user_id']);

// $statement->execute();
// $posts = $statement->get_result()->fetch_assoc();

$data = $mysqli->query($query);
// $statement->execute();

$result = array();
while ($row = $data->fetch_assoc()) {
    $posts[] = $row;
}

$totalPost = sizeof($posts);

// $statement->close();
$mysqli->close();

// utils::toastClientSide();

if ($totalPost == 0) {
    utils::alertMessage("No Any Posts...", "warning");
}

utils::alertMessage("Your Total Posts : " . $totalPost, "success");
// utils::checkUserLogin();
// $_SESSION['message'] = 'hello';
utils::toastMessage();
// utils::message();


?>

<div class="container mt-4">

    <?php

    foreach ($posts as $post) {
        echo '<div class="row blog-post col">';
        echo "<a href='#'>";

        // $user = $db->getSingleData('user', $post['user_id']);
        // $user = json_decode($user, true);
        // echo '<h5>'. $user['firstName'] . ' ' . $user['lastName'] . '</h5>';
        // echo '<h5>'. $user['username']. '</h5>';

        echo "<p>" . $post['post'] . "</p>";

        echo "<span id='date'><small>" . $post['datetime'] . "</small></span>";
        echo "</a>";

        echo '<a class="btn btn-danger" href="./database/delete_post.php?id=' . $post['id'] . '"
                onclick="return confirm(\'Delete Post?\');">Delete</a>';

        echo '</div>';
    }


    ?>


</div>

<style>
    .blog-post {
        display: block;
        border: 1px solid #ccc;
        ;
        border-radius: 8px;
        margin: 8px;
        padding: 8px;
        width: 56rem;
        align-content: center;
        text-decoration: none;
    }

    .blog-post a {
        text-decoration: none;
        color: gray;
    }

    .blog-post p {
        text-decoration: none;
    }

    .blog-post #date {
        text-align: right;
        align-content: right;
    }
</style>


<script>
    //for form validation
</script>