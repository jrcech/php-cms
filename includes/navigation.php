<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <div class="container">

        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>

            <a class="navbar-brand" href="index.php?page=1">CMS</a>

        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav">

                <?php

	            	$query = "SELECT * FROM categories";
					$category_menu = mysqli_query($connection, $query);
					confirmQuery($category_menu);

					while($row = mysqli_fetch_assoc($category_menu)) {

		            	$cat_title = $row['cat_title'];
		            	$cat_id = $row['cat_id'];

		            	$category_class = '';
		            	$registration_class = '';
		            	$contact_class = '';

		            	$page_name = basename($_SERVER['PHP_SELF']);
		            	$registration = 'registration.php';
		            	$contact = 'contact.php';

		            	if(isset($_GET['category']) && $_GET['category'] == $cat_id) {

			            	$category_class = 'active';

		            	} else if ($page_name == $registration) {

			            	$registration_class = 'active';

		            	} else if ($page_name == $contact) {

			            	$contact_class = 'active';

		            	}

		            	echo "<li class='$category_class'><a href='category.php?category=$cat_id&page=1'>$cat_title</a></li>";

	            	}

	            ?>

              <li class="<?php echo $contact_class ?>"><a href="contact.php">Contact</a></li>

                <?php

	                if(!isset($_SESSION['role'])) {

			            echo "<li class='$registration_class'><a href='registration.php'>Registration</a></li>";

	                }

	                if(isset($_SESSION['role'])) {

			        	if($_SESSION['role'] == 'admin') {

			            	echo "<li><a href='admin'>Admin</a></li>";

			            }

	                }

	                if(isset($_SESSION['role'])) {

		            	if(isset($_GET['p_id'])) {

			            	$the_post_id = escape($_GET['p_id']);

			                echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";

		            	}

	                }

                ?>

            </ul>

        </div>

    </div>

</nav>
