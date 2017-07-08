<?php
	
	if(isset($_POST['create_post'])) {
		
		$post_title = escape($_POST['post_title']);
		$post_category_id = escape($_POST['post_category']);
		$post_user = escape($_POST['post_user']);
		$post_status = escape($_POST['post_status']);
		$post_image = escape($_FILES['post_image'] ['name']);
		$post_image_tmp = escape($_FILES['post_image'] ['tmp_name']);
		$post_tags = escape($_POST['post_tags']);
		$post_content = escape($_POST['post_content']);
		$post_date = date('dd-mm-yyyy');
		
		move_uploaded_file($post_image_tmp, "../images/$post_image");
		
		$query = "INSERT INTO posts(post_title, post_category_id, post_user, post_status, post_image, post_tags, post_content, post_date) ";
		$query .= "VALUES('{$post_title}', '{$post_category_id}', '{$post_user}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}', now())";

		$create_post_query = mysqli_query($connection, $query);
		confirmQuery($create_post_query);
		$the_post_id = mysqli_insert_id($connection);
		
		echo "<p class='bg-success'>Post Created<br><a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
		
	}
	
?>

<h1 class="page-header">Add Post</h1>

<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="post_title">Post Title</label>
		<input type="text" class="form-control" name="post_title">
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
						
						echo "<option value='{$cat_id}'>{$cat_title}</option>";
						
					}
					
				?>
							
			</select>
	
		</div>
		
		<div class="form-group col-md-4">
			<label for="post_user">Post User</label>
			<select name="post_user" class="form-control">
				
				<?php 
					
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
				
				<option value="draft">Select Options</option>
				<option value="published">Publish</option>
				<option value="draft">Draft</option>
				
			</select>
			
		</div>
	
	</div>
	
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="post_image">
	</div>
	
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags">
	</div>
	
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" cols="30" rows="10"></textarea>
	</div>
	
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_post" value="Create Post">
	</div>
	
</form>