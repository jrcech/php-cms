<?php
	if(isset($_GET['edit_user'])) {
		$edit_user_id = $_GET['edit_user'];
		$query = "SELECT * FROM users WHERE user_id = '$edit_user_id'";

		$select_users_query = mysqli_query($connection, $query);
		confirmQuery($select_users_query);

		while($row = mysqli_fetch_assoc($select_users_query)) {
			$user_id = $row ['user_id'];
			$user_name = $row ['user_name'];
			$user_password = $row ['user_password'];
			$user_firstname = $row ['user_firstname'];
			$user_lastname = $row ['user_lastname'];
			$user_email = $row ['user_email'];
			$user_image = $row ['user_image'];
			$user_role = $row ['user_role'];
		}

		if(isset($_POST['edit_user'])) {
			$user_firstname = ucfirst(escape($_POST['user_firstname']));
			$user_lastname = ucfirst(escape($_POST['user_lastname']));
			$user_role = escape($_POST['user_role']);
			$user_name = ucfirst(escape($_POST['user_name']));
			$user_email = escape($_POST['user_email']);
			$user_password = escape($_POST['user_password']);

			if(!empty($user_password)) {
				$query_password = "SELECT user_password FROM users WHERE user_id = $edit_user_id";

				$get_user_query = mysqli_query($connection, $query_password);
				confirmQuery($get_user_query);

				$row = mysqli_fetch_assoc($get_user_query);
				$db_user_password = $row['user_password'];
				$hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

				$query = "UPDATE users SET ";
				$query .= "user_firstname = '{$user_firstname}', ";
				$query .= "user_lastname = '{$user_lastname}', ";
				$query .= "user_role = '{$user_role}', ";
				$query .= "user_name = '{$user_name}', ";
				$query .= "user_email = '{$user_email}', ";
				$query .= "user_password = '{$hashed_password}' ";
				$query .= "WHERE user_id = '{$edit_user_id}'";

				$update_user_query = mysqli_query($connection, $query);
				confirmQuery($update_user_query);

				echo "<p class='bg-success'>User Updated<br><a href='users.php'>View All Users</a></p>";
			}
		}
	} else {
		header("Location: users.php");
	}
?>
<h1 class="page-header">Edit User <?php echo $user_name; ?></h1>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="user_firstname">Firstname</label>
		<input type="text" class="form-control" id="user_firstname" value="<?php echo $user_firstname; ?>" name="user_firstname">
	</div>

	<div class="form-group">
		<label for="user_lastname">Lastname</label>
		<input type="text" class="form-control" id="user_lastname" value="<?php echo $user_lastname; ?>" name="user_lastname">
	</div>

	<div class="form-group">
		<label for="user_role">Role</label>
		<select name="user_role" class="form-control" id="user_role">
			<option value="<?php echo $user_role; ?>"><?php echo ucfirst($user_role); ?></option>
			<?php
				if($user_role == 'admin') {
					echo "<option value='subscriber'>Subscriber</option>";
				} else {
					echo "<option value='admin'>Admin</option>";
				}
			?>
		</select>
	</div>

	<div class="form-group">
		<label for="user_name">Username</label>
		<input type="text" class="form-control" id="user_name" value="<?php echo $user_name; ?>" name="user_name">
	</div>

	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="email" class="form-control" id="user_email" value="<?php echo $user_email; ?>" name="user_email">
	</div>

	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="password" class="form-control" id="user_password" value="<?php echo $user_password; ?>" name="user_password">
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
	</div>
</form>
