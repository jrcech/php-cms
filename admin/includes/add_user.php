<?php
	if(isset($_POST['create_user'])) {
		$user_firstname = ucfirst(escape($_POST['user_firstname']));
		$user_lastname = ucfirst(escape($_POST['user_lastname']));
		$user_role = escape($_POST['user_role']);
		$user_name = ucfirst(escape($_POST['user_name']));
		$user_email = escape($_POST['user_email']);
		$user_password = escape($_POST['user_password']);
		$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

		$query = "INSERT INTO users(user_firstname, user_lastname, user_role, user_name, user_email, user_password) ";
		$query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$user_name}', '{$user_email}', '{$user_password}')";

		$create_user_query = mysqli_query($connection, $query);
		confirmQuery($create_user_query);

		echo "User Created: " . "<a href='users.php'>View Users</a>";
	}
?>
<h1 class="page-header">Add User</h1>

<form action="" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="post_tags">Username</label>
				<input type="text" class="form-control" name="user_name">
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label for="post_title">Firstname</label>
				<input type="text" class="form-control" name="user_firstname">
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label for="post_status">Lastname</label>
				<input type="text" class="form-control" name="user_lastname">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="post_status">Role</label>
				<select name="user_role" class="form-control">
					<option value="admin">Admin</option>
					<option value="subscriber">Subscriber</option>
				</select>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="post_tags">Email</label>
				<input type="email" class="form-control" name="user_email">
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label for="post_tags">Password</label>
				<input type="password" class="form-control" name="user_password">
			</div>
		</div>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_user" value="Add user">
	</div>
</form>
