<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

				<?php
					
					if(isset($_GET['category'])) {
												
						$post_category_id = escape($_GET['category']);
						
						$query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}'";
						$select_categories = mysqli_query($connection, $query);
						confirmQuery($select_categories);
						
						$row = mysqli_fetch_assoc($select_categories);
						$cat_title = $row['cat_title'];
						
						?>
						
						<h1 class="page-header">
								
							All Posts In <?php echo $cat_title; ?>
							
		                </h1>
		                
		                <?php
			                
			            
			            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
							
							$post_query_count = "SELECT * FROM posts WHERE post_category_id = '{$post_category_id}'";
									
						} else {
									
							$post_query_count = "SELECT * FROM posts WHERE post_category_id = '{$post_category_id}' AND post_status = 'published'";
									
						}
						
						$find_count = mysqli_query($connection, $post_query_count);
						confirmQuery($find_count);
						
						$per_page = 5;
						
						$count = mysqli_num_rows($find_count);
						
						if($count < 1) {
							
							echo "<h2 class='text-center'>No Posts</h2>";
							
						}
							
						$count = ceil($count / $per_page);
						
						if(isset($_GET['page'])) {
							
							$page = escape($_GET['page']);
							
						} else {
							
							$page = "";
							
						}
						
						if($page == "" || $page == 1) {
							
							$limit = 0;
							
						} else {
							
							$limit = ($page * $per_page) - $per_page;
							
						}
				
			                
			            if(isset($_SESSION['role']) &&  $_SESSION['role'] == 'admin') {
							
							$query = "SELECT * FROM posts WHERE post_category_id = '{$post_category_id}' LIMIT {$limit}, {$per_page}";
							
						} else {
							
							$query = "SELECT * FROM posts WHERE post_category_id = '{$post_category_id}' AND post_status = 'published' LIMIT {$limit}, {$per_page}";
							
						}
				
						$result = mysqli_query($connection, $query);
						confirmQuery($result);
	
						while($row = mysqli_fetch_assoc($result)) {
						   	
							$post_id = $row ['post_id'];
							$post_title = $row ['post_title'];	
							$post_user = $row ['post_user'];	
							$post_date = $row ['post_date'];
							$post_image = $row ['post_image'];	
							$post_content = substr($row ['post_content'], 0, 200);	
							
							?>

		                	<!-- First Blog Post -->
		                	<h2>
		                	    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
		                	</h2>
		                	
		                	<p class="lead">
		                	    by <a href="user_post.php?user=<?php echo $post_user ?>&p_id=<?php echo $post_id ?>&page=1"><?php echo $post_user ?></a>
		                	</p>
		                	
		                	<p>
			                	<span class="glyphicon glyphicon-time"></span><?php echo $post_date ?>
		                	</p>
		                	
		                	<hr>
		                	
		                	<a href="post.php?p_id=<?php echo $post_id; ?>">
		                	
		                		<img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
		                	
		                	</a>
		                	
		                	<hr>
		                	
		                	<p><?php echo $post_content . "..."; ?></p>
		                	
		                	<a class="btn btn-primary" href="#">
			                	Read More <span class="glyphicon glyphicon-chevron-right"></span>
		                	</a>
							
		                	<hr>
	                	
							<?php 
						
						}
						
					} else {
						
						header("Location: index.php");
						
					}
					
				?>
				
            </div>
            
            <?php include "includes/sidebar.php"; ?>

        </div>
        
        <nav aria-label="Page navigation">
    
		    <ul class="pagination pagination-lg">		   
		        
		    	<?php
		        	
		        	for($i = 1; $i <= $count; $i++) {
			        	
			        	if($i == $page) {
				        	
				        	echo "<li class='active'><a href='category.php?category=$post_category_id&page={$i}'>{$i}</a></li>";
				        	
			        	} else {
			        	
			        		echo "<li><a href='category.php?category=$post_category_id&page={$i}'>{$i}</a></li>";
			        	
			        	}
			        	
		        	}
		        	
		        ?>
		    	
		    </ul>
	    
	    </nav>

        <hr>
        
<?php include "includes/footer.php"; ?>