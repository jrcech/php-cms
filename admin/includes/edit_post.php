<?php
	
	if(isset($_GET['p_id'])) {
		
		$the_post_id = escape($_GET['p_id']);
		
		$query = "SELECT * FROM posts WHERE post_id = '$the_post_id'";
		$select_posts_by_id = mysqli_query($connection, $query);
		confirmQuery($select_posts_by_id);
	
		while($row = mysqli_fetch_assoc($select_posts_by_id)) {
		
			$post_id = $row ['post_id'];
			$post_user = $row ['post_user'];
			$post_title = $row ['post_title'];
			$post_category_id = $row ['post_category_id'];
			$post_status = $row ['post_status'];
			$post_image = $row ['post_image'];
			$post_tags = $row ['post_tags'];
			$post_content = $row ['post_content'];
			$post_comment_count = $row ['post_comment_count'];
			$post_date = $row ['post_date'];
			
		}
		
		if(isset($_POST['update_post'])) {
			
			$post_title = escape($_POST['post_title']);
			$post_category_id = escape($_POST['post_category']);
			$post_user = escape($_POST['post_user']);
			$post_status = escape($_POST['post_status']);
			$post_image = escape($_FILES['post_image'] ['name']);
			$post_image_tmp = escape($_FILES['post_image'] ['tmp_name']);
			$post_tags = escape($_POST['post_tags']);
			$post_content = escape($_POST['post_content']);
			
			move_uploaded_file($post_image_tmp, "../images/$post_image");
			
			if(empty($post_image)) {
				
				$query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}'";
				
				$select_image = mysqli_query($connection, $query);
				confirmQuery($select_image);
				
				while($row = mysqli_fetch_assoc($select_image)) {
					
					$post_image = $row ['post_image'];
					
				}
				
			}
			
			$query = "UPDATE posts SET ";
			$query .= "post_title = '{$post_title}', ";
			$query .= "post_category_id = '{$post_category_id}', ";
			$query .= "post_user = '{$post_user}', ";
			$query .= "post_status = '{$post_status}', ";
			$query .= "post_image = '{$post_image}', ";
			$query .= "post_tags = '{$post_tags}', ";
			$query .= "post_content = '{$post_content}', ";
			$query .= "post_date = now() ";
			$query .= "WHERE post_id = '{$the_post_id}'";
			
			$update_query = mysqli_query($connection, $query);
			confirmQuery($update_query);
			
			echo "<p class='bg-success'>Post Updated<br><a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
			
		}
		
	}

?>

<h1 class="page-header">Edit Post</h1>

<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="post_title">Post Title</label>
		<input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
	</div>
	
	<div class="row">
	
		<div class="form-group col-md-4">
			<label for="post_category">Post Category</label>
			<select name="post_category" class="form-control">
				
				<?php 
					
					$query = "SELECT * FROM categories";
			
					$select_categories = mysqli_query($connection, $query);
					confirmQuery($select_categories);
					while($row = mysqli_fetch_assoc($select_categories)) {
					
						$cat_id = $row ['cat_id'];
						$cat_title = $row ['cat_title'];
						
						if($cat_id == $post_category_id) {
							
							echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
							
						} else {
							
							echo "<option value='{$cat_id}'>{$cat_title}</option>";					
							
						}
					
					}
					
				?>
							
			</select>
	
		</div>
		
		<div class="form-group col-md-4">
			<label for="post_user">Post User</label>
			<select name="post_user" class="form-control">
				
				<?php 
					
					echo "<option value='{$post_user}'>{$post_user}</option>";
					
					$users_query = "SELECT * FROM users";
			
					$select_users = mysqli_query($connection, $users_query);
			
					confirmQuery($select_users);
				
					while($row = mysqli_fetch_assoc($select_users)) {
					
						$user_id = $row ['user_id'];
						$user_name = $row ['user_name'];
						
						echo "<option value='{$user_name}'>{$user_name}</option>";
						
					}
					
				?>
							
			</select>
		</div>
		
		<div class="form-group col-md-4">
			
			<label for="post_status">Post Status</label>
			
			<select name="post_status" class="form-control">
			
				<option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
				
				<?php
				
					if($post_status == 'published') {
						
						echo "<option value='draft'>Draft</option>";
						
					} else {
						
						echo "<option value='published'>Published</option>";
						
					}
					
				?>
			
			</select>
		
		</div>
	
	</div>
	
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<img src="../images/<?php echo $post_image; ?>" width="100">
		<input type="file" name="post_image">
	</div>
	
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
	</div>
	
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" cols="30" rows="10"><?php echo str_replace('\r\n', '</br>', $post_content); ?></textarea>
	</div>
	
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
	</div>
	
</form>