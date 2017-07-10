<?php checkBoxesPosts(); ?>
<h1 class="page-header">Posts</h1>

<form method="post">
	<div class="row space">
		<div class="col-xs-4 options" id="bulkOptionsContainer">
			<select name="bulk_options" class="form-control">
				<option value="">Select Options</option>
				<option value="published">Publish</option>
				<option value="draft">Draft</option>
				<option value="duplicate">Duplicate</option>
				<option value="delete">Delete</option>
			</select>
		</div>

		<div class="col-xs-4">
			<input type="submit" class="btn btn-success" value="Apply" name="submit">
			<a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th><input id="selectAllBoxes" type="checkbox"></th>
					<th>ID</th>
					<th>Users</th>
					<th>Title</th>
					<th>Category</th>
					<th>Status</th>
					<th>Image</th>
					<th>Tags</th>
					<th>Comments</th>
					<th>Post Views</th>
					<th>Date</th>
					<th>View</th>
					<th>Edit</th>
					<th>Delete</th>
					<th>Reset Views</th>
				</tr>
			</thead>

			<tbody>
		    <?php
  				$query = "SELECT * FROM posts LEFT JOIN categories ";
  				$query .= "ON posts.post_category_id = categories.cat_id ";
  				$query .= "ORDER BY post_id DESC";

  				$select_posts = mysqli_query($connection, $query);
  				confirmQuery($select_posts);

  				while($row = mysqli_fetch_assoc($select_posts)) {
  					$post_id = $row ['post_id'];
  					$post_user = $row ['post_user'];
  					$post_title = $row ['post_title'];
  					$post_category_id = $row ['post_category_id'];
  					$post_status = $row ['post_status'];
  					$post_image = $row ['post_image'];
  					$post_tags = $row ['post_tags'];
  					$post_comment_count = $row ['post_comment_count'];
  					$post_date = $row ['post_date'];
  					$post_content = $row ['post_content'];
  					$post_view_count = $row ['post_view_count'];
  					$cat_title = $row ['cat_title'];

  					echo "<tr>";
  						echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$post_id'></td>";
  						echo "<td>{$post_id}</td>";

  						if (!empty($post_user)) {
  							echo "<td>$post_user</td>";
  						}

  						echo "<td>{$post_title}</td>";
  						echo "<td>{$cat_title}</td>";
  						echo "<td>{$post_status}</td>";
  						echo "<td><img width='100' src='../images/{$post_image}' alt='Post image' /></td>";
  						echo "<td>{$post_tags}</td>";

  						$query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
  						$send_comment_query = mysqli_query($connection, $query);
  						confirmQuery($send_comment_query);

  						$row = mysqli_fetch_assoc($send_comment_query);
  						$count_comments = mysqli_num_rows($send_comment_query);

  						echo "<td><a href='post_comments.php?id=$post_id'>{$count_comments}</a></td>";
  						echo "<td>{$post_view_count}</td>";
  						echo "<td>{$post_date}</td>";
  						echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
  						echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
  						echo "<td><a href='posts.php?delete={$post_id}' class='delete_link'>Delete</a></td>";
  						echo "<td><a href='posts.php?reset={$post_id}'>Reset Views</a></td>";
  					echo "</tr>";
  				}

  				if(isset($_GET['delete'])) {
  					$delete_post_id = $_GET['delete'];
  					$query = "DELETE FROM posts WHERE post_id = '$delete_post_id'";

  					$delete_query = mysqli_query($connection, $query);
  					confirmQuery($delete_query);

  					header("Location: posts.php");
  				}

  				if(isset($_GET['reset'])) {
  					$reset_post_views = escape($_GET['reset']);

  					$query = "UPDATE posts SET post_view_count = 0 WHERE post_id = '$reset_post_views'";
  					$reset_query = mysqli_query($connection, $query);
  					confirmQuery($reset_query);

  					header("Location: posts.php");
  				}
		    ?>
			</tbody>
		</table>
	</div>
</form>

<script>
	$(document).ready(function() {
		$('.delete_link').on('click', function() {
			var id = $(this).attr("rel");
			var delete_url = "posts.php?delete=" + id + " ";

			$(".modal_delete_link").attr("href", delete_url);
			$("#myModal").modal('show');
		});
	});
</script>
