<?php
require_once dirname(__FILE__) . './../dbconnect.php';


class RecommendationEngine {

    private $conn;

    function __construct()
    {
        $database = new dbconnect();

        $this->conn = $database->connect();
    }


    // RETURNS the most liked destinations if there's any ...
    function getMostLikedDestination($id) {
        $query = "SELECT destination_id from `destination_rating_info` WHERE 
                `rating_action` == 'like' AND ";

        $statement = $this->conn->prepare($query);
        $statement->bind_param('i', $id);

        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        return json_encode($result);
    }


}
?>