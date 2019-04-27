<?php
require_once dirname(__FILE__) . './database/dboperation.php';

require_once dirname(__FILE__) . './inc/lib.php';
?>

<div class="navBar sticky-top">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item">
          <a class="nav-link" href="destination.php">Destination</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="events.php">Events</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.php">Blog</a>
        </li>
      </ul>

      <ul class="navbar-nav navbar-right mr-4">
        <li class="nav-item">
          <form class="form form-inline">

            <div class="search-input">
              <input class="form-control input-lg" id="search-bar" type="search" placeholder="Search"
                aria-label="Search" id="search-bar">
            </div>

          </form>
        </li>

        <li class="nav-item">
          <div class="btn-group nav-link" style="cursor: pointer; padding:4px">
            <div class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i><span id="username"> user</span>
            </div>
            <div class="dropdown-menu dropdown-menu-right">
              <h5 class="dropdown-header text-center">Account</h5>

              <?php
              if (!isset($_SESSION['user_id'])) {

                $output = '<form class="login-form px-4 py-3 needs-validation" novalidate method="POST" action="./database/user_login.php">
                  <div class="form-group">
                    <!-- <label for="exampleDropdownFormEmail1">Email</label> -->
                    <input type="email" name="email" class="form-control" id="exampleDropdownFormEmail1"
                      placeholder="email@example.com" required>
                  </div>
                  <div class="form-group">
                    <!-- <label for="exampleDropdownFormPassword1">Password</label> -->
                    <input type="password" name="password" class="form-control" id="exampleDropdownFormPassword1"
                      placeholder="Password" required>
                  </div>

                  <button type="submit" name="login" class="btn btn-primary">Sign in</button>
                </form>';

                echo $output;

                echo '<div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="./user_register.php">New around here? Sign up</a>';
              } else {

                $db  = new dboperation();
                // $id = $_SESSION['user']
                $result = json_decode($db->getSingleData('user', $_SESSION['user_id']), true);

                echo '<div class="login-info">
                  <div class="dropdown-item btn btn-primary"
                  data-toggle="modal" data-target="#userFormModal"  id="name">' . $result['firstName'] . ' ' . $result['lastName'] . '</div>
                </div>';

                echo '<div id="feedback" class="dropdown-item btn btn-primary" 
                  data-toggle="modal" data-target="#feedbackFormModal"> Send Feedback
                  </div>';

                  echo '<div id="post_list" class="dropdown-item btn btn-primary"> 
                    <a href="post_list.php" >My Posts</a>
                  </div>';

                echo '<div class="dropdown-divider"></div>';
                $output = '<a href="./user_logout.php?logout=true" class="btn btn-primary logout-btn dropdown-item" 
                  onclick="return confirm(\'Logout?\');">Logout</a>';
                echo $output;
              }
              ?>
              <style>
                #post_list a{
                  text-decoration: none;
                  color: darkgray;
                }
              </style>
            </div>
          </div>
        </li>

      </ul>


    </div>
  </nav>
</div>
<div class="conatiner">
  <div id="search-results"></div>
</div>

<!-- Add Destination Form Modal -->
<div class="modal" id="userFormModal" tabindex="-1" role="dialog" aria-labelledby="userProfile" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="addDestination">User Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <!-- form for adding destination -->

      <div class="modal-body">
        <?php

        ?>
        <form class="profile-form form-horizontal needs-validation" novalidate method="post"
          action='./database/update_user_profile.php'>

          <div class="form-group">
            <label for="name" class="cols-sm-2 control-label">First Name</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user" aria-hidden="true"></i></span>
                </div>
                <input type="text" class="form-control" name="firstName" id="first_name"
                  value="<?php echo $result['firstName'] ?>" required />
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
                <input type="text" class="form-control" name="lastName" id="last_name"
                  value="<?php echo $result['lastName'] ?>" required />
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
                <input type="text" class="form-control" name="username" id="username"
                  value="<?php echo $result['firstName'] ?>" required />
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
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $result['email'] ?>"
                  required />
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

                <input type="password" class="form-control" name="password" id="password"
                  value="<?php echo $result['password'] ?>" required />
              </div>
            </div>
          </div>
          <div class="form-group confirm-password">
            <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <div class="input-group-prepend">

                  <span class="input-group-text"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                </div>
                <input type="password" class="form-control" name="confirm" id="confirm"
                  placeholder="Confirm your Password" required />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="gender">Gender</label>
            <p class="show-gender-value"><?php echo $result['gender'] ?></p>
            <div class="col-sm-10 radio-group">

              <input type="radio" name="gender" value="male" class="radio" id="gender" /> Male
              <input type="radio" name="gender" value="female" class="radio" /> Female
              <input type="radio" name="gender" value="other" class="radio" /> Other
            </div>
          </div>

          <div class="form-group ">
            <button type="button" class="btn btn-primary btn-lg btn-block edit-button">Edit Profile</button>
          </div>

          <div class="form-group ">
            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block submit-btn">Update</button>
          </div>
          <div class="delete-button">
            <a class="btn btn-danger btn-lg btn-block" onclick="return confirm('Delete?')"
              href="./database/user_delete.php?id= <?php echo $result['id'] ?>">Delete</a>
          </div>
        </form>

        <div id="htmlContent"></div>
      </div>
    </div>
  </div>
</div>

<!-- Enquiry and feedback form modal -->
<div class="modal fade" id="feedbackFormModal" tabindex="-1" role="dialog" aria-labelledby="feedbackTitle"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="feedbackTitle">Feedbak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="profile-form form-horizontal needs-validation" novalidate method="post"
          action='./database/submit_feedback_form.php'>

          <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['user_id']?>" required />
          <div class="form-group">
            <label for="name" class="cols-sm-2 control-label">Feedback</label>
            <div class="cols-sm-10">
              <textarea type="text" class="form-control" name="feedback" id="feedback" required></textarea>

            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-primary">Commit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>



<style>
  #search-results {
    display: block;
  }

  /* search bar container */
  .search-container {
    display: table;
    position: relative;
    width: 51px;
  }
</style>

<script>
  // FOR FORM VALIDATION
  (function () {
    'use strict';
    window.addEventListener('load', function () {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      //validate all forms
      // var forms = document.getElementsByTagName('form');
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


  console.log('written by me');

  var isUser;
  var id;

  $profileForm = $('.profile-form');

  function showProfile() {
    $profileForm.find('input').attr('readonly', true);
    $profileForm.find('.radio-group').hide();
    $profileForm.find('.confirm-password').hide();
    $profileForm.find('.submit-btn').hide();
  }

  function editProfile() {
    $profileForm.find('input').attr('readonly', false);
    $profileForm.find('.radio-group').show();
    $profileForm.find('.confirm-password').show();
    $profileForm.find('.show-gender-value').hide();
    $profileForm.find('.submit-btn').show();
    $profileForm.find('.edit-button').hide();

  }


  $(document).ready(function () {

    function load_data(query) {
      $.ajax({
        url: './database/search_result.php',
        method: 'POST',
        data: {
          query: query
        }
      }).done(function (data) {
        console.log(data);
        $('#search-results').html(data);
        // $('#search-results').css('display', 'block');
      }).fail(function (data) {
        console.log(data);
        $('#search-results').html(data);
        $('#search-results').css('display', 'none');
      })
    }

    $('#search-bar').keyup(function () {
      var search = $(this).val();
      if (search != '') {
        load_data(search);
      } else {
        // load_data();
        // $('#search-results').css('display', 'none');
      }
    });

    //for user profile view and edit
    showProfile();

    $profileForm.find('.edit-button').click(function () {
      editProfile();
    })

  });
  console.log("is User: ", isUser);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
  integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
</script>