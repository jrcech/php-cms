<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
<div class="container">
  <div class="row">
    <div class="col-md-8">
		  <h1 class="page-header">CMS</h1>
	    <?php
				if(isset($_GET['p_id'])) {
					$the_post_id = escape($_GET['p_id']);

					$view_query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = '{$the_post_id}'";
					$send_query = mysqli_query($connection, $view_query);
					confirmQuery($send_query);

					if(isset($_SESSION['role']) &&  $_SESSION['role'] == 'admin') {
						$query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}'";
					} else {
						$query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}' AND post_status = 'published'";
					}

					$view_post_query = mysqli_query($connection, $query);
					confirmQuery($view_post_query);

					if(mysqli_num_rows($view_post_query) < 1) {
						echo "<h2 class='text-center'>The post is unavailable</h2>";
					} else {
  				  while($row = mysqli_fetch_assoc($view_post_query)) {
  					  $post_id = $row ['post_id'];
  						$post_title = $row ['post_title'];
  						$post_user = $row ['post_user'];
  						$post_date = $row ['post_date'];
  						$post_image = $row ['post_image'];
  						$post_content = $row ['post_content'];
  		  ?>
  	          <h2><?php echo $post_title ?></h2>
  	          <p class="lead">by <a href="user_post.php?user=<?php echo $post_user ?>&p_id=<?php echo $post_id ?>"><?php echo $post_user ?></a></p>
  	          <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
              <hr>
              <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
              <hr>
              <p><?php echo $post_content; ?></p>
              <hr>
  				<?php
  					}

  					if(isset($_POST['create_comment'])) {
  						$the_post_id = escape($_GET['p_id']);
  						$comment_author = escape($_POST['comment_author']);
  						$comment_email = escape($_POST['comment_email']);
  						$comment_content = escape($_POST['comment_content']);

  						if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
  							$query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
  							$query .= "VALUES('{$the_post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
  							$create_comment_query = mysqli_query($connection, $query);
  							confirmQuery($create_comment_query);

  							echo "<p>Comment sent for approval</p>";
  						} else {
  							echo "<p>Fields cannot be empty</p>";
  						}
  					}
  				?>
    	      <div class="well">
    	        <h4>Leave a Comment:</h4>
    	        <form method="post">
    		        <div class="form-group">
    	            <label for="comment_author">Author:</label>
    	            <input class="form-control" type="text" name="comment_author" id="comment_author">
    	          </div>

    	          <div class="form-group">
                  <label for="comment_email">Email:</label>
                  <input class="form-control" type="email" name="comment_email" id="comment_email">
    	          </div>

                <div class="form-group">
                  <label for="comment_content">Comment:</label>
                  <textarea class="form-control" rows="3" name="comment_content" id="comment_content"></textarea>
                </div>
                <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
    	        </form>
    	      </div>
    	      <hr>
    		  <?php
          	$query = "SELECT * FROM comments WHERE comment_post_id = '{$the_post_id}' ";
          	$query .= "AND comment_status = 'approved' ";
          	$query .= "ORDER BY comment_id DESC";
  					$view_all_post_comments = mysqli_query($connection, $query);
  					confirmQuery($view_all_post_comments);

  					while($row = mysqli_fetch_assoc($view_all_post_comments)) {
  						$comment_author = $row['comment_author'];
  						$comment_content = $row['comment_content'];
  						$comment_date = $row['comment_date'];
    			?>
  						<div class="media">
  							<a class="pull-left" href="#">
  							  <img class="media-object" src="http://placehold.it/64x64" alt="">
  							</a>
  							<div class="media-body">
  						    <h4 class="media-heading"><?php echo $comment_author; ?>
  						      <small><?php echo $comment_date; ?></small>
  						    </h4>
  							  <?php echo $comment_content; ?>
  							</div>
  						</div>
  				<?php
  					}
				  }
        } else {
					header("Location: index.php");
				}
			?>
		</div>
		<?php include "includes/sidebar.php"; ?>
	</div>
	<hr>
<?php include "includes/footer.php"; ?>
