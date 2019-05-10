<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <?php 
        require_once dirname(__FILE__). './../database/dboperation.php';     
        require dirname(__FILE__). './../inc/lib.php';
        require dirname(__FILE__). './../inc/utils.php';

        utils::toastMessage();
    ?>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-center"><h5>Register</h5></div>
                    <div class="card-body">

                        <form class="form-horizontal" method="post" action='../database/insert_admin.php'>

                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">First Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="firstName" id="first_name"
                                            placeholder="First Name" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Last Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="lastName" id="last_name"
                                            placeholder="Last Name" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="name" class="cols-sm-10 control-label">Username</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-users"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="Username" />
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
                                    <input type="radio" name="gender" value="male" class="radio" id="gender" /> Male
                                    <input type="radio" name="gender" value="female" class="radio" /> Female
                                    <input type="radio" name="gender" value="other" class="radio" /> Other
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

</body>

</html>