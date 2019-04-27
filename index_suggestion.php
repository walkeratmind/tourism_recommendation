<?php

require_once dirname(__FILE__) . './database/dboperation.php';


$db = new dboperation();

$limit = 5;

$destinations = $db->getLimitedData('destination', $limit);
$destinations = json_decode($destinations, true);

$events = $db->getLimitedData('event', $limit);
$events = json_decode($events, true);

$img_path = "./imageUploads/";

echo '<div class=" mt-4">';
if ($destinations == null) {
    utils::alertMessage("No any Destinations", "warning");
} else {
    // utils::alertMessage("Recent Destinations", "success");
    // echo '<div class="card-header bg-gray">Recent Destinations</div>';

    echo '<div class="mt-4" style="display:inline;">';
     echo '<h4 class=" text-center">EXPLORE <span style="color:green;">DESTINATIONS</span></h4>';
     echo '<a href="destination.php" class="" style="text-decoration:none;">View All</a>';

    echo '</div>';

    echo '<div class="row">';

    // CHECK $destination VARIABLE
    // echo '<pre>';
    //     print_r($destination);
    // echo '</pre>';

    foreach ($destinations as $destination) {
        echo '<div class="item col-md-4 mb-2 ">';

        echo '<a href="get_destination.php?id=' . $destination['id'] . '">';

        echo '<div class="card shadow-sm " id="" style="width: 24rem;">';
        echo '<div class="content-layout">';
        echo '<img src=\'', $img_path . $destination['image'], '\' style="width: 24rem; height: 18rem"  class="rounded card-img-top" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"  alt="' . $image . '">';
        echo '<span class="content-detail">' . $destination['description'] . '</span>';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $destination['name'] . '</h5>';
        // echo '<p>'. $description . '</p>';

        echo '</div>';    //end of card body
        echo '<card-footer class=" mx-2" >';
        echo '<div class=" text-muted" >' . $destination['location'] . '</div>';
        echo '</card-footer>';
        echo '</div>';

        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
}
// for class
echo '</div>';

// for EVENTS PART
echo '<div class=" mt-4">';
if ($events == null) {
    utils::alertMessage("No any Events", "warning");
} else {
    utils::alertMessage("Recently Uploaded Events", "success");
    // echo '<div class="card-header bg-gray">Recent Destinations</div>';

    
    // CHECK $destination VARIABLE
    // echo '<pre>';
    //     print_r($destination);
    // echo '</pre>';
    
    echo '<div class=" row">';
    foreach ($events as $event) {
        echo '<div class="item col-md-4 mb-2 ">';

        echo '<a href="get_event.php?id=' . $event['id'] . '">';

        echo '<div class="card shadow-sm " id="" style="width: 24rem;">';
        echo '<div class="content-layout">';
        echo '<img src=\'', $img_path . $event['image'], '\' style="width: 24rem; height: 18rem"  class="rounded card-img-top" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"  alt="' . $image . '">';
        echo '<span class="content-detail">' . utils::getDefinateString($event['description']) . '</span>';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $event['eventName'] . '</h5>';
        // echo '<p>'. $description . '</p>';

        echo '</div>';    //end of card body
        echo '<card-footer class=" mx-2" >';
        echo '<div class=" text-muted text-right mr-3" >' . $event['location'] . '</div>';
        echo '<div class=" text-muted text-right mr-3" >' . 'Event Date:' . $event['date'] . '</div>';

        echo '</card-footer>';
        echo '</div>';

        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
}
// for margin mt-4
echo '</div>';

?>

<style>
    .card {

        /* transition: all 0.3s; */
    }

    .item {
        overflow: hidden;
    }

    .item a {
        text-decoration: none;
        color: #000;
    }

    .item:hover {
        box-shadow: 12px 15px 20px 0px rgba(46, 61, 73, 0.4);
        border-radius: 4px;
        transition: all 0.3s ease;
        top: -2px;
    }

    .content-layout {
        position: relative;
    }

    .content-detail {
        position: absolute;
        overflow: hidden;
        background: #000;
        opacity: 0.8;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        bottom: 0;
        width: 100%;
        height: 18%;
        text-align: center;
        color: #fff;
        /* -webkit-transition: all 500ms ease-in-out;
    -moz-transition: all 500ms ease-in-out;
    -ms-transition: all 500ms ease-in-out;
    -o-transition: all 500ms ease-in-out;
    transition: all 500ms ease-in-out; */
        /* display: none; */
    }
</style>

<script>
    $(document).ready(function() {

        let $contentDetail = $('.content-detail');
        // $contentDetail.hide();

        $('.card').hover(function() {
            $contentDetail.show(500);
        }, function() {
            $contentDetail.hide();
        })

    });
</script>