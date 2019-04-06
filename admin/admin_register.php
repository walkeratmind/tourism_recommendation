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
                    <div class="card-header">Register</div>
                    <div class="card-body">

                    <?php if (isset($_SESSION['msg_type'])) {
                        echo '<div class="alert alert-' . $_SESSION['msg_type'] . '\"> role="alert"' 
                        . $_SESSION['message'] .'</div>';
                    }
                    ?>

                        <form class="form-horizontal" method="post" action="">

                            <div class="row">

                                <div class="form-group col">
                                    <label for="name" class="cols-sm-2 control-label">First Name</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"
                                                        aria-hidden="true"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="firstName" id="first_name"
                                                placeholder="Enter your Name" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <label for="name" class="cols-sm-2 control-label">Last Name</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"
                                                        aria-hidden="true"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="lastName" id="last_name"
                                                placeholder="Enter your Name" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="name" class="cols-sm-10 control-label">User Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-users"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="Enter your Username" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Email</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fas fa-envelope"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="email" id="email"
                                            placeholder="Enter your Email" />
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
                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-lock fa-lg"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="confirm" id="confirm"
                                            placeholder="Confirm your Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <div class="col-sm-10">
                                    <input type="radio" name="radio" value="yes" class="radio" id="gender"
                                        <?php if (isset($_POST['radio']) && $_POST['radio'] == 'male'): ?>checked='checked'
                                        <?php endif; ?> /> Male
                                    <input type="radio" name="radio" value="no" class="radio"
                                        <?php if (isset($_POST['radio']) && $_POST['radio'] ==  'female'): ?>checked='checked'
                                        <?php endif; ?> /> Female
                                    <input type="radio" name="radio" value="no" class="radio"
                                        <?php if (isset($_POST['radio']) && $_POST['radio'] ==  'other'): ?>checked='checked'
                                        <?php endif; ?> /> Other
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" name="register_btn"
                                    class="btn btn-primary btn-lg btn-block login-button">Register</button>
                            </div>
                            <div class="login-register">
                                <a class="btn btn-primary btn-lg btn-block" href="index.php">Login</a>
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

    if (isset($_POST['register_btn'])) {
        $mysqli = $database -> connect();

        $query = "INSERT  INTO `admin`(`id`, `firstName`, `lastName`, `username`, `email`, `password`, `gender`)
            VALUES (NULL, ?, ? , ? , ? , ? , ?) ;";

        $stmt = $mysqli -> prepare($query);
        $stmt -> bind_param('ssssss',$_POST['firstName'], $_POST['lastName'], $_POST['username'], 
            $_POST['email'], $_POST['password'], $_POST['radio']);

        if ($stmt -> execute()) {
            $_SESSION['message'] = "Registered Successfully";
            $_SESSION['msg_type'] = "success";
            header('Location:index.php?');
            exit;
        } else {
            $_SESSION['message'] = "Registeration Error";
            $_SESSION['msg_type'] = "warning";
            // header('Location:admin_login.php?');
            exit;
        }
    }

    function isUserExist($email, $username) {
        
    }

?>
</body>

</html>