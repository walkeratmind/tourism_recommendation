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
		height: 35rem;

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



	<?php
include './footer.php';
?>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
		integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
	</script>

	<script>
		// $('.carousel').carousel({
		// 	interval: 4000
		// });

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