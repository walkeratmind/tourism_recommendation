<?php

    require_once dirname(__FILE__) . './../database/dbconnect.php';

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
            echo " <div id='alert-message' class='alert alert-" . $_SESSION['msg_type'] . "'>" .
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

    // for Admin Authentication
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


    // for users authentication
    public static function isUser()
    {
        if (isset($_SESSION['isUser']) && $_SESSION['isUser'] === true)
            return true;

        return false;
    }
    public static function checkUserLogin()
    {
        if (!utils::isUser()) {
            $_SESSION['msg_type'] = 'danger';
            $_SESSION['message'] = "Invalid Login";
            header('location: ./index.php');
        } else {
            $_SESSION['msg_type'] = 'success';
            $_SESSION['message'] = "Logged In";
            header('location: ./index.php');
        }
    }

    //if total word is passed then , it is assigned otherwise
    // default value is 3
    public static function getDefinateString($string, $total_words = 3) {
        $arr = preg_split('/[,\ \.;]/', $string);
        $keywords = array_unique($arr);
        $result =  '';
        $i=0;
        foreach ($keywords as $keyword){
                    if ((preg_match("/^[a-z0-9]/", $keyword) )){
                            $result = $result . $keyword . ' ';
                            $i++;
                            if ($i== $total_words) {
                                $result = $result . '...';
                                break;
                            };
                            
                    }
                }
        return $result;
    }
}

function alertMessage($message, $msg_type)
{
    echo " <div class='alert alert-" . $msg_type . "'>" .
        $message .
        "</div>";
}

?>  