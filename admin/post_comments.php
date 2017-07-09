<?php include "includes/admin_header.php"; ?>
<div id="wrapper">
  <?php include "includes/admin_navigation.php"; ?>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <?php
            $id = escape($_GET['id']);
            $query = "SELECT * FROM posts WHERE post_id = '$id'";
						$select_post_id_query = mysqli_query($connection, $query);
						confirmQuery($select_post_id_query);

						while($row = mysqli_fetch_assoc($select_post_id_query)) {
							$post_id = $row ['post_id'];
							$post_title = $row ['post_title'];
						}
		      ?>
          <h1 class="page-header">All Comments In <a href='../post.php?p_id=<?php echo $post_id; ?>'><?php echo $post_title; ?></a></h1>

          <?php checkBoxesCommentsByPost(); ?>

					<form action="" method="post">
						<div class="row space">
							<div class="col-xs-4 options" id="bulkOptionsContainer">
								<select name="bulk_options" class="form-control">
									<option value="">Select Options</option>
									<option value="approved">Approve</option>
									<option value="unapproved">Unapprove</option>
									<option value="duplicate">Duplicate</option>
									<option value="delete">Delete</option>
								</select>
							</div>

							<div class="col-xs-4">
								<input type="submit" class="btn btn-success" value="Apply" name="submit">
							</div>
						</div>

						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th><input id="selectAllBoxes" type="checkbox"></th>
										<th>ID</th>
										<th>Author</th>
										<th>Comment</th>
										<th>Email</th>
										<th>Status</th>
										<th>In Response To</th>
										<th>Date</th>
										<th>Approve</th>
										<th>Unapprove</th>
										<th>Delete</th>
									</tr>
								</thead>

								<tbody>
							    <?php
							    	$the_post_id = escape($_GET['id']);
									  $query = "SELECT * FROM comments WHERE comment_post_id = '$the_post_id'";
										$select_comments = mysqli_query($connection, $query);
										confirmQuery($select_comments);

										while($row = mysqli_fetch_assoc($select_comments)) {
											$comment_id = $row ['comment_id'];
											$comment_post_id = $row ['comment_post_id'];
											$comment_author = $row ['comment_author'];
											$comment_content = $row ['comment_content'];
											$comment_email = $row ['comment_email'];
											$comment_status = $row ['comment_status'];
											$comment_date = $row ['comment_date'];

											echo "<tr>";
												echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$comment_id'></td>";
												echo "<td>{$comment_id}</td>";
												echo "<td>{$comment_author}</td>";
												echo "<td>{$comment_content}</td>";
												echo "<td>{$comment_email}</td>";
												echo "<td>{$comment_status}</td>";

												$query = "SELECT * FROM posts WHERE post_id = '{$comment_post_id}'";

												$select_post_id_query = mysqli_query($connection, $query);
												confirmQuery($select_post_id_query);

												while($row = mysqli_fetch_assoc($select_post_id_query)) {
													$post_id = $row ['post_id'];
													$post_title = $row ['post_title'];
												}

												echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
												echo "<td>{$comment_date}</td>";
												echo "<td><a href='post_comments.php?id=$post_id&approve={$comment_id}'>Approve</a></td>";
												echo "<td><a href='post_comments.php?id=$post_id&unapprove={$comment_id}'>Unapprove</a></td>";
												echo "<td><a href='post_comments.php?id=$post_id&delete={$comment_id}'>Delete</a></td>";
											echo "</tr>";
										}

										if(isset($_GET['approve'])) {
											$approve_comment_id = $_GET['approve'];
											$query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = '{$approve_comment_id}'";
											$approve_comment_query = mysqli_query($connection, $query);
											confirmQuery($approve_comment_query);
											header("Location: post_comments.php?id=$post_id");
										}

										if(isset($_GET['unapprove'])) {
											$unapprove_comment_id = $_GET['unapprove'];
											$query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = '{$unapprove_comment_id}'";
											$unapprove_comment_query = mysqli_query($connection, $query);
											confirmQuery($unapprove_comment_query);
											header("Location: post_comments.php?id=$post_id");
										}

										if(isset($_GET['delete'])) {
											$delete_comment_id = $_GET['delete'];
											$query = "DELETE FROM comments WHERE comment_id = '{$delete_comment_id}'";
											$delete_query = mysqli_query($connection, $query);
											confirmQuery($delete_query);

											header("Location: post_comments.php?id=$post_id");
										}
								  ?>
								</tbody>
							</table>
						</div>
					</form>
        </div>
      </div>
    </div>
  </div>
<?php include "includes/admin_footer.php"; ?>
