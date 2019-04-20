<!DOCTYPE html>
<html lang="en">

<?php
        // require_once './inc/lib.php';
        require_once dirname(__FILE__). './database/dboperation.php';     
        require_once dirname(__FILE__) . './header.php';

        // utils::toastMessage();
        utils::checkUserLogin();
    ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

</head>

<body>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body ">

                        <?php 
                                utils::message();
                                ?>
                        <form class="form-horizontal needs-validation" novalidate method="post" action='./database/user_login_form.php'>

                            <div class="form-group ">
                                <label for="name" class="cols-sm-10 control-label">Username or Email</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-users"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="username" id="last_name"
                                            placeholder="Username or Email" required />
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
                                            placeholder="Enter your Password" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <button type="submit" name="login"
                                    class="btn btn-primary btn-lg btn-block login-button">Login</button>
                            </div>
                            <div class="login-register">
                                <a class="btn btn-primary btn-lg btn-block" href="user_register.php">Register</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

<script>
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    function validate(field) {
        // var field = document.getElementById('text1').value;

        // CHeck if email
        if (/\@/.test(field)) {
            // Validate email address
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(field)) {
                return (true);
                <?php $_SESSION['email'] = real_escape_string($_POST['username']); ?>
            }
            console.log("You have entered an invalid email address!");
            return (false)
        } else {
            // Validate username
            <?php $_SESSION['username'] = real_escape_string($_POST['username']) ?>
        }
    }
</script>

</html>