<!DOCTYPE html>
<html>

<?php
  require_once '../database/dbconnect.php';

  require_once '../inc/utils.php';
  
  require_once dirname(__FILE__) . './admin_header.php';
  
  utils::toastMessage();

  require_once dirname(__FILE__) . './show_top_details.php';

?>

    <?php
      require_once dirname(__FILE__) . './admin_footer.php';
    ?>