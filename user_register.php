<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Login</title>

    <?php
    require_once dirname(__FILE__) . './database/dboperation.php';
    require_once dirname(__FILE__) . './header.php';
    // require_once dirname(__FILE__). './inc/utils.php';

    utils::toastMessage();
    ?>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-center">
                        <h5>Register</h5>
                    </div>
                    <div class="card-body">

                        <?php

                        // if (isset($_SESSION['message'])) {
                        //     echo " <div class='alert alert-" . $_SESSION['msg_type'] . "'>" .
                        //         $_SESSION['message'] .
                        //         "</div>";
                        //     unset($_SESSION['message']);
                        // }

                        // if (isset($_SESSION['msg_type']) && isset($_SESSION['message'])) {
                        //     alertMessage($_SESSION['message'], $_SESSION['msg_type']);
                        //     unset($_SESSION['message']);
                        //     unset($_SESSION['msg_type']);
                        // }
                        // utils::message();
                        ?>

                        <form class="form-horizontal needs-validation" novalidate method="post" action='./database/insert_user.php'>

                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">First Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="firstName" id="first_name" placeholder="First Name" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Last Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="lastName" id="last_name" placeholder="Last Name" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="name" class="cols-sm-10 control-label">Username</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-users" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Email</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        </div>

                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="confirm" id="confirm_password" placeholder="Confirm Password" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <div class="col-sm-10 ">
                                    <div class="form-check">
                                        <input type="radio" name="gender" value="male" class="form-check-input" id="male" checked />
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="gender" value="female" class="form-check-input" id="female" />
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="gender" value="other" class="form-check-input" id="other" />
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" name="register_btn" class="btn btn-primary btn-lg btn-block login-button">Register</button>
                            </div>
                            <div class="login-register">
                                <a class="btn btn-primary btn-lg btn-block" href="user_login_form.php">Login</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        // var password = document.getElementById("password"),
        //     confirm_password = document.getElementById("confirm_password");

        // function validatePassword() {
        //     if (password.value != confirm_password.value) {
        //         confirm_password.setCustomValidity("Passwords Don't Match");
        //     } else {
        //         confirm_password.setCustomValidity("");
        //     }
        // }
        // password.onchange = validatePassword;
        // confirm_password.onkeyup = validatePassword;

        function isPasswordInvalid() {
            if (password != confirm_password) {
                return true;
            }
            return false;
        }
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');

                var password = document.getElementById("password"),
                    confirm_password = document.getElementById("confirm_password");
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);

                    confirm_password.addEventListener("input", function() {
                        if (password != confirm_password) {
                            // confirm_password.setCustomValidity("Don't Match");
                            event.preventDefault();
                            event.stopPropagation();
                        }
                    }, false);
                });


            }, false);
        })();
    </script>

</body>

</html>