<?php

require_once dirname(__FILE__) . './../database/dboperation.php';
require_once dirname(__FILE__) . './../database/dbconnect.php';

$database = new dbconnect();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id']) && isset($_GET['type'])) {
        $id = $_GET['id'];
        $requestType = $_GET['type'];

        echo '<script> console.log("Clicked: ' . $id . '")</script>';

        if ($requestType == 'approve') {
            $query = "UPDATE `admin` SET role = 'admin' WHERE id = ? ;";
        } else {
            $query = "DELETE FROM `admin` WHERE id = ? ; ";
        }

        if ($requestType == 'delete') {
            $query = "DELETE FROM `admin` WHERE id = ? ; ";
        }
        

        $tableName = 'admin';
        $mysqli = $database->connect();

        if (!empty($query)) {
            $statement = $mysqli->prepare($query);
            $statement->bind_param('i', $id);
            $result = $statement->execute();
        }
        else {
            $_SESSION['error'] = true;
            $_SESSION['msg_type'] = 'danger';
            $_SESSION['message'] = "SQL Query Empty";

            header('location:./index.php');
        }
    
        // $destination =  json_decode($result, true);
        // echo implode(",", $obj);

        if ($result == 'true') {
            $_SESSION['error'] = false;
            $_SESSION['msg_type'] = 'success';

            // $_SESSION['message'] = $requestType == 'approve'
            //     ? "Admin Request Approved" : "Admin Request Rejected";
            if ($requestType == 'approve') {
                $_SESSION['message'] = "Admin Request Approved";
            } else if($requestType == 'delete') {
                $_SESSION['message'] = "Admin Removed";
            } else {
                $_SESSION['message'] = "Admin Request Rejected";
            }
        } else {
            $_SESSION['error'] = true;
            $_SESSION['msg_type'] = 'danger';
            $_SESSION['message'] = "Internal Server Error";
        }
    } else {
        $_SESSION['error'] = true;
        $_SESSION['msg_type'] = 'danger';
        if (!isset($_GET['id']))
            $_SESSION['message'] = "id is not set";
        else
            $_SESSION['message'] = "type is not set";
    }
} else {
    $_SESSION['error'] = true;
    $_SESSION['msg_type'] = 'danger';
    $_SESSION['message'] = "Invalid request";
}
header('location:./index.php');
