
<?php 
    require_once dirname(__FILE__) . './admin_nav.php';
    
  // If admin already logged in, send them to index else to login section

  utils::checkAdminLogin();

  utils::toastMessage();

?>