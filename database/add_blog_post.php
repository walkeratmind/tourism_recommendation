<?php

    // require_once dirname(__FILE__) . './dboperation.php';
    require_once dirname(__FILE__) . './dbconnect.php';


    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (isset($_POST['submit'])) {
            if (isset($_POST['post']) && isset($_POST['user_id']) && !empty($_POST['post'])) {

                $database = new dbconnect();
                $mysqli = $database -> connect();

                //date time fiel is updated automatically
                $query = "INSERT  INTO `user_post`(`id`, `datetime`, `user_id`, `post`)
                    VALUES (NULL, NULL, ? , ?) ;";

                $user_id = $_POST['user_id'];
                $post = $_POST['post'];
                
                $stmt = $mysqli -> prepare($query);
                $stmt -> bind_param('is',$_POST['user_id'], $_POST['post']);
        
                if ($stmt -> execute()) {
                    $_SESSION['message'] = "Posted";
                    $_SESSION['msg_type'] = "success";
                    header('location: ../blog.php');
                    // exit;
                } else {
                    $_SESSION['message'] = "Error Posting, Try Again";
                    $_SESSION['msg_type'] = "warning";
                    header('location: ../blog.php');
                    // exit;
                }

                // close the connection
                $mysqli->close();
            }
        } else {
            
            $_SESSION['message'] = "Error Posting, Try Again";
            $_SESSION['msg_type'] = "warning";
            header('location: ../blog.php');
        }
    }
    else{
        $_SESSION['message'] = ", Try Again";
        $_SESSION['msg_type'] = "warning";
        echo "Invalid Request";

    }
