<?php
require_once dirname(__FILE__) . './../database/dbconnect.php';
require_once dirname(__FILE__) . './../database/dboperation.php';
require_once '../inc/utils.php';
require_once '../inc/editor_lib.php';

$database = new dbconnect();

require_once dirname(__FILE__) . './admin_header.php';

utils::toastMessage();


?>


<div class="content-wrapper">
    <div class="box box-info">
        <div class="box-header with-border">

            <h3 class="box-title">View Destination</h3>
        </div>

        <div class="box-body">
            <?php

            $db = new dboperation();
            // destiantion id is assigned in javascript in bottom script part

            $destination_id = $_GET['id'] ?? '';
            // $destination_id = 'id';
            $result = $db->getSingleData('destination', $destination_id);

            $destination =  json_decode($result, true);

            $img_path = '../imageUploads/';
            ?>

            <div><img src="<?php echo $img_path . $destination['image'] ?>" class="image-container" alt="<?php echo $destination['image']['name'] ?>"></div>
            <div id="title">
                <h4><?php echo $destination['name']; ?></h4>
            </div>

            <span id="location" class=""><?php echo $destination['location']; ?></span>

            <div id="description" class="mt-5">
                <p><?php echo $destination['description']; ?></p>
            </div>

        </div>

    </div>

</div>


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
</style>
<!-- for editor -->
<script>

</script>









<?php require_once dirname(__FILE__) . './admin_footer.php';
