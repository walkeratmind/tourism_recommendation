<?php

  require_once dirname(__FILE__) . './../database/dboperation.php';
  require_once dirname(__FILE__) . './../inc/utils.php';


  $db = new dboperation();

  $adminTable = "admin";

  $result = $db->getSingleData($adminTable, $_SESSION['admin_id']);
  $admin = json_decode($result, true);

  // get all feedbacks
  $feedbackTable = "feedback";
  $result = $db->getAll($feedbackTable);
  $feedbacks = json_decode($result, true);

  $totalFeedbacks = sizeof($feedbacks);

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
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
                        echo 'From: '. $user['email'];
                        
                      echo '</h4>';

                      echo '<p>'. utils::getDefinateString($feedback['feedback'], 50).'</p>';

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

                  <h4><?php echo $admin['firstName'] . ' '. $admin['lastName']; ?></h4>
                  <h5><?php echo $admin['email']; ?></h5>
                  <h5><?php echo $admin['gender']; ?></h5>

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="./admin_logout.php?logout=true" onclick="return confirm('Logout?');" name="logout"
                      class="btn btn-default btn-flat">Log out</a>
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
          <li class="">
            <a href="view_user.php"><i class="fa fa-plane"></i> <span>View Users</span></a>
          </li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>