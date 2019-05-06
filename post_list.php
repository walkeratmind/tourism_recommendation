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

$totalPost = empty($posts) ? 0 : sizeof($posts);

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

    <button class="btn btn-lg btn-primary  my-2 " data-toggle="modal" data-target="#createPostModal"><i class="fa fa-plus-square"></i> Create Post</button>


    <?php

    if ($totalPost > 0) :
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

            echo '<a class="btn btn-danger" id="delete-btn" href="./database/delete_post.php?id=' . $post['id'] . '"
                    onclick="return confirm(\'Delete Post?\');">Delete</a>';

            echo '</div>';
        } else :
        ?>

        <div class="alert alert-info">
            <h5>No Any Posts...</h5>
        </div>
    <?php endif ?>
</div>


<!-- Enquiry and feedback form modal -->
<div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostTitle">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="post-form needs-validation" novalidate action="./database/add_blog_post.php" method="POST">

                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>" />

                    <div class="form-group">
                        <textarea rows="5" class="form-control" style="resize:none;" name="post" placeholder="write post here..." required></textarea>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg ">Post</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<style>
    .blog-post {
        display: block;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin: 8px;
        padding: 16px;
        width: 56rem;
        align-content: center;
        text-decoration: none;
    }

    .blog-post a {
        text-decoration: none;
        color: #808080;
    }

    .blog-post .btn {
        float: right;
        color: #FFF;
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
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            //validate all forms
            // var forms = document.getElementsByTagName('form');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>