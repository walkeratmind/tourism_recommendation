<?php

require_once dirname(__FILE__) . './../dboperation.php';

$errors         = array();      // array to hold validation errors
$data             = array();         // array to pass back data
// validate the variables ======================================================
// if any of these variables don't exist, add an error to our $errors array

if (empty($_POST['destination_id']))
    $errors['destinationId'] = 'destination id is required.';

// return a response
// if there are any errors in our errors array, return a success boolean of false

if (!empty($errors)) {
    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;
} else {
    // if there are no errors process our form, then return a message
    // DO ALL YOUR FORM PROCESSING HERE
    // THIS CAN BE WHATEVER YOU WANT TO DO (LOGIN, SAVE, UPDATE, WHATEVER)
    // show a message of success and provide a true success variable

    // inserting into database

    $db = new dboperation();
    $result = $db->getLastAddedDestination($_POST['destination_id']);
    $reviews = json_decode($result, true);

    // echo '<script> console.log("Reviews: ' . $reviews . '")</script>';

    if (!empty($reviews)) {

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
    } else {
        
    }
}

?>

<!-- FOR reviews styles only -->
<style>
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
