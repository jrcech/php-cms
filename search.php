<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
<div class="container">
  <div class="row">
    <div class="col-md-8">
	    <h1 class="page-header">Search Results</h1>
			<?php
				if(isset($_POST['submit_search'])) {
					$search = escape($_POST['search']);
					$query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
					$search_query = mysqli_query($connection, $query);
					confirmQuery($search_query);

					$count = mysqli_num_rows($search_query);

					if($count == 0) {
						echo "<h2>Nothing found</h2>";
					} else {
						while($row = mysqli_fetch_assoc($search_query)) {
						  $post_id = $row ['post_id'];
							$post_title = $row ['post_title'];
							$post_user = $row ['post_user'];
							$post_date = $row ['post_date'];
							$post_image = $row ['post_image'];
							$post_content = substr($row ['post_content'], 0, 200);
			?>
							<h2>
							  <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
							</h2>
							<p class="lead">
                by <a href="user_post.php?user=<?php echo $post_user ?>&p_id=<?php echo $post_id ?>"><?php echo $post_user ?></a>
              </p>
							<p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
							<hr>
							<a href="post.php?p_id=<?php echo $post_id; ?>">
								<img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
							</a>
							<hr>
			<?php
						}
					}
				}
			?>
    </div>
  <?php include "includes/sidebar.php"; ?>
  </div>
<hr>
<?php include "includes/footer.php"; ?>
