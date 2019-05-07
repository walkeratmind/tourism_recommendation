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

$data = $mysqli->query($query);
// $statement->execute();

$result = array();
while ($row = $data->fetch_assoc()) {
    $posts[] = $row;
}

$totalPost = empty($posts) ? 0 : sizeof($posts);

// $statement->close();
$mysqli->close();

// if ($totalPost == 0) {
//     utils::alertMessage("No Any Posts...", "warning");
// }

// utils::alertMessage("Total Posts : " . $totalPost, "success");
// utils::checkUserLogin();
// $_SESSION['message'] = 'hello';
utils::toastMessage();
// utils::message();


?>

<div class="container mt-4">

    <div class="alert alert-success col-md-2 text-center" style="float:right;">
        Total Post: <?php echo $totalPost ?>
    </div>

    <button class="btn btn-lg btn-primary  my-2 " data-toggle="modal" data-target="#createPostModal"><i class="fa fa-plus-square"></i> Create Post</button>

    <?php

    if ($totalPost > 0) :
        foreach ($posts as $post) {
            echo '<div class="row blog-post " id="'. $post['id'] .'" >';        // data-toggle="modal" data-target="#viewPostModal"

                echo "<div class='col-sm-2' >";
                    if (empty($post['image'])) {
                        $showImage = "<img class='image-fluid' src='./assets/icons/no_image.png' alt='No Image'>";
                    } else {
                        $img_path = "./imageUploads/blog_image/";
                        $showImage = "<img class='image-fluid' src='" . $img_path . $post['image'] . "' alt=''>";
                    }

                    echo $showImage;

                echo "</div>";

                echo "<div class='col-sm-10'>";

                    echo "<h5 id='title'>" . $post['title'] . "</h5>";
                    echo "<p class=''>" . utils::getDefinateString($post['post'], 100) . "</p>";

                    echo "<span id='date'><small>" . $post['datetime'] . "</small></span>";
                    echo "</a>";

                    echo '<a class="btn btn-danger float-right" id="delete-btn" href="./database/delete_post.php?id=' . $post['id'] . '"
                                onclick="return confirm(\'Delete Post?\');">Delete</a>';
                echo '</div>';

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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostTitle">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="post_form needs-validation" novalidate action="./database/add_blog_post.php" method="POST" enctype='multipart/form-data'>

                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>" />

                    <div class="form-group">
                        <label for="title">Title</label>
                        <div class="input-group">
                            <!-- <span class="input-group-addon" id="name-input">#</span> -->
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" aria-describedby="name-input" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- <label for="post">Content</label> -->
                        <textarea rows="5" class="form-control" style="resize:none;" name="post" placeholder="write post here..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Select Image</label>
                        <!-- MAX_FILE_SIZE must precede the file input field -->
                        <input type="file" name="image" id="imageFile" accept="image/*" />
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

<!-- View post modal -->
<div class="modal fade" id="viewPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostTitle">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
       
            </div>

        </div>
    </div>
</div>

<style>
    .image-fluid {
        display: grid;
        max-width: 100%;
        width: 12rem;
        height: 8rem;
    }

    .blog-post {
        display: grid;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin: 2px;
        padding: 16px;
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
        /* float: right; */
        align-content: right;
    }
</style>

<script>
    $(document).ready(function() {


    })
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