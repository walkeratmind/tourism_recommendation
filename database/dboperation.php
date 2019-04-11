<?php

require_once dirname(__FILE__) . './dbconnect.php';


    class dboperation {

        private $conn;

        function __construct() {

            $database = new dbconnect();

            $this->conn = $database->connect();
        }

        function isEmailExist($email, $tableName) {
            $query = "SELECT id from ". $tableName . " WHERE email=?";
            
            $statement = $this->conn->prepare($query);

            $statement->bind_param('s', $email);

            $statement->execute();
            $statement->store_result();
            $isEmailExist = $statement->num_rows > 0 ? true : false;

            return $statement->num_rows > 0;
        }

        function isUsernameExist($username, $tableName) {
            $query = "SELECT id from ". $tableName . " WHERE username=?";
            
            $statement = $this->conn->prepare($query);

            $statement->bind_param('s', $username);

            $statement->execute();
            $statement->store_result();
            $isUsernameExist = $statement->num_rows > 0 ? true : false;

            return $statement->num_rows > 0;
        }

        function isIdExist($username, $email, $tableName) {
            $query = "SELECT id from ". $tableName . " WHERE username=? OR email=?";
            
            $statement = $this->conn->prepare($query);

            $statement->bind_param('ss', $username, $email);

            $statement->execute();
            $statement->store_result();
            $isIdExist = $statement->num_rows > 0 ? true : false;

            return $statement->num_rows > 0;
        }

        function loginByUsername($username, $password, $tableName) {
            $query = "SELECT id from ". $tableName . " WHERE username=? AND password=?";
            
            $statement = $this->conn->prepare($query);

            $statement->bind_param('ss', $username, $password);

            $statement->execute();
            $statement->store_result();
            $isIdExist = $statement->num_rows > 0 ? true : false;

            return $statement->num_rows > 0;
        }

        function login($email, $password, $tableName) {
            $query = "SELECT id from ". $tableName . " WHERE email=? AND password=?";
            
            $statement = $this->conn->prepare($query);

            $statement->bind_param('ss', $email, $password);

            $statement->execute();
            $statement->store_result();
            $isIdExist = $statement->num_rows > 0 ? true : false;

            return $statement->num_rows > 0;
        }

        

        

        // for inserting user and admin in database
        function insertPerson() {

        }
    }

?>