<?php

    require_once dirname(__FILE__). './dbconnect.php';
    require_once dirname(__FILE__). './dboperation.php';


    $database = new dbconnect();
    $db = new dboperation();

    // using synchronous way
    
    if (isset($_POST['register_btn'])) {
        $mysqli = $database -> connect();

        $firstName = ucfirst(strtolower($_POST['firstName']));
        $lastName = ucfirst(strtolower($_POST['lastName']));
        $username = strtolower($_POST['username']);
        $email = strtolower($_POST['email']);

        $query = "INSERT  INTO `user`(`id`, `firstName`, `lastName`, `username`, `email`, `password`, `gender`)
            VALUES (NULL, ?, ? , ? , ? , ? , ?) ;";

        $stmt = $mysqli -> prepare($query);
        $stmt -> bind_param('ssssss',$firstName, $lastName, $username,
            $_POST['email'], $_POST['password'], $_POST['gender']);
        
        $tableName = "user";

        if ($db-> isEmailExist($tableName, $email) && $db -> isUsernameExist($tableName, $username)) {
            $_SESSION['message'] = "Username and email already exists, Try another ";
            $_SESSION['msg_type'] = "warning";
            $_SESSION['is_registered'] = "false";
            header('location: ../user_register.php?');
        }
        else if ($db-> isEmailExist($tableName, $email)) {
            echo '<script>console.log("email exists")</script>';

            $_SESSION['message'] = "Email already registered, Try another email";
            $_SESSION['msg_type'] = "warning";
            $_SESSION['is_registered'] = "false";
            header('location: ../user_register.php?');
        } else if ($db-> isUsernameExist($tableName, $username)) {
            $_SESSION['message'] = "username already exists, Try another username";
            $_SESSION['msg_type'] = "warning";
            $_SESSION['is_registered'] = "false";
            header('location: ../user_register.php?');
        } 
         else {

            // execute the registeratoin process

             if ($stmt -> execute()) {
                 $_SESSION['message'] = "Registeration Successful";
                 $_SESSION['msg_type'] = "success";
                 $_SESSION['is_registered'] = "true";
                 header('location: ../index.php');
                 // exit;
             } else {
                 $_SESSION['message'] = "Registeration Failed, Try Again";
                 $_SESSION['msg_type'] = "warning";
                 header('location: ../user_register.php?');
                 // exit;
             }
         }

    }


?>