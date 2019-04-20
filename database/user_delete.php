<?php
require_once dirname(__FILE__) . './dboperation.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $db = new dboperation();

        $tableName = 'user';
        $result = $db->deleteSingleData($tableName, $id);

        if ($result == true) {
            $_SESSION['error'] = false;
            $_SESSION['msg_type'] = 'success';

            //uset the current session
            unset($_SESSION['isUser']);
            unset($_SESSION['user_id']);

            $_SESSION['message'] = "Account Deleted";
            header('location: ../index.php');
        } else {
            $_SESSION['error'] = true;
            $_SESSION['msg_type'] = 'danger';
            $_SESSION['message'] = "Internal Server Error";
            header('location: ../index.php');
        }
    } else {
        $_SESSION['error'] = true;
        $_SESSION['msg_type'] = 'danger';
        $_SESSION['message'] = "Internal Server Error";
        header('location: ../index.php');
    }
} else {
    $_SESSION['error'] = true;
    $_SESSION['msg_type'] = 'danger';
    $_SESSION['message'] = "Internal Server Error";
    header('location: ../index.php');
}
