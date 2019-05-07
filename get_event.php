<?php

    require_once dirname(__FILE__) . '../database/dboperation.php';
    require_once dirname(__FILE__) . './header.php';

    $db = new dboperation();
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            echo '<script> console.log("Clicked: '. $id .'")</script>';

            $tableName = 'event';
            $result = $db->getSingleData($tableName ,$id);
            echo '<script> console.log("Result: '. $result .'")</script>';

            $event =  json_decode($result, true);
            // echo implode(",", $obj);

        }
    } else {
        $_SESSION['error'] = false;
        $_SESSION['msg_type'] = 'danger';
        $_SESSION['message'] = "Invalid request";

        header('location:./index.php');
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
        font-size:24px;
    }
</style>
    <?php
         $img_path = './imageUploads/';
         echo '<div><img src="' . $img_path . $event['image'] . '" class="image-container" alt="image">' . '</div>';
    ?>
<div class="container">
    <div id="title">
        <h4><?php echo $event['eventName']; ?></h4>
    </div>
    <span id="location" class=""><?php echo $event['location']; ?></span>
    <div id="event" class="mt-5">
        <p><?php echo $event['description']; ?></p>

        <div class=" text-muted" >Event Date: <?php  echo $event['date']?></div>
    </div>
</div>

    <!-- Show Footer -->
    <?php 	require_once dirname(__FILE__) . './footer.php'; ?>