<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once dirname(__FILE__). './../database/dbconnect.php';
        require_once dirname(__FILE__). './../database/dboperation.php';
        
        $database = new dboperation();
    
        if (isset($_POST['login'])) {

            $tableName = 'admin';
            

            if ($database->login($_POST['username'], $_POST['password'], $tableName)) {
                $_SESSION['isAdmin'] = true;
                $_SESSION['msg_type'] = 'success';
                $_SESSION['message'] = 'Login Successful';
                header('location: ../admin/index.php');

            } else {
                $_SESSION['isAdmin'] = false;
                $_SESSION['message'] = "Invalid Email or Password";
                $_SESSION['msg_type'] = "danger";
                header('location: ../admin/admin_login.php');
            }
            //if input is email
            // if(isset($_SESSION['email'])) {
            //     if ($database->login($_SESSION['email'], $_POST['password'], $tableName)) {
            //         $_SESSION['isAdmin'] = true;
            //         $_SESSION['msg_type'] = 'success';
            //         $_SESSION['message'] = 'Login Successful';
            //         header('location: ../admin/index.php');

            //     } else {
            //         $_SESSION['isAdmin'] = false;
            //         $_SESSION['message'] = "Email Not Found";
            //         $_SESSION['msg_type'] = "danger";
            //         header('location: ../admin/admin_login.php');
            //     }

            // }



            // if input is username
            if (isset($_SESSION['username'])) {
                if ($database->loginByUsername($_SESSION['username'], $_POST['password'], $tableName)) {
                    $_SESSION['islogged'] = true;
                    $_SESSION['msg_type'] = 'success';
                    $_SESSION['message'] = 'Login Successful';
                    header('location: ./index.php');
                } else {
                    $_SESSION['islogged'] = false;
                    $_SESSION['message'] = "Username Not Found";
                    $_SESSION['msg_type'] = "danger";
                    header('location: ../admin/admin_login.php');

                }
            }

            // if ($database->isIdExist($_POST['username'], $email , $tableName)) {

            // } else {
            //     $_SESSION['islogged'] = true;
            //     $_Session['email'] = $email;
            // }
            
            // $mysqli = $database -> connect();
    
            // $query = "SELECT `id` FROM `admin` WHERE `email`= ? OR `username` = ? AND `password` = ?;";
    
            // $stmt = $mysqli -> prepare($query);
            // $stmt -> bind_param('sss', $_POST['username'], $_POST['email'], $_POST['password']);
    
            // $stmt -> execute();
            // $stmt -> store_result();
    
            // if ($stmt -> num_rows > 0) {
                
            // }
        }
    }

    function isUserExist($email, $username) {
        
    }

?>