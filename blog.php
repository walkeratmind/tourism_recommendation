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

	<?php
	if ($totalPost > 0) :
		foreach ($posts as $post) {
			echo '<div class="row blog-post col">';
			echo "<a href='#'>";

			$user = $db->getSingleData('user', $post['user_id']);
			$user = json_decode($user, true);
			// echo '<h5>'. $user['firstName'] . ' ' . $user['lastName'] . '</h5>';
			echo '<h5>' . $user['username'] . '</h5>';

			echo "<p>" . $post['post'] . "</p>";

			echo "<span id='date'><small>" . $post['datetime'] . "</small></span>";
			echo "</a>";

			echo '</div>';
		} else :
		?>
		<div class="alert alert-info">
			<h5>No Any Reviews...</h5>
		</div>

	<?php endif ?>

</div>

<style>
	.blog-post {
		display: block;
		border: 1px solid #ccc;
		;
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

</script>