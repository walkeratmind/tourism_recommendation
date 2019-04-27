<?php

    // require_once dirname(__FILE__) . './dboperation.php';
    require_once dirname(__FILE__) . './dbconnect.php';


    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (isset($_POST['submit'])) {
            if (isset($_POST['feedback']) && isset($_POST['user_id']) && !empty($_POST['feedback'])) {

                $database = new dbconnect();
                $mysqli = $database -> connect();

                //date time fiel is updated automatically
                $query = "INSERT  INTO `feedback`(`id`, `datetime`, `user_id`, `feedback`)
                    VALUES (NULL, NULL, ? , ?) ;";

                $user_id = $_POST['user_id'];
                $feedback = $_POST['feedback'];
                
                // $query = "INSERT  INTO `feedback`(`id`, `datetime`, `user_id`, `feedback`)
                //     VALUES (NULL, CURDATE(), '$user_id', '$feedback') ;";
        
                $stmt = $mysqli -> prepare($query);
                $stmt -> bind_param('is',$_POST['user_id'], $_POST['feedback']);
        
                if ($stmt -> execute()) {
                    $_SESSION['message'] = "Feedback Sent";
                    $_SESSION['msg_type'] = "success";
                    header('location: ../index.php');
                    // exit;
                } else {
                    $_SESSION['message'] = "Error Sending Feedback, Try Again";
                    $_SESSION['msg_type'] = "warning";
                    // header('location: ../index.php');

                    echo "Error Sending Feedback, Try Again";
                    // exit;
                }

                // close the connection
                $mysqli->close();
            }
        } else {
            
            $_SESSION['message'] = "Error Sending Feedback, Try Again";
            $_SESSION['msg_type'] = "warning";
            header('location: ../index.php');
        }
    }
    else{
        $_SESSION['message'] = ", Try Again";
        $_SESSION['msg_type'] = "warning";
        echo "Invalid Request";

    }
