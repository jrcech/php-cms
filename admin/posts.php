<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
	                
                    <div class="col-lg-12">

						<?php
							
							if(isset($_GET['source'])) {
								
								$source = escape($_GET['source']);
								
							} else {
								
								$source = '';
								
							}
							
							switch ($source) {
								
								case 'add_post';
								include "includes/add_post.php";
								break;
								
								case 'edit_post';
								include "includes/edit_post.php";
								break;
								
								default:
								include "includes/view_all_posts.php";
								break;
								
							}
							
						?>
						
                    </div>
                    
                </div>

            </div>

        </div>

<?php include "includes/admin_footer.php"; ?>