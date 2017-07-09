<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "functions.php"; ?>
<?php
	if(!isset($_SESSION['role'])) {
		header("Location: ../index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Administration layout for CMS.">
    <meta name="author" content="Jiří Čech">
    <meta name="keywords" content="cms, php, bootstrap, mysql, admin" />

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <script src="https://use.fontawesome.com/81ebd77a72.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>

    <link href="css/sb-admin.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />

    <title>PHP CMS Admin | Jiří Čech</title>
  </head>
  <body>
