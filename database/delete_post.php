<?php

    require_once dirname(__FILE__) . './../database/dboperation.php';

    $db = new dboperation();
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            echo '<script> console.log("Clicked: '. $id .'")</script>';

            $tableName = 'user_post';
            $result = $db->deleteSingleData($tableName ,$id);
            echo '<script> console.log("Result: '. $result .'")</script>';

            // $destination =  json_decode($result, true);
            // echo implode(",", $obj);

            if ($result == 'true') {
                $_SESSION['error'] = false;
                $_SESSION['msg_type'] = 'success';
                $_SESSION['message'] = "Post Deleted";
            } else {
                $_SESSION['error'] = true;
                $_SESSION['msg_type'] = 'danger';
                $_SESSION['message'] = "Internal Server Error";
            }

        }
    } else {
        $_SESSION['error'] = true;
        $_SESSION['msg_type'] = 'danger';
        $_SESSION['message'] = "Invalid request";

    }
    header('location:../post_list.php');
?>