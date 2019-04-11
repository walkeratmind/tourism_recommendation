<?php

class utils
{

    public static function is_session_started()
    {
        if (php_sapi_name() !== 'cli') {
            if (version_compare(phpversion(), '5.4.0', '>=')) {
                return session_status() === PHP_SESSION_ACTIVE ? true : false;
            } else {
                return session_id() === '' ? false : true;
            }
        }
        return false;
    }
    public static function message()
    {
        if (isset($_SESSION['message'])) {
            echo " <div class='alert alert-" . $_SESSION['msg_type'] . "'>" .
                $_SESSION['message'] .
                "</div>";
            unset($_SESSION['message']);
        }
    }

    public static function toastMessage()
    {
        if (isset($_SESSION['message'])) {
            echo "<script>
            Snackbar.show({
                text: '". $_SESSION['message'] ."',
                pos:'bottom-center',
                duration: '3000'
            }); </script>";
            unset($_SESSION['message']);
         }
        //  unset($_SESSION['messsage']);

    }

    public static function isAdmin()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true)
            return true;

        return false;
    }

    public static function checkAdminLogin()
    {
        if (!utils::isAdmin()) {
            $_SESSION['msg_type'] = 'danger';
            $_SESSION['message'] = "Please Login first";
            header('location: ./admin_login.php');
        }
    }
}

function alertMessage($message, $msg_type)
{
    echo " <div class='alert alert-" . $msg_type . "'>" .
        $message .
        "</div>";
}

?>

<html>
<link rel="stylesheet" type="text/css" href="../assets/snackbar/snackbar.min.css" />
<script src="../assets/snackbar/snackbar.min.js">
</script>

</html>