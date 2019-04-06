<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login</title>
<?php require dirname(__FILE__). './../inc/lib.php'; ?>

</head>
<body>
<div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">

                    <?php if (isset($_SESSION['msg_type'])) {
                        echo '<div class="alert alert-' . $_SESSION['msg_type'] . '\">' 
                        . $_SESSION['message'] .'</div>';
                    }
                    ?>
                        <form class="form-horizontal" method="post" action="#">

                            <div class="form-group ">
                                <label for="name" class="cols-sm-10 control-label">Username or Email</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-users"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="username" id="last_name"
                                            placeholder="Username or Email" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-lock fa-lg"
                                                    aria-hidden="true"></i></span>
                                        </div>

                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Enter your Password" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group ">
                                <button type="submit" name="login_btn"
                                    class="btn btn-primary btn-lg btn-block login-button">Login</button>
                            </div>
                            <div class="login-register">
                                <a class="btn btn-primary btn-lg btn-block" href="admin_register.php">Register</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


<?php

    require_once dirname(__FILE__). './../database/dbconnect.php';

    $database = new dbconnect();

    if (isset($_POST['login'])) {
        $mysqli = $database -> connect();

        $query = "SELECT `id` FROM `admin` WHERE `email`= ? OR `username` = ? AND `password` = ?;";

        $stmt = $mysqli -> prepare($query);
        $stmt -> bind_param('sss', $_POST['username'], $_POST['email'], $_POST['password']);

        $stmt -> execute();
        $stmt -> store_result();

        if ($stmt -> num_rows() > 0) {
            
        }
    }

    function isUserExist($email, $username) {
        
    }

?>
</body>
</html>                                		                            