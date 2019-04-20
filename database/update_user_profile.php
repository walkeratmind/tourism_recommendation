<?php

    require_once dirname(__FILE__). './dboperation.php';

    $database = new dboperation();

    // using synchronous way
    
    if (isset($_POST['submit'])) {
        

        if ($database->updateProfile('user', $_SESSION['user_id'])) {
            $_SESSION['message'] = "Update Successful";
            $_SESSION['msg_type'] = "success";
            header('location: ../index.php');
            // exit;
        } else {
            $_SESSION['message'] = "Update Failed, Try Again";
            $_SESSION['msg_type'] = "warning";
            header('location: ../index.php?');
            // exit;
        }
    }
?>