<?php
    require_once dirname(__FILE__) .'./database/dboperation.php';

    $db = new dboperation();
    
    if (isset($_GET['logout'])) {
    
        // unset($_SESSION['email']);
        unset($_SESSION['isUser']);
        unset($_SESSION['user_id']);
        $_SESSION['msg_type'] = 'danger';
        $_SESSION['message'] = "Logged out";
        header('location: ./index.php');
    }

?>