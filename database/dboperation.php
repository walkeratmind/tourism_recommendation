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
        $query = "SELECT id from " . $tableName . " WHERE email=?";

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

    function login($email, $password, $tableName)
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

    function getDestination($id)
    {

        $query = "SELECT * FROM `destination` WHERE id = ?";

        $statement = $this->conn->prepare($query);
        $statement->bind_param('i', $id);

        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        return json_encode($result);
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
}
