<?php
require_once dirname(__FILE__) . './database/dboperation.php';
require_once dirname(__FILE__) . './database/dbconnect.php';
require  dirname(__FILE__) . './header.php';

require_once dirname(__FILE__) . './inc/utils.php';

$db = new dboperation();

$blogTable = "user_post";
$result = $db->getAll($blogTable);

$posts = json_decode($result, true);

// Set total post to 0 if posts is empty
$totalPost = empty($posts) ? 0 : sizeof($posts);

?>

<div class="container mt-4">

	<?php
	if ($totalPost > 0) :
		foreach ($posts as $post) {
			echo '<div class="row blog-post ">';

			echo '<a href="view_post.php?id=' . $post['id'] . '">';

			$user = $db->getSingleData('user', $post['user_id']);
			$user = json_decode($user, true);
			// echo '<h5>'. $user['firstName'] . ' ' . $user['lastName'] . '</h5>';
			echo '<h5>' . $user['username'] . '</h5>';

			echo "<div class='col-sm-2' >";
			if (empty($post['image'])) {
				$showImage = "<img class='image-fluid' src='./assets/icons/no_image.png' alt='No Image'>";
			} else {
				$img_path = "./imageUploads/blog_image/";
				$showImage = "<img class='image-fluid' src='" . $img_path . $post['image'] . "' alt=''>";
			}

			echo $showImage;

			echo "</div>";

			echo "<div class='col-sm-10'>";

			echo "<h5 id='title'>" . $post['title'] . "</h5>";
			echo "<p class=''>" . utils::getDefinateString($post['post'], 100) . "</p>";

			echo "<span id='date'><small>" . $post['datetime'] . "</small></span>";

			echo '</div>';
			echo "</a>";

			echo '</div>';
		} else :
		?>
		<div class="alert alert-info">
			<h5>No Any Posts...</h5>
		</div>

	<?php endif ?>

</div>

<div id="footer-wrapper">
	<?php require_once dirname(__FILE__) . './footer.php'; ?>
</div>

<style>
	#footer-wrapper {
		position: absolute;
		bottom: 0;
		width: 100%;
	}

	.image-fluid {
		display: block;
		max-width: 100%;
		width: 12rem;
		height: 8rem;
	}

	.blog-post {
		display: grid;
		border: 1px solid #ccc;
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
</style>


<script>

</script>