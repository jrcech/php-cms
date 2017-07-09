<?php checkBoxesUsers(); ?>
<h1 class="page-header">Users</h1>

<form action="" method="post">
	<div class="row space">
		<div class="col-xs-4 options" id="bulkOptionsContainer">
			<select name="bulk_options" class="form-control">
				<option value="">Select Options</option>
				<option value="admin">Admin</option>
				<option value="subscriber">Subscriber</option>
				<option value="duplicate">Duplicate</option>
				<option value="delete">Delete</option>
			</select>
		</div>

		<div class="col-xs-4">
			<input type="submit" class="btn btn-success" value="Apply" name="submit">
			<a href="users.php?source=add_user" class="btn btn-primary">Add New</a>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th><input id="selectAllBoxes" type="checkbox"></th>
							<th>ID</th>
							<th>Username</th>
							<th>Firstname</th>
							<th>Lastname</th>
							<th>Email</th>
							<th>Role</th>
							<th>Admin</th>
							<th>Subscriber</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>

					<tbody>
				    <?php
  						$query = "SELECT * FROM users";
  						$select_users = mysqli_query($connection, $query);
  						confirmQuery($select_users);

  						while($row = mysqli_fetch_assoc($select_users)) {
  							$user_id = $row ['user_id'];
  							$user_name = $row ['user_name'];
  							$user_password = $row ['user_password'];
  							$user_firstname = $row ['user_firstname'];
  							$user_lastname = $row ['user_lastname'];
  							$user_email = $row ['user_email'];
  							$user_image = $row ['user_image'];
  							$user_role = $row ['user_role'];

  							echo "<tr>";
  								echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$user_id'></td>";
  								echo "<td>{$user_id}</td>";
  								echo "<td>{$user_name}</td>";
  								echo "<td>{$user_firstname}</td>";
  								echo "<td>{$user_lastname}</td>";
  								echo "<td>{$user_email}</td>";
  								echo "<td>{$user_role}</td>";
  								echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
  								echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
  								echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
  								echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
  							echo "</tr>";
  						}

  						if(isset($_GET['change_to_admin'])) {
  							$admin_user_id = escape($_GET['change_to_admin']);
  							$query = "UPDATE users SET user_role = 'admin' WHERE user_id = '{$admin_user_id}'";

  							$change_to_admin_query = mysqli_query($connection, $query);
  							confirmQuery($change_to_admin_query);

  							header("Location: users.php");
  						}

  						if(isset($_GET['change_to_sub'])) {
  							$sub_user_id = escape($_GET['change_to_sub']);
  							$query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = '{$sub_user_id}'";

  							$change_to_sub_query = mysqli_query($connection, $query);
  							confirmQuery($change_to_sub_query);

  							header("Location: users.php");
  						}

  						if(isset($_GET['delete'])) {
  							if(isset($_SESSION['role'])) {
  								if($_SESSION['role'] == 'admin') {
  									$delete_user_id = escape($_GET['delete']);
  									$query = "DELETE FROM users WHERE user_id = '$delete_user_id'";

  									$delete_user_query = mysqli_query($connection, $query);
  									confirmQuery($delete_user_query);

  									header("Location: users.php");
  								}
  							}
  						}
				    ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</form>
