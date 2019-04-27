<?php
require_once dirname(__FILE__) . './database/dboperation.php';
require_once dirname(__FILE__) . './database/dbconnect.php';
require  dirname(__FILE__) . './header.php';

require_once dirname(__FILE__) . './inc/utils.php';

	$db = new dboperation();

	$blogTable = "user_post";
	$result = $db->getAll($blogTable);

	$posts = json_decode($result, true);
	$totalPost = sizeof($posts);

	// utils::toastClientSide();

	if ($totalPost == 0) {
		utils::alertMessage("No Any Posts...", "warning");
	}
	// utils::checkUserLogin();
	// $_SESSION['message'] = 'hello';
	utils::toastMessage();
	// utils::message();

	
?>

<div class="container mt-4">

	<div class="row">
		<div class="col-md-10">

			<form class="form " action="./database/add_blog_post.php" method="POST">
		
				<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>"/>
		
				<div class="form-group">
					<textarea rows="5" class="form-control" name="post" placeholder="write post here..." required></textarea>
				</div>
				
		
				<div class="form-group">
		
					<button type="submit"  name="submit" class="btn btn-primary btn-lg ">Post</button>
				</div>
		
			</form>
		</div>
	</div>


	<?php

			foreach($posts as $post) {
				echo '<div class="row blog-post col">';
				echo "<a href='#'>";

				$user = $db->getSingleData('user', $post['user_id']);
				$user = json_decode($user, true);
				// echo '<h5>'. $user['firstName'] . ' ' . $user['lastName'] . '</h5>';
				echo '<h5>'. $user['username']. '</h5>';

				echo "<p>" .$post['post'] . "</p>";

				echo "<span id='date'><small>" . $post['datetime'] . "</small></span>";
				echo "</a>";

				echo '</div>';


			}


	?>
	

</div>

<style>
	.blog-post {
        display: block;
        border: 1px solid #ccc;;
        border-radius: 8px;
        margin: 8px;
        padding: 8px;
		width: 56rem;
		align-content: center;
		text-decoration: none;
	}

	.blog-post a {
		text-decoration: none;
		color: gray;
	}

	.blog-post p {
		text-decoration: none;
	}
	.blog-post #date {
		text-align: right;
		align-content: right;
	}
</style>


<script>
	//for form validation

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
</script>