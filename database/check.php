<?php 

require_once './dboperation.php';

    $db= new dboperation();
    echo $db->isUsernameExist('user','abc');
    echo '<br/>';
    echo $db->isEmailExist('user','abc@gmail.com');

    if ($db-> isEmailExist('user',  'abc@gmail.com')) {
        echo 'true';
    }

?>