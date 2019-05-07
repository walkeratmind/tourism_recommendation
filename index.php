<?php
require_once dirname(__FILE__) . './database/dbconnect.php';
require_once dirname(__FILE__) . './database/dboperation.php';
require  dirname(__FILE__) . './header.php';

require_once dirname(__FILE__) . './inc/utils.php';

	$database = new dbconnect();

	// utils::toastClientSide();

	// $_SESSION['message'] = 'hello';
	utils::toastMessage();
	// utils::message();
?>

<!-- <script>
	// for auto close bootstrap alert
	$(document).ready(function() {
		$("#alert-message").fadeTo(2000, 500).slideUp(500, function(){
               $("#alert-message").slideUp(500);
                });
	});
</script> -->
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
		height: 35rem;

	}
</style>

<?php

$db = new dboperation();
$destinationTable = "destination";

$result = $db->getAll($destinationTable);
$destinations = json_decode($result, true);

$mysqli = $database->connect();

$query = "SELECT name, image FROM `destination` ";

$stmt = $mysqli->prepare($query);

// echo "<script>console.log('hello')</script>";

if ($stmt->execute()) {

	$stmt->bind_result($name, $image);

	$img_path = "./imageUploads/";

	$img_arr = array();

	$i = 0;
	while ($stmt->fetch()) {

		$img = $img_path . $image;
		array_push($img_arr, $img);
		if ($i++ == 10) break;
	}
	$stmt->close();
	$mysqli->close();
}
?>

<div class="carousel-container">
	<div id="carouselIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselIndicators" data-slide-to="1"></li>
			<li data-target="#carouselIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100  image-carousel" src="img/swoyambhu.jpg" alt="First slide">

				<div class="caption-box">

					<div class="carousel-caption d-none d-md-block">
						<h5>Swoyambhu</h5>
						<p>Home is where the heart is</p>
					</div>
				</div>

				<style>
					.caption-box,
					.carousel-caption {
						background: #000;
						opacity: 0.8;
						left: 0;
						width: 100%;
						/* margin-bottom: 0; */

					}

					/* .carousel-indicators {
						margin-bottom: 0;
					} */
				</style>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100 image-carousel" src="img/lake.jpeg" alt="Second slide">

				<div class="caption-box">

					<div class="carousel-caption d-none d-md-block">
						<h5>Pokhara</h5>
						<p>Home is where the heart is</p>
					</div>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100 image-carousel" src="img/lumbini.jpg" alt="Third slide">

				<div class="caption-box">

					<div class="carousel-caption d-none d-md-block">
						<h5>Lumbini</h5>
						<p>Home is where the heart is</p>
					</div>
				</div>
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

</div>

<div class="container">
	<!-- <h5>Welcome to Tourism Recommendation</h5> -->




	<?php
	// require_once './destination.php';
	require_once './index_suggestion.php';

	?>

</div>

<?php 	require_once dirname(__FILE__) . './footer.php'; ?>

	
	<script>
		$('.carousel').carousel({
			interval: 3000
		});

		// if ($('.carousel').is(":hover")) {

		// }

		// $(document).ready(function () {
		// 	$(".owl-carousel").owlCarousel({
		// 		items: 3,
		// 		loop: true,
		// 		margin: 10,
		// 		center: true,
		// 		nav: true,
		// 		// autoheight: true,
		// 		autoplay: true,
		// 		autoplayTimeout: 2000,
		// 		autoplayHoverPause: true,
		// 		responsive: {
		// 			0: {
		// 				items: 1
		// 			},
		// 			600: {
		// 				items: 3
		// 			},
		// 			1000: {
		// 				items: 4
		// 			}
		// 		}
		// 	});
		// });
	</script>

	<!-- TODO : Admin Login and user login feature -->