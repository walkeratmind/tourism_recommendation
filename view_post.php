<?php

    require_once dirname(__FILE__) . '../database/dboperation.php';
    require_once dirname(__FILE__) . './header.php';

    $db = new dboperation();
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            echo '<script> console.log("Clicked: '. $id .'")</script>';

            $tableName = 'user_post';
            $result = $db->getSingleData($tableName ,$id);
            echo '<script> console.log("Result: '. $result .'")</script>';

            $post =  json_decode($result, true);
            // echo implode(",", $obj);

        }
    } else {
        $_SESSION['error'] = false;
        $_SESSION['msg_type'] = 'danger';
        $_SESSION['message'] = "Invalid request";

        header('location:./blog.php');
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

    #post {
        display: block;
        justify-content: center;
        width: 44rem;
        align-content: center;
    }
</style>

    <?php
        if (!empty($post['image']))
        {
            $img_path = './imageUploads/blog_image/';
            echo '<div><img src="' . $img_path . $post['image'] . '" class="image-container" alt="image">' . '</div>';
        }
    ?>
<div class="container">

    <?php 
        $user = $db->getSingleData('user', $post['user_id']);
        $user = json_decode($user, true);
    ?>

    <div id="user_name">
        <h5>Posted By:</h5>
        <h5><?php echo $user['username'] ?></h5>
    </div>
    <div id="post_title">
        <h4><?php echo $post['title']; ?></h4>
    </div>
    <div id="post" class="mt-5">
        <p><?php echo $post['post']; ?></p>

        <div class=" text-muted" >Posted On: <?php  echo $post['datetime']?></div>
    </div>
</div>

    <!-- Show Footer -->
    <?php 	require_once dirname(__FILE__) . './footer.php'; ?>