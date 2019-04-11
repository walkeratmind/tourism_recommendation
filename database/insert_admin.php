<?php

    require_once dirname(__FILE__). './../database/dbconnect.php';

    $database = new dbconnect();

    // using synchronous way
    
    if (isset($_POST['register_btn'])) {
        $mysqli = $database -> connect();

        $query = "INSERT  INTO `admin`(`id`, `firstName`, `lastName`, `username`, `email`, `password`, `gender`)
            VALUES (NULL, ?, ? , ? , ? , ? , ?) ;";

        $stmt = $mysqli -> prepare($query);
        $stmt -> bind_param('ssssss',$_POST['firstName'], $_POST['lastName'], $_POST['username'], 
            $_POST['email'], $_POST['password'], $_POST['gender']);

        if ($stmt -> execute()) {
            $_SESSION['message'] = "Registeration Successful";
            $_SESSION['msg_type'] = "success";
            $_SESSION['is_registered'] = "true";
            header('location: ../admin/admin_login.php');
            // exit;
        } else {
            $_SESSION['message'] = "Registeration Failed, Try Again";
            $_SESSION['msg_type'] = "warning";
            header('location: ../admin/admin_register.php?');
            // exit;
        }
    }


?>