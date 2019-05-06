<?php

require_once dirname(__FILE__) . '../database/dboperation.php';
require_once dirname(__FILE__) . '../database/rating/rating_operation.php';
require_once dirname(__FILE__) . './header.php';

// for posting likes and dislikes
// include dirname(__FILE__) . '../database/rating/post_rating.php';

$db = new dboperation();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        echo '<script> console.log("Clicked: ' . $id . '")</script>';

        $tableName = 'destination';
        $result = $db->getSingleData($tableName, $id);
        // echo '<script> console.log("Result: ' . $result . '")</script>';

        $destination =  json_decode($result, true);
        // echo implode(",", $obj);
    }
} else {
    // $_SESSION['error'] = false;
    // $_SESSION['msg_type'] = 'danger';
    // $_SESSION['message'] = "Invalid request";

    // header('location:./index.php');
}

?>

<style>
    .image-fluid {
        display: block;
        max-width: 100%;
        width: 24rem;
        height: 18rem;
    }

    .image-container {
        display: block;
        max-width: 100%;
        height: 35rem;
        width: 100%;
    }

    #description {
        font-size: 24px;

    }

    .destination-rating {
        /* background: #FFF; */
        color: #2196F3;
        border-radius: 4px;
        padding: 12px;
        /* right: 30px;
        top: 420px; */

    }

    .destination-rating i {
        font-size: 1.5rem;
    }
</style>

<?php
$img_path = './imageUploads/';
echo '<div><img src="' . $img_path . $destination['image'] . '" class="image-container" alt="image">' . '</div>';
?>
<div class="container">

    <div class="row">
        <div class="col-sm-10">
            <div id="title">
                <h4><?php echo $destination['name']; ?></h4>
            </div>
            <span id="location" class=""><?php echo $destination['location']; ?></span>
        </div>
        <div class="col-sm-2">
            <!-- For Rating Option -->

            <?php
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            } else {
                // This means no user
                $user_id = 0;
            }
            ?>
            <div class="destination-rating">
                <!-- if user likes post, style button differently -->
                <i <?php if ($db->userLiked($user_id, $destination['id'])) : ?> class="fas fa-thumbs-up like-btn" <?php else : ?> class="far fa-thumbs-up like-btn" <?php endif ?> data-id="<?php echo $destination['id'] ?>"></i>
                <span class="likes"><?php echo $db->getRatingAction($destination['id'], 'like'); ?></span>

                &nbsp;&nbsp;&nbsp;&nbsp;

                <!-- if user dislikes post, style button differently -->
                <i <?php if ($db->userDisliked($user_id, $destination['id'])) : ?> class="fas fa-thumbs-down dislike-btn" <?php else : ?> class="far fa-thumbs-down dislike-btn" <?php endif ?> data-id="<?php echo $post['id'] ?>"></i>
                <span class="dislikes"><?php echo $db->getRatingAction($destination['id'], 'dislike'); ?></span>
                <input type="hidden" id="destination_id" value="<?php echo $destination['id']; ?>">
                <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">

            </div>
        </div>
    </div>

    <div id="description" class="mt-5">
        <p><?php echo $destination['description']; ?></p>
    </div>

    <?php if (isset($_SESSION['user_id'])) : ?>
        <div class="comment_box mt-4">
            <div class="row">
                <div class="col-md-10">

                    <form class="form" id="review-form" action="./database/review/post_review.php" method="POST">

                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>" />

                        <div class="form-group">
                            <textarea rows="4" class="form-control" style="resize:none;" name="review" placeholder="write reviews here..." required></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-info">
                <h5>Please Login to Post your reviews...</h5>
            </div>

        <?php endif ?>

    <!-- SHOW reviews and comments here -->
    <?php
    $result = $db->getDestinationReviews($destination['id']);
    $reviews = json_decode($result, true);

    // echo '<script> console.log("Reviews: ' . $reviews . '")</script>';

    echo '<h5>Reviews</h5>';
    if (!empty($reviews)) :
        foreach ($reviews as $review) {
            echo '<div class="row comment-section col">';

            $user = $db->getSingleData('user', $review['user_id_fk']);
            $user = json_decode($user, true);
            // echo '<h5>'. $user['firstName'] . ' ' . $user['lastName'] . '</h5>';
            echo '<h6 id="title">' . $user['username'] . '</h6>';

            echo "<p>" . $review['review'] . "</p>";

            echo "<span id='date'><small>" . $review['datetime'] . "</small></span>";

            echo '</div>';
            // echo "<div class='bar col-md-2 text-center'></div>";
        }
        ?>

    <?php else : ?>
        <div class="alert alert-info">
            <h5>No Any Reviews...</h5>
        </div>
    <?php endif ?>
</div>

<!-- FOR reviews styles only -->
<style>
    /* .container {
        position: relative;
    }

    .comment_box {
        position: sticky;
        top: 80px;
        padding: 10px;
        background: #fff;
    } */

    /* draw bar for separating reviews */
    .bar {
        border-bottom: 2px solid rgba(0, 0, 0, 0.7);
        border-radius: 4px
    }

    .comment-section {
        display: block;
        /* border: 1px solid #ccc; */
        ;
        border-radius: 8px;
        margin: 8px;
        padding: 8px;
        width: 56rem;
        align-content: center;
        text-decoration: none;
    }

    .comment-section a {
        text-decoration: none;
        color: gray;
    }

    .comment-section p {
        font-size: 14px;
        text-decoration: none;
        align-content: center;
    }

    .comment-section #date {
        text-align: right;
        align-content: right;
    }
</style>

<script>

    $(document).ready(function() {

        // var destination_id = $(this).data('id');
        var user_id = $('#user_id').val();
        var destination_id = $('#destination_id').val();
        // console.log("destination_id: " + destination_id);

        // get reviews in AJAX
        function get_reviews(destination_id) {
            $.ajax({
                url: './database/review/get_reviews.php',
                type:'POST',
                data: {
                    'destination_id' : destination_id
                }
            }).done(function(data) {

            }).fail(function(data) {

            });
        }
        // For Review Posts and fetching reviews
        $('#review-form').submit(function(event) {
            // get form data
            var formData = {
                'user_id': user_id,
                'destination_id': destination_id,
                'review': $('textarea[name=review]').val()
            };

            // process form in ajax
            $.ajax({
                    url: './database/review/post_review.php',
                    type: 'post',
                    data: formData,
                    dataType: 'JSON',
                    encode: true
                })
                // use done promise callback
                .done(function(data) {

                    // res = JSON.parse(data)
                    console.log("onSuccess" + JSON.stringify(data));
                })
                .fail(function(data) {
                    console.log("onFailure" + data);
                });

            // stop the form from submitting the normal way and refreshing the page
            event.preventDefault();
        });

        // For likes And Dislike
        $('.like-btn').on('click', function() {
            $clicked_btn = $(this);

            if ($clicked_btn.hasClass('far')) {
                action = 'like';
            } else if ($clicked_btn.hasClass('fas')) {
                action = 'unlike';
            }

            $.ajax({
                // url: 'get_destination.php ',
                url: './database/rating/post_rating.php',
                type: 'post',
                data: {
                    'action': action,
                    'destination_id': destination_id,
                    'user_id': user_id
                }
            }).done(function(data) {
                console.log("Data: " + data);
                var res = JSON.parse(data);
                if (action == "like") {
                    $clicked_btn.removeClass('far');
                    $clicked_btn.addClass('fas');
                } else if (action == "unlike") {
                    $clicked_btn.removeClass('fas');
                    $clicked_btn.addClass('far');
                }
                // display the number of likes and dislikes
                $clicked_btn.siblings('span.likes').text(res.likes);
                $clicked_btn.siblings('span.dislikes').text(res.dislikes);

                // change button styling of the other button if user is reacting the second time to post
                if ($('.dislike-btn').hasClass('fas')) {
                    $('.dislike-btn').removeClass('fas').addClass('far');
                }
                // $clicked_btn.siblings('i.fas fa-thumbs-down').removeClass('fas fa-thumbs-down').addClass(
                //     'far ');
            }).fail(function(data) {
                console.log("Fail to send like value from AJAX");
            });

        });

        // FOR Dislike button
        $('.dislike-btn').on('click', function() {
            $clicked_btn = $(this);

            if ($clicked_btn.hasClass('far')) {
                action = 'dislike';
            } else if ($clicked_btn.hasClass('fas')) {
                action = 'undislike';
            }

            $.ajax({
                // url: 'get_destination.php ',
                url: './database/rating/post_rating.php',
                type: 'post',
                data: {
                    'action': action,
                    'destination_id': destination_id,
                    'user_id': user_id
                }
            }).done(function(data) {
                console.log("Data: " + data);
                var res = JSON.parse(data);
                console.log("onSuccess: ");
                if (action == "dislike") {
                    $clicked_btn.removeClass('far');
                    $clicked_btn.addClass('fas');
                } else if (action == "undislike") {
                    $clicked_btn.removeClass('fas');
                    $clicked_btn.addClass('far');
                }
                // display the number of likes and dislikes
                $clicked_btn.siblings('span.likes').text(res.likes);
                $clicked_btn.siblings('span.dislikes').text(res.dislikes);

                // change button styling of the other button if user is reacting the second time to post
                if ($('.like-btn').hasClass('fas')) {
                    $('.like-btn').removeClass('fas').addClass('far');
                }

            }).fail(function(data) {
                console.log("Fail to send dislike value from AJAX");
            });

        });
    });
</script>