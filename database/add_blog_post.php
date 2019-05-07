<?php

// require_once dirname(__FILE__) . './dboperation.php';
require_once dirname(__FILE__) . './dbconnect.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['submit'])) {
        if (isset($_POST['post']) && isset($_POST['user_id']) && !empty($_POST['post'])) {


            // if (!is_dir())
            $target_dir = SITE_ROOT . "/../imageUploads/blog_image/";

            if (!is_dir($target_dir)) {
                mkdir($target_dir);
            }
            if (isset($_FILES['image'])) {
                $image = $_FILES['image']['name'];    //image
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
            }

            // Select file type
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("jpg", "jpeg", "png", "gif");

            // Check extension
            if (in_array($imageFileType, $extensions_arr) || empty($image)) {

                $database = new dbconnect();
                $mysqli = $database->connect();

                //date time fiel is updated automatically
                $query = "INSERT  INTO `user_post`(`id`, `datetime`, `user_id`, `title`, `post`, `image`)
                    VALUES (NULL, NULL, ? , ?, ?, ?) ;";

                $user_id = $_POST['user_id'];
                $title = $_POST['title'];
                $post = $_POST['post'];

                $stmt = $mysqli->prepare($query);
                $stmt->bind_param('isss', $_POST['user_id'], $_POST['title'], $_POST['post'], $image);

                if ($stmt->execute()) {
                    // Upload file
                    move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $image);
                    $_SESSION['message'] = "Posted";
                    $_SESSION['msg_type'] = "success";
                    // exit;
                } else {
                    $_SESSION['message'] = "Error Posting, Try Again";
                    $_SESSION['msg_type'] = "warning";
                    // exit;
                }

                // Close connection
                $stmt->close();
                $mysqli->close();
            } else {
                $_SESSION['message'] = "Invalid Image Format, Try Again";
                $_SESSION['msg_type'] = "warning";
            }
        } else {

            $_SESSION['message'] = "Error Posting, Try Again";
            $_SESSION['msg_type'] = "warning";
        }
    } else {

        $_SESSION['message'] = "Error Posting, Try Again";
        $_SESSION['msg_type'] = "warning";
    }
    header('location: ../post_list.php');
} else {
    $_SESSION['message'] = ", Try Again";
    $_SESSION['msg_type'] = "warning";
    echo "Invalid Request";
}
