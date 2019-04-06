<?php
  require_once dirname(__FILE__) . './header.php';
  require_once dirname(__FILE__). './database/dbconnect.php';


  $database = new dbconnect();
  ?>

<div class="container" >

<?php

    $mysqli = $database -> connect();

    $query = "SELECT * FROM `destination` ";

    $stmt = $mysqli -> prepare( $query );

    // echo "<script>console.log('hello')</script>";

    if ($stmt -> execute()) {
        
        $stmt -> bind_result($id, $name, $location, $description, $image);
        
        $img_path = "./imageUploads/";

        echo '<div class="row">';
        while ($stmt -> fetch()) {

          echo '<div class=" col-sm-4 mb-2">';
          echo '<div class="card  shadow-sm " style="width: 24rem;">';
          echo '<img src=\'' , $img_path . $image, '\' style="width: 24rem; height: 18rem"  class="rounded card-img-top" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"  alt="'. $image .'">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">' . $name . '</h5>';
          echo '<p>'. $description . '</p>';

          echo '</div>';    //end of card body
          echo '<card-footer class=" mx-2" >';
          echo '<div class=" text-muted" style="float: right;">'. $location . '</div>';
          echo '</card-footer>';
          echo '</div>';  
          echo '</div>';  

        }
        echo '</div>';

        
        
    $stmt -> close();
    $mysqli -> close();

    }
?>
  
  </div>
</div>

<?php require_once dirname(__FILE__) . './footer.php'; ?>
