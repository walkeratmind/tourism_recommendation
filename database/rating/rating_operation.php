<?php
require_once dirname(__FILE__) . './../dbconnect.php';

$database = new dbconnect();

$mysqli = $database->connect();


// Get total number of likes AND dislikes for a particular post
function getRatingAction($destination_id, $action)
{
    $query = "SELECT COUNT(*) FROM destination_rating_info
            WHERE destination_id = $destination_id AND rating_action=$action";

    $statement = $mysqli->prepare($query);
    $statement->execute();
    $result = $statement->get_result()->fetch_assoc();
    return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($destination_id)
{
    global $mysqli;

    $rating = array();
    $likes_query = "SELECT COUNT(*) FROM destination_rating_info WHERE destination_id = $id AND rating_action='like'";
    $dislikes_query = "SELECT COUNT(*) FROM destination_rating_info 
		  			WHERE destination_id = $destination_id AND rating_action='dislike'";
    $likes_rs = mysqli_query($mysqli, $likes_query);
    $dislikes_rs = mysqli_query($mysqli, $dislikes_query);
    $likes = mysqli_fetch_array($likes_rs);
    $dislikes = mysqli_fetch_array($dislikes_rs);
    $rating = [
        'likes' => $likes[0],
        'dislikes' => $dislikes[0]
    ];
    return json_encode($rating);
}

// Check if user already likes post or not
function userLiked($user_id, $destination_id)
{
    global $mysqli;

    $sql = "SELECT * FROM destination_rating_info WHERE user_id=$user_id 
  		  AND destination_id=$destination_id AND rating_action='like'";
    $result = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

// Check if user already dislikes post or not
function userDisliked($user_id, $destination_id)
{
    global $mysqli;

    $sql = "SELECT * FROM destination_rating_info WHERE user_id=$user_id 
  		  AND destination_id=$destination_id AND rating_action='dislike'";
    $result = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
