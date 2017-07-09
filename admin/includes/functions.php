<?php
	function confirmQuery($result) {
		global $connection;

		if(!$result) {
			die("Query Failed: " . mysqli_error($connection));
		}
	}

	function escape($string) {
		global $connection;

		return mysqli_real_escape_string($connection, trim($string));
	}

	function checkBoxesCommentsByPost() {
		global $connection;

		if(isset($_POST['checkBoxArray'])) {
			foreach($_POST['checkBoxArray'] as $commentValueId) {
				$bulk_options = $_POST['bulk_options'];

				switch($bulk_options) {
					case 'approved':
						$query = "UPDATE comments SET comment_status = '$bulk_options' WHERE comment_id = '$commentValueId'";
						$update_to_approved_query = mysqli_query($connection, $query);
						confirmQuery($update_to_approved_query);
					break;

					case 'unapproved':
						$query = "UPDATE comments SET comment_status = '$bulk_options' WHERE comment_id = '$commentValueId'";
						$update_to_draft_query = mysqli_query($connection, $query);
						confirmQuery($update_to_draft_query);
					break;

					case 'duplicate':
						$query = "SELECT * FROM comments WHERE comment_id = '$commentValueId'";
						$select_comment_query = mysqli_query($connection, $query);
						confirmQuery($select_comment_query);

						while($row = mysqli_fetch_assoc($select_comment_query)) {
							$comment_id = $row ['comment_id'];
							$comment_post_id = $row ['comment_post_id'];
							$comment_author = $row ['comment_author'];
							$comment_content = $row ['comment_content'];
							$comment_email = $row ['comment_email'];
							$comment_status = $row ['comment_status'];
							$comment_date = $row ['comment_date'];
						}
						$query = "INSERT INTO comments(comment_post_id, comment_author, comment_content, comment_email, comment_status, comment_date) ";
						$query .= "VALUES('$comment_post_id', '$comment_author', '$comment_content', '$comment_email', '$comment_status', '$comment_date')";
						$duplicate_multiple_query = mysqli_query($connection, $query);
						confirmQuery($duplicate_multiple_query);

						header("Location: post_comments.php?id=$comment_post_id");
					break;

					case 'delete':
						$query = "SELECT comment_post_id FROM comments WHERE comment_id = '$commentValueId'";
						$select_comment_query = mysqli_query($connection, $query);
						confirmQuery($select_comment_query);

						while($row = mysqli_fetch_assoc($select_comment_query)) {
							$comment_post_id = $row ['comment_post_id'];
						}
						$query = "DELETE FROM comments WHERE comment_id = '$commentValueId'";
						$delete_multiple_query = mysqli_query($connection, $query);
						confirmQuery($delete_multiple_query);

						header("Location: post_comments.php?id=$comment_post_id");
					break;
				}
			}
		}
	}

	function checkBoxesComments() {
		global $connection;

		if(isset($_POST['checkBoxArray'])) {
			foreach($_POST['checkBoxArray'] as $commentValueId) {
				$bulk_options = $_POST['bulk_options'];

				switch($bulk_options) {
					case 'approved':
						$query = "UPDATE comments SET comment_status = '$bulk_options' WHERE comment_id = '$commentValueId'";
						$update_to_approved_query = mysqli_query($connection, $query);
						confirmQuery($update_to_approved_query);
					break;

					case 'unapproved':
						$query = "UPDATE comments SET comment_status = '$bulk_options' WHERE comment_id = '$commentValueId'";
						$update_to_draft_query = mysqli_query($connection, $query);
						confirmQuery($update_to_draft_query);
					break;

					case 'duplicate':
						$query = "SELECT * FROM comments WHERE comment_id = '$commentValueId'";
						$select_comment_query = mysqli_query($connection, $query);
						confirmQuery($select_comment_query);

						while($row = mysqli_fetch_assoc($select_comment_query)) {
							$comment_id = $row ['comment_id'];
							$comment_post_id = $row ['comment_post_id'];
							$comment_author = $row ['comment_author'];
							$comment_content = $row ['comment_content'];
							$comment_email = $row ['comment_email'];
							$comment_status = $row ['comment_status'];
							$comment_date = $row ['comment_date'];
						}
						$query = "INSERT INTO comments(comment_post_id, comment_author, comment_content, comment_email, comment_status, comment_date) ";
						$query .= "VALUES('$comment_post_id', '$comment_author', '$comment_content', '$comment_email', '$comment_status', '$comment_date')";
						$duplicate_multiple_query = mysqli_query($connection, $query);
						confirmQuery($duplicate_multiple_query);

						header("Location: comments.php");
					break;

					case 'delete':
						$query = "DELETE FROM comments WHERE comment_id = '$commentValueId'";
						$delete_multiple_query = mysqli_query($connection, $query);
						confirmQuery($delete_multiple_query);

						header("Location: comments.php");
					break;
				}
			}
		}
	}

	function checkBoxesCategories() {
		global $connection;

		if(isset($_POST['checkBoxArray'])) {
			foreach($_POST['checkBoxArray'] as $categoryValueId) {
				$bulk_options = $_POST['bulk_options'];

				switch($bulk_options) {
					case 'duplicate':
						$query = "SELECT * FROM categories WHERE cat_id= '{$categoryValueId}'";
						$select_category_query = mysqli_query($connection, $query);
						confirmQuery($select_category_query);

						while($row = mysqli_fetch_assoc($select_category_query)) {
							$cat_id = $row['cat_id'];
							$cat_title = $row['cat_title'];
						}
						$query = "INSERT INTO categories(cat_title) ";
						$query .= "VALUES('{$cat_title}')";
						$duplicate_multiple_query = mysqli_query($connection, $query);
						confirmQuery($duplicate_multiple_query);

						header("Location: categories.php");
					break;

					case 'delete':
						$query = "DELETE FROM categories WHERE cat_id = '{$categoryValueId}'";
						$delete_multiple_query = mysqli_query($connection, $query);
						confirmQuery($delete_multiple_query);

						header("Location: categories.php");
					break;
				}
			}
		}
	}

	function checkBoxesUsers() {
		global $connection;

		if(isset($_POST['checkBoxArray'])) {
			foreach($_POST['checkBoxArray'] as $userValueId) {
				$bulk_options = $_POST['bulk_options'];

				switch($bulk_options) {
					case 'admin':
						$query = "UPDATE users SET user_role = '{$bulk_options}' WHERE user_id = '{$userValueId}'";
						$update_to_admin_query = mysqli_query($connection, $query);
						confirmQuery($update_to_admin_query);
					break;

					case 'subscriber':
						$query = "UPDATE users SET user_role = '{$bulk_options}' WHERE user_id = '{$userValueId}'";
						$update_to_subsscriber_query = mysqli_query($connection, $query);
						confirmQuery($update_to_subsscriber_query);
					break;

					case 'duplicate':
						$query = "SELECT * FROM users WHERE user_id= '{$userValueId}'";
						$select_user_query = mysqli_query($connection, $query);
						confirmQuery($select_user_query);

						while($row = mysqli_fetch_assoc($select_user_query)) {
							$user_name = $row ['user_name'];
							$user_password = $row ['user_password'];
							$user_firstname = $row ['user_firstname'];
							$user_lastname = $row ['user_lastname'];
							$user_email = $row ['user_email'];
							$user_image = $row ['user_image'];
							$user_role = $row ['user_role'];
						}
						$query = "INSERT INTO users(user_name, user_password, user_firstname, user_lastname, user_email, user_role) ";
						$query .= "VALUES('{$user_name}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}')";
						$duplicate_multiple_query = mysqli_query($connection, $query);
						confirmQuery($duplicate_multiple_query);
					break;

					case 'delete':
						$query = "DELETE FROM users WHERE user_id = '{$userValueId}'";
						$delete_multiple_query = mysqli_query($connection, $query);
						confirmQuery($delete_multiple_query);

						header("Location: users.php");
					break;
				}
			}
		}
	}

	function checkBoxesPosts() {
		global $connection;

		if(isset($_POST['checkBoxArray'])) {
			foreach($_POST['checkBoxArray'] as $postValueId) {
				$bulk_options = $_POST['bulk_options'];

				switch($bulk_options) {
					case 'published':
						$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}'";
						$update_to_published_query = mysqli_query($connection, $query);
						confirmQuery($update_to_published_query);
					break;

					case 'draft':
						$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}'";
						$update_to_draft_query = mysqli_query($connection, $query);
						confirmQuery($update_to_draft_query);
					break;

					case 'duplicate':
						$query = "SELECT * FROM posts WHERE post_id= '{$postValueId}'";
						$select_post_query = mysqli_query($connection, $query);
						confirmQuery($select_post_query);

						while($row = mysqli_fetch_assoc($select_post_query)) {
							$post_user = $row ['post_user'];
							$post_title = $row ['post_title'];
							$post_category_id = $row ['post_category_id'];
							$post_status = $row ['post_status'];
							$post_image = $row ['post_image'];
							$post_tags = $row ['post_tags'];
							$post_date = $row ['post_date'];
						}
            $query = "INSERT INTO posts(post_user, post_title, post_category_id, post_status, post_image, post_tags, post_date) ";
            $query .= "VALUES('{$post_user}', '{$post_title}', '{$post_category_id}', '{$post_status}', '{$post_image}', '{$post_tags}', now())";
						$duplicate_multiple_query = mysqli_query($connection, $query);
						confirmQuery($duplicate_multiple_query);
					break;

					case 'delete':
						$query = "DELETE FROM posts WHERE post_id = '{$postValueId}'";
						$delete_multiple_query = mysqli_query($connection, $query);
						confirmQuery($delete_multiple_query);

						header("Location: posts.php");
					break;
				}
			}
		}
	}

	function insert_categories() {
		global $connection;

		if(isset($_POST['submit'])) {
			$cat_title = escape($_POST['cat_title']);

			if($cat_title == "" || empty($cat_title)) {
				echo "This field should not be empty";
			} else {
				$query = "INSERT INTO categories(cat_title) ";
				$query .= "VALUE('{$cat_title}') ";
				$create_category_query = mysqli_query($connection, $query);
				confirmQuery($create_category_query);
			}
		}
	}

	function showAllCategories() {
		global $connection;

		$query = "SELECT * FROM categories";
		$select_categories = mysqli_query($connection, $query);
		confirmQuery($select_categories);

		while($row = mysqli_fetch_assoc($select_categories)) {
			$cat_id = $row['cat_id'];
			$cat_title = $row['cat_title'];
			echo "<tr>";
				echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$cat_id'></td>";
				echo "<td>{$cat_id}</td>";
				echo "<td>{$cat_title}</td>";
				echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
				echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
			echo "</tr>";
		}
	}

	function deleteCategories() {
		global $connection;

		if(isset($_GET['delete'])) {
			$cat_id_delete = escape($_GET['delete']);
			$query = "DELETE FROM categories WHERE cat_id = '{$cat_id_delete}'";
			$delete_query = mysqli_query($connection, $query);
			confirmQuery($delete_query);

			header("Location: categories.php");
		}
	}

	function recordCount($table) {
		global $connection;

		$query = "SELECT * FROM " . $table;
		$record_count = mysqli_query($connection, $query);
		confirmQuery($record_count);
		return mysqli_num_rows($record_count);
	}

	function checkStatus($table, $column, $status) {
		global $connection;

		$query = "SELECT * FROM $table WHERE $column = '$status'";
    $result = mysqli_query($connection, $query);
		confirmQuery($result);
    return mysqli_num_rows($result);
	}
?>
