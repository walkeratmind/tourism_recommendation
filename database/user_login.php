<?php
            require_once dirname(__FILE__). './../database/dboperation.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        
        $database = new dboperation();
    
        if (isset($_POST['login'])) {

            $tableName = 'user';

            $id = $database->login($_POST['email'], $_POST['password'], $tableName);
            if ($id) {
                $_SESSION['isUser'] = true;
                $_SESSION['user_id'] = $id['id'];
                $_SESSION['msg_type'] = 'success';
                $_SESSION['message'] = 'Login Successful';
                header('location: ../index.php');

            } else {
                $_SESSION['isUser'] = false;
                $_SESSION['message'] = "Invalid Email or Password";
                $_SESSION['msg_type'] = "danger";
                header('location: ../index.php');
            }

            // if input is username
            // if (isset($_SESSION['username'])) {
            //     if ($database->loginByUsername($_SESSION['username'], $_POST['password'], $tableName)) {
            //         $_SESSION['islogged'] = true;
            //         $_SESSION['msg_type'] = 'success';
            //         $_SESSION['message'] = 'Login Successful';
            //         header('location: ./index.php');
            //     } else {
            //         $_SESSION['islogged'] = false;
            //         $_SESSION['message'] = "Invalid Login";
            //         $_SESSION['msg_type'] = "danger";
            //         header('location: ./index.php');

            //     }
            // }
        }
    }

    function isUserExist($email, $username) {
        
    }

?>