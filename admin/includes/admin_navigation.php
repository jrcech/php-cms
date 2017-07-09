<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php">CMS Admin</a>
  </div>

  <ul class="nav navbar-right top-nav">
    <li><a href="../index.php?page=1">Home</a></li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-user"></i>
        <?php
          if(isset($_SESSION['username'])) {
          	echo $_SESSION['username'];
          }
        ?>
        <b class="caret"></b>
      </a>

      <ul class="dropdown-menu">
        <li><a href="profile.php"><i class="fa fa-fw fa-cog"></i> Your Profile</a></li>
        <li><a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
      </ul>
    </li>
  </ul>

  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li><a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>

			<li>
        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown">
          <i class="fa fa-fw fa-list" aria-hidden="true"></i> Posts <i class="fa fa-fw fa-caret-down"></i>
        </a>

        <ul id="posts_dropdown" class="collapse">
          <li><a href="posts.php">View All Posts</a></li>
          <li><a href="posts.php?source=add_post">Add Post</a></li>
        </ul>
      </li>

      <li><a href="categories.php"><i class="fa fa-fw fa-folder"></i> Categories</a></li>
      <li><a href="comments.php"><i class="fa fa-fw fa-comment"></i> Comments</a></li>

      <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#demo">
          <i class="fa fa-fw fa-user"></i> Users <i class="fa fa-fw fa-caret-down"></i>
        </a>

        <ul id="demo" class="collapse">
          <li><a href="users.php">View All Users</a></li>
          <li><a href="users.php?source=add_user">Add User</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
