<?php
require_once dirname(__FILE__) . './database/dbconnect.php';
require_once dirname(__FILE__) . './header.php';

$database = new dbconnect();
?>

<div class="container">

  <div class="title mt-4">
    <h5>Destinations</h5>
  </div>

  <?php

  $mysqli = $database->connect();

  $query = "SELECT * FROM `destination` ";

  $stmt = $mysqli->prepare($query);

  // echo "<script>console.log('hello')</script>";

  if ($stmt->execute()) {

    $stmt->bind_result($id, $name, $location, $description, $image);

    $img_path = "./imageUploads/";

    echo '<div class="row">';

    while ($stmt->fetch()) {
      echo '<div class="item col-md-4 mb-2 ">';

      echo '<a href="get_destination.php?id=' . $id . '">';

      echo '<div class="card shadow-sm " id="" style="width: 24rem;">';
      echo '<div class="content-layout">';
      echo '<img src=\'', $img_path . $image, '\' style="width: 24rem; height: 18rem"  class="rounded card-img-top" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"  alt="' . $image . '">';
      echo '<span class="content-detail">' . $description . '</span>';
      echo '</div>';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">' . $name . '</h5>';
      // echo '<p>'. $description . '</p>';

      echo '</div>';    //end of card body
      echo '<card-footer class=" mx-2" >';
      echo '<div class=" text-muted" >' . $location . '</div>';
      echo '</card-footer>';
      echo '</div>';

      echo '</a>';
      echo '</div>';
    }
    echo '</div>';



    $stmt->close();
    $mysqli->close();
  }
  ?>

</div>
</div>

<?php require_once dirname(__FILE__) . './footer.php'; ?>


<style>
  .card {

    /* transition: all 0.3s; */
  }

  .item {
    overflow: hidden;
  }

  .item a {
    text-decoration: none;
    color: #000;
  }

  .item:hover {
    box-shadow: 12px 15px 20px 0px rgba(46, 61, 73, 0.4);
    border-radius: 4px;
    transition: all 0.3s ease;
    top: -2px;
  }

  .content-layout {
    position: relative;
  }

  .content-detail {
    position: absolute;
    overflow: hidden;
    background: #000;
    opacity: 0.8;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    bottom: 0;
    width: 100%;
    height: 18%;
    text-align: center;
    color: #fff;
    /* -webkit-transition: all 500ms ease-in-out;
    -moz-transition: all 500ms ease-in-out;
    -ms-transition: all 500ms ease-in-out;
    -o-transition: all 500ms ease-in-out;
    transition: all 500ms ease-in-out; */
    /* display: none; */
  }
</style>

<script>
  $(document).ready(function() {

    let $contentDetail = $('.content-detail');
    // $contentDetail.hide();

    $('.card').hover(function() {
      $contentDetail.show(500);
    }, function() {
      $contentDetail.hide();
    })

    // $('.item').mouseenter(function() {
    //   $contentDetail.show();
    // });

    // $('.item').mouseleave(function() {
    //   $contentDetail.hide();
    // });

  });

  //   $contentDetail.hide();
  //   if ($('.card').is(':hover')) {
  //     $contentDetail.show();
  //   } else {
  //     $contentDetail.hide();
  //   }
</script>