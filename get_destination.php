<?php

    require_once dirname(__FILE__) . '../database/dboperation.php';
    require_once dirname(__FILE__) . './header.php';

    $db = new dboperation();
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            echo '<script> console.log("Clicked: '. $id .'")</script>';

            $tableName = 'destination';
            $result = $db->getSingleData($tableName ,$id);
            echo '<script> console.log("Result: '. $result .'")</script>';

            $destination =  json_decode($result, true);
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
         echo '<div><img src="' . $img_path . $destination['image'] . '" class="image-container" alt="image">' . '</div>';
    ?>
<div class="container">
    <div id="title">
        <h4><?php echo $destination['name']; ?></h4>
    </div>
    <span id="location" class=""><?php echo $destination['location']; ?></span>
    <div id="description" class="mt-5">
        <p><?php echo $destination['description']; ?></p>
    </div>
</div>