<?php

    require_once dirname(__FILE__). './../database/dbconnect.php';
    require_once dirname(__FILE__). './../database/dboperation.php';

    $database = new dbconnect();
    $db = new dboperation();

    // using synchronous way
    
    if (isset($_POST['register_btn'])) {
        $mysqli = $database -> connect();

        $firstName = ucfirst(strtolower($_POST['firstName']));
        $lastName = ucfirst(strtolower($_POST['lastName']));
        $username = strtolower($_POST['username']);
        $email = strtolower($_POST['email']);
        $admin_role = "pending";

        $query = "INSERT  INTO `admin`(`id`, `firstName`, `lastName`, `username`, `email`, `password`, `gender`, `role`)
            VALUES (NULL, ?, ? , ? , ? , ? , ?, ?) ;";

        $stmt = $mysqli -> prepare($query);
        $stmt -> bind_param('sssssss',$firstName, $lastName, $username, 
            $email, $_POST['password'], $_POST['gender'], $admin_role);

            $tableName = "admin";

            if ($db-> isEmailExist($tableName, $email) && $db -> isUsernameExist($tableName, $username)) {
                $_SESSION['message'] = "Username and email already exists, Try another ";
                $_SESSION['msg_type'] = "warning";
                $_SESSION['is_registered'] = "false";
                header('location: ../admin/admin_register.php?');
            }
            else if ($db-> isEmailExist($tableName, $email)) {
                echo '<script>console.log("email exists")</script>';
    
                $_SESSION['message'] = "Email already registered, Try another email";
                $_SESSION['msg_type'] = "warning";
                $_SESSION['is_registered'] = "false";
                header('location: ../admin/admin_register.php?');
            } else if ($db-> isUsernameExist($tableName, $username)) {
                $_SESSION['message'] = "username already exists, Try another username";
                $_SESSION['msg_type'] = "warning";
                $_SESSION['is_registered'] = "false";
                header('location: ../admin/admin_register.php?');
            } 
             else {
    
                // execute the registeratoin process
    
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
    }


?>