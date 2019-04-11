<?php
require  dirname(__FILE__) . './header.php';

require_once dirname(__FILE__) . './database/dbconnect.php';

$database = new dbconnect();

?>
<style>
	.image-fluid {
		display: block;
		max-width: 100%;
		width: 24rem;
		height: 18rem;
	}

	.image-carousel {
		display: block;
		max-width: 100%;
		height: 380px;

	}
</style>

<?php

    $mysqli = $database -> connect();

    $query = "SELECT name, image FROM `destination` ";

    $stmt = $mysqli -> prepare( $query );

    // echo "<script>console.log('hello')</script>";

    if ($stmt -> execute()) {
        
        $stmt -> bind_result($name, $image);
        
		$img_path = "./imageUploads/";
		
		$img_arr = array();
		
		$i = 0;
        while ($stmt -> fetch()) {

			$img= $img_path . $image;
			array_push($img_arr, $img);
			if ($i++ == 10) break;
        }
    $stmt -> close();
    $mysqli -> close();

    }
?>

<div class="container">
	<h5>Welcome to Tourism Recommendation</h5>

	<div class="owl-carousel owl-theme">
		<?php for ($i = 0; $i < count($img_arr); $i++) {
			echo '<div class="item"><a href=""><img class="image-carousel" src="' . $img_arr[$i] . '" alt="image"
				 ></a></div>
			';
		}
			?>

		<?php  ?>
		<!-- <div class="item"><a href=""><img class="image-fluid" src="img/lake.jpeg" alt="image"></a></div>
		<div class="item"><a href=""><img class="image-fluid rounded float-left" src="img/lumbini.jpg" alt="image"></a>
		</div>
		<div class="item"><a href=""><img class="image-fluid" src="img/janaki.jpg" alt="image"></a></div>
		<div class="item"><a href=""><img class="image-fluid " src="img/mountain.jpg" alt="image"></a></div> -->

	</div>

	<!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-75" src="img/swoyambhu.jpg" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="lake.jpeg"
					alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-75" src="lumbini.jpg" alt="Third slide">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div> -->

</div>


<?php
include './footer.php';
?>

<script>
	// $('.carousel').carousel({
	// 	interval: 2000
	// });
	$(document).ready(function () {
		$(".owl-carousel").owlCarousel({
			items: 3,
			loop: true,
			margin: 10,
			center: true,
			nav: true,
			// autoheight: true,
			autoplay: true,
			autoplayTimeout: 2000,
			autoplayHoverPause: true,
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 3
				},
				1000: {
					items: 4
				}
			}
		});
	});
</script>

<!-- TODO : Admin Login and user login feature -->