<?php

require_once dirname(__FILE__) . './../dbconnect.php';

$errors         = array();      // array to hold validation errors
$data             = array();         // array to pass back data
// validate the variables ======================================================
// if any of these variables don't exist, add an error to our $errors array
if (empty($_POST['user_id']))
    $errors['userId'] = 'user id is required.';
if (empty($_POST['destination_id']))
    $errors['destinationId'] = 'destination id is required.';
if (empty($_POST['review']))
    $errors['review'] = 'review is required.';
// return a response
// if there are any errors in our errors array, return a success boolean of false

if (!empty($errors)) {
    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;

    $_SESSION['message'] = "Failed to add a review";
    $_SESSION['msg_type'] = "danger";
} else {
    // if there are no errors process our form, then return a message
    // DO ALL YOUR FORM PROCESSING HERE
    // THIS CAN BE WHATEVER YOU WANT TO DO (LOGIN, SAVE, UPDATE, WHATEVER)
    // show a message of success and provide a true success variable

    // inserting into database

    $database = new dbconnect();
    $mysqli = $database->connect();

    $query = "INSERT  INTO `destination_review`(`id`, `user_id_fk`, `destination_id_fk`, `review`)
                VALUES (NULL, ?, ? , ?) ;";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('iis', $_POST['user_id'], $_POST['destination_id'], $_POST['review']);

    if ($stmt->execute()) {
        $data['success'] = true;
        $data['message'] = "Comment Added";

        $_SESSION['message'] = "Review Added";
        $_SESSION['msg_type'] = "success";
    } else {
        $data['success'] = false;
        $errors['server'] = $stmt->error;
        $data['errors']  = $errors;

        $_SESSION['message'] = "Error in database to add a review";
        $_SESSION['msg_type'] = "danger";
    }

    $stmt->close();
}
// return all our data to an AJAX call
echo json_encode($data);
