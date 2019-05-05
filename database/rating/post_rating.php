<?php

require_once dirname(__FILE__) . './../dboperation.php';

if (isset($_POST['action'])  && isset($_POST['destination_id'])) {

    $user_id = $_POST['user_id'];
    $destination_id = $_POST['destination_id'];
    $action = $_POST['action'];

    $database = new dbconnect();
    $mysqli = $database->connect();

    $query = "DELETE FROM `destination_rating_info` WHERE user_id = ? AND destination_id = ?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param('ii', $user_id, $destination_id);
    $statement->execute();

    // first delete any previous record of the user,
    // coz if user likes certain destination and again dislikes that
    // then users value is reset first and again set

    switch ($action) {

        case 'like':
            $query = "INSERT INTO `destination_rating_info`(id, user_id, destination_id, rating_action) 
            VALUES(NULL, ?, ?, 'like') ON DUPLICATE KEY UPDATE rating_action='like'";
            break;
        case 'dislike':
            $query = "INSERT INTO `destination_rating_info`(id, user_id, destination_id, rating_action) 
            VALUES(NULL, ?, ?, 'dislike') ON DUPLICATE KEY UPDATE rating_action='dislike'";
            break;
        case 'unlike':
            $query = "DELETE FROM `destination_rating_info` WHERE user_id = ? AND destination_id = ?";
            break;
        case 'undislike':
            $query = "DELETE FROM `destination_rating_info` WHERE user_id = ? AND destination_id = ?";
            break;
        default:
            break;
    }
    

    $db = new dboperation();

    $statement = $mysqli->prepare($query);
    $statement->bind_param('ii', $user_id, $destination_id);

    if ($statement->execute()) {
        echo $db->getRating($destination_id);
    } else {
        echo "Failed to execute SQL query";
        // $response['error'] = true;
        // $response['message'] = "Failed to execute SQL query";
        // echo json_encode($response);
    }

    $statement->close();
    $mysqli->close();
} else {
    echo "Failed to set some Value";
    // $response['error'] = true;
    // $response['message'] = "Failed to set some Value";
    // echo json_encode($response);
}
