<?php

require_once dirname(__FILE__) . './dbconnect.php';


class dboperation
{

    private $conn;

    function __construct()
    {

        $database = new dbconnect();

        $this->conn = $database->connect();
    }

    function getConn()
    {
        return $this->conn;
    }

    function isEmailExist($tableName, $email)
    {
        $query = "SELECT id FROM " . $tableName . " WHERE email=?";

        $statement = $this->conn->prepare($query);

        $statement->bind_param('s', $email);

        $statement->execute();
        $statement->store_result();
        $isEmailExist = $statement->num_rows > 0 ? true : false;

        return $statement->num_rows > 0;
    }

    function isUsernameExist($username, $tableName)
    {
        $query = "SELECT id from " . $tableName . " WHERE username=?";

        $statement = $this->conn->prepare($query);

        $statement->bind_param('s', $username);

        $statement->execute();
        $statement->store_result();
        $isUsernameExist = $statement->num_rows > 0 ? true : false;

        return $statement->num_rows > 0;
    }

    function isIdExist($username, $email, $tableName)
    {
        $query = "SELECT id from " . $tableName . " WHERE username=? OR email=?";

        $statement = $this->conn->prepare($query);

        $statement->bind_param('ss', $username, $email);

        $statement->execute();
        $statement->store_result();
        $isIdExist = $statement->num_rows > 0 ? true : false;

        return $statement->num_rows > 0;
    }

    function loginByUsername($username, $password, $tableName)
    {
        $query = "SELECT id from " . $tableName . " WHERE username=? AND password=?";

        $statement = $this->conn->prepare($query);

        $statement->bind_param('ss', $username, $password);

        $statement->execute();
        $statement->store_result();
        $isIdExist = $statement->num_rows > 0 ? true : false;

        return $statement->num_rows > 0;
    }

    function login($tableName, $email, $password)
    {
        if ($this->isEmailExist($tableName, $email)) {
            $query = "SELECT id from " . $tableName . " WHERE email=? AND password=?";

            $statement = $this->conn->prepare($query);
            $statement->bind_param('ss', $email, $password);

            // return $statement->num_rows > 0;
            if ($statement->execute()) {
                return $statement->get_result()->fetch_assoc();
            } else return false;
        } else {
            return false;
        }

        // $statement->execute();
        // $statement->store_result();
        // $isIdExist = $statement->num_rows > 0 ? true : false;



        return false;
    }

    // for inserting user and admin in database
    function insertPerson()
    { }

    //  RETRIEVING PART

    // for RETRIEVING single element using id in a table
    function getSingleData($tableName, $id)
    {

        $query = "SELECT * FROM " . $tableName . " WHERE id = ?";

        $statement = $this->conn->prepare($query);
        $statement->bind_param('i', $id);

        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        return json_encode($result);
    }


    // for RETRIEVING all element from a table
    function getAll($tableName)
    {
        $query = "SELECT * FROM " . $tableName;
        $mysqli = $this->getConn();
        // $statement = $this->conn-> prepare($query);
        $data = $mysqli->query($query);
        // $statement->execute();

        $result = array();
        while ($row = $data->fetch_assoc()) {
            $result[] = $row;
        }

        return json_encode($result);
    }

    // for RETRIEVING limited values from a table
    function getLimitedData($tableName, $limit)
    {
        $query = "SELECT * FROM " . $tableName . " ORDER BY id DESC LIMIT " . $limit;
        $mysqli = $this->getConn();
        // $statement = $this->conn-> prepare($query);

        // $statement->execute();

        if ($data = $mysqli->query($query)) {
            $result = array();
            while ($row = $data->fetch_assoc()) {
                $result[] = $row;
            }

            return json_encode($result);
        }
        return;
    }

    function getDestination($id)
    {

        $query = "SELECT * FROM `destination` WHERE id = ?";

        $statement = $this->conn->prepare($query);
        $statement->bind_param('i', $id);

        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        return json_encode($result);
    }

    function getTotalCount($tableName)
    {
        $query = "SELECT COUNT(id) as total From " . $tableName . ";";

        $statement = $this->conn->prepare($query);

        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        $total = $result['total'];
        return $total;
    }

    // UPDATE PART
    function updateDestination($name, $location, $description, $image)
    { }

    //for updating admin and user profile
    function updateProfile($tableName, $id)
    {
        $query = "UPDATE `user` SET `firstName`=?, `lastName`=?, `username`=?, `email`=?, 
        `password`=?, `gender`=? WHERE id=?;";

        $statement = $this->conn->prepare($query);
        $statement->bind_param(
            'ssssssi',
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['username'],
            $_POST['email'],
            $_POST['password'],
            $_POST['gender'],
            $id
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // DELETE PART
    function deleteSingleData($tableName, $id)
    {

        $query = "DELETE FROM " . $tableName . " WHERE id = ?";

        $statement = $this->conn->prepare($query);
        $statement->bind_param('i', $id);

        $result = $statement->execute();
        return $result;
    }

    // FOR Rating Operations

    // Get total number of likes AND dislikes for a particular post
    function getRatingAction($destination_id, $action)
    {
        $query = "SELECT COUNT(*) FROM destination_rating_info
            WHERE destination_id = $destination_id AND rating_action= '$action'";

        $rs = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_array($rs);

        // $statement = $this->conn->prepare($query);
        // $statement->execute();
        // $result = $statement->get_result()->fetch_assoc();
        return $result['0'];
    }

    // Get total number of likes and dislikes for a particular post
    function getRating($destination_id)
    {
        $rating = array();
        $likes_query = "SELECT COUNT(*) FROM destination_rating_info WHERE destination_id = $destination_id AND rating_action='like'";
        $dislikes_query = "SELECT COUNT(*) FROM destination_rating_info 
		  			WHERE destination_id = $destination_id AND rating_action='dislike'";
        $likes_rs = mysqli_query($this->conn, $likes_query);
        $dislikes_rs = mysqli_query($this->conn, $dislikes_query);
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
        $sql = "SELECT * FROM destination_rating_info WHERE user_id=$user_id 
  		  AND destination_id=$destination_id AND rating_action='like'";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Check if user already dislikes post or not
    function userDisliked($user_id, $destination_id)
    {
        $sql = "SELECT * FROM destination_rating_info WHERE user_id=$user_id 
  		  AND destination_id=$destination_id AND rating_action='dislike'";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
