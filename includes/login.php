<?php include "db.php"; ?>
<?php include "../admin/includes/functions.php"; ?>
<?php session_start(); ?>
<?php
	if(isset($_POST['login'])) {
		$username = ucfirst(escape($_POST['username']));
		$password = escape($_POST['password']);

		$query = "SELECT * FROM users WHERE user_name = '{$username}'";
		$select_user_query = mysqli_query($connection, $query);
		confirmQuery($select_user_query);

		while($row = mysqli_fetch_array($select_user_query)) {
			$db_user_id = $row['user_id'];
			$db_user_name = $row['user_name'];
			$db_user_password = $row['user_password'];
			$db_user_firstname = $row['user_firstname'];
			$db_user_lastname = $row['user_lastname'];
			$db_user_role = $row['user_role'];
		}

		if($username == $db_user_name) {
			$_SESSION['username'] = $db_user_name;
			$_SESSION['firstname'] = $db_user_firstname;
			$_SESSION['lastname'] = $db_user_lastname;
			$_SESSION['role'] = $db_user_role;

			header("Location: ../admin");
		} else {
			header("Location: ../index.php");
		}
	}
?>
