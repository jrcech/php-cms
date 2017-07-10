<?php include "includes/admin_header.php"; ?>
<div id="wrapper">
  <?php include "includes/admin_navigation.php"; ?>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Categories</h1>
				  <div class="row">
						<div class="col-xs-6">
							<?php insert_categories(); ?>
							<form action="categories.php" method="post">
								<div class="form-group">
									<label for="cat_title">Category Title</label>
									<input class="form-control" type="text" name="cat_title">
								</div>

								<div class="form-group">
									<input class="btn btn-primary" type="submit" name="submit" value="Add Category">
								</div>
							</form>
							<?php
								if(isset($_GET['edit'])) {
									$cat_id = escape($_GET['edit']);
									include "includes/update_categories.php";
								}
							?>
						</div>

						<div class="col-xs-6">
							<div class="row space">
								<div class="col-xs-4 options" id="bulkOptionsContainer">
									<select name="bulk_options" class="form-control">
										<option value="">Select Options</option>
										<option value="duplicate">Duplicate</option>
										<option value="delete">Delete</option>
									</select>
								</div>

								<div class="col-xs-4">
									<input type="submit" class="btn btn-success" value="Apply" name="submit_option">
								</div>
							</div>

							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th><input id="selectAllBoxes" type="checkbox"></th>
										<th>ID</th>
										<th>Category Title</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>

								<tbody>
									<?php
										showAllCategories();
										checkBoxesCategories();
										deleteCategories();
									?>
								</tbody>
							</table>
						</div>
					</div>
        </div>
      </div>
    </div>
  </div>
<?php include "includes/admin_footer.php"; ?>
