<?php

require_once dirname(__FILE__) . './../database/dboperation.php';
require_once dirname(__FILE__) . './../inc/utils.php';


$db = new dboperation();

// GET All admins
$adminRole = "admin";
$result = $db->getAdminByRole($adminRole);
$adminLists = json_decode($result, true);
$totalAdmins = empty($adminLists) ? 0 : sizeof($adminLists);

// get all admin requests
$adminRole = "pending";
$result = $db->getAdminByRole($adminRole);
$adminRequests = json_decode($result, true);
$totalAdminRequest = empty($adminRequests) ? 0 : sizeof($adminRequests);


// function searchForId($array, $id)
// {
//   foreach ($array as $key => $val) {
//     if ($val['id'] === $id) {
//       return $key;
//     }
//   }
//   return null;
// }
// //  Get current logged in admin from Admin list
// $admin = searchForId($adminLists, $_SESSION['admin_id']);

//  Get current logged in admin from Database
$adminTable = "admin";
$result = $db->getSingleData($adminTable, $_SESSION['admin_id']);
$admin = json_decode($result, true);

// get all feedbacks
$feedbackTable = "feedback";
$result = $db->getAll($feedbackTable);
$feedbacks = json_decode($result, true);
//sets to 0 if no any feedbacks
$totalFeedbacks = empty($feedbacks) ? 0 : sizeof($feedbacks);
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Destination</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin </b> PANEL</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success"><?php echo $totalFeedbacks ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have <?php echo $totalFeedbacks ?> Feedbacks</li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu feedbackBox">

                    <?php

                    foreach ($feedbacks as $feedback) {

                      //get username of the user who have sent feedback
                      $result = $db->getSingleData('user', $feedback['user_id']);
                      $user = json_decode($result, true);
                      // Start Message
                      echo '<li class="">';
                      echo '<a href="#" style="text-decoration: none">';
                      // echo '<div class="pull-left">'. 
                      //   '<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">';
                      // echo '</div>';

                      echo '<h4 class="">';
                      echo 'From: ' . $user['email'];

                      echo '</h4>';

                      echo '<p>' . utils::getDefinateString($feedback['feedback'], 50) . '</p>';

                      echo '<small class="pull-right"><i class="fa fa-clock-o"></i>' . $feedback['datetime'] . '</small>';
                      echo '</a>';
                      echo '</li>';
                      // END Feedback Message


                    }

                    ?>

                  </ul>
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
              </ul>
            </li>

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"><?php echo $admin['email']; ?></span>
              </a>
              <ul class="dropdown-menu">

                <h4 class="text-center"><?php echo $admin['firstName'] . ' ' . $admin['lastName']; ?></h4>
                <h5 class="text-center"><?php echo $admin['email']; ?></h5>
                <h5 class="text-center"><?php echo $admin['gender']; ?></h5>

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-primary btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="./admin_logout.php?logout=true" onclick="return confirm('Logout?');" name="logout" class="btn btn-danger btn-flat">Log out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="dist/img/avatar04.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo $admin['firstName'] . ' ' . $admin['lastName'] ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>

          <!-- for add events and add destination -->
          <li class=" ">
            <a href="add_destination.php"><i class="fa fa-plane"></i> <span>Destination</span></a>
          </li>

          <li class="">
            <a href="add_event.php"><i class="fa fa-calendar"></i> <span>Events</span></a>
          </li>

          <li class="">
            <a href="view_feedback.php">
              <i class="fa fa-files-o"></i>
              <span>View Feedbacks</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right"><?php echo $totalFeedbacks ?></span>
              </span>
            </a>
          </li>

          <?php if ($admin['role'] == 'superAdmin') : ?>
            <li class="active treeview menu-open">
              <a href="#">
                <i class="fa fa-user-circle-o"></i> <span>Admins</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="">
                  <a href="#" data-toggle="modal" data-target="#adminListModal">
                    <i class="fa fa-user"></i>
                    <span>Admins</span>
                    <span class="pull-right-container">
                      <span class="label label-primary pull-right"><?php echo $totalAdmins ?></span>
                    </span>
                  </a>
                </li>

                <li class="">
                  <a href="#" data-target="#adminRequestModal" data-toggle="modal">
                    <i class="fa fa-user-plus"></i>
                    <span>Admin Requests</span>
                    <span class="pull-right-container">
                      <span class="label label-primary pull-right"><?php echo $totalAdminRequest ?></span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif; ?>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- show Admin Requests Modal -->
    <div class="modal fade" id="adminRequestModal" tabindex="-1" role="dialog" aria-labelledby="adminRequestTitle" aria-hidden="true">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title text-center" id="adminRequestTitle">Admin Requests</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php
            if ($totalAdminRequest == 0) :
              echo '<div class="alert alert-danger text-center"><h4>No Any Requests</h4></div>';
            else :
              foreach ($adminRequests as $adminRequest) {

                echo '<div class= "row">';


                echo '<div class= "col-sm-10">';
                // echo '<h6>id: ' . $adminRequest['id'] . '</h6>';
                echo '<h5> Name: ' . $adminRequest['firstName'] . ' ' . $adminRequest['lastName'] . '</h5>';
                echo '<h5>User Name: ' . $adminRequest['username'] . '</h5>';
                echo '<h5>Email: ' . $adminRequest['email'] . '</h5>';
                //  for col
                echo '</div>';

                echo '<div class= "col-sm-2">';
                echo '<a class="admin_option btn btn-success" href="./process_admin_request.php?type=approve&id=' . $adminRequest['id'] . '">
                 <span class="approve_btn" ><i class="fa fa-check"></i>Approve</span>
             </a>';
                echo '<a class="admin_option btn btn-danger" href="./process_admin_request.php?type=reject&id=' . $adminRequest['id'] .
                  '" onclick="return confirm(\'Remove Admin Request From: ' . $adminRequest['email'] . ' ?\');">' . '
                 <span class="reject_btn" ><i class="fa fa-times"></i>Reject</span>
             </a>';
                //  for col
                echo '</div>';

                //  for row
                echo '</div>';
              }

            endif;

              ?>
            </div>

            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>

      <!-- Show Admin Model -->
      <div class="modal fade" id="adminListModal" tabindex="-1" role="dialog" aria-labelledby="adminListTitle" aria-hidden="true">
        <div class="modal-dialog " role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title text-center" id="adminListTitle">Admins</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php
              if ($totalAdmins == 0) :
                echo '<div class="alert alert-danger text-center"><h4>No Any Admins</h4></div>';
              else :
                foreach ($adminLists as $admin) {

                  echo '<div class= "row">';


                  echo '<div class= "col-sm-10">';
                  // echo '<h6>id: ' . $adminRequest['id'] . '</h6>';
                  echo '<h5> Name: ' . $admin['firstName'] . ' ' . $admin['lastName'] . '</h5>';
                  echo '<h5>User Name: ' . $admin['username'] . '</h5>';
                  echo '<h5>Email: ' . $admin['email'] . '</h5>';
                  //  for col
                  echo '</div>';

                  echo '<div class= "col-sm-2">';
                  echo '<a class="admin_option btn btn-danger" href="./process_admin_request.php?type=delete&id=' . $admin['id'] .
                    '" onclick="return confirm(\'Remove Admin : ' . $admin['email'] . ' ?\');">' . '
                 <span class="reject_btn" ><i class="fa fa-trash-o"></i> Delete</span>
             </a>';
                  //  for col
                  echo '</div>';

                  //  for row
                  echo '</div>';
                }

              endif;

              ?>
            </div>

            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>

      <style>
        .admin_option {
          position: relative;
          display: block;
          padding: 2px;
          margin: 2px;
          /* margin-top: 4px; */
          text-align: center;
          text-decoration: none;
        }

        .option:hover {}
      </style>