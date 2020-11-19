<?php include('server.php') ?>
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header role = "banner">
  <nav role = "navigation" class = "Sections">
  	<ul>
  		<li><a href="index.php" class = "SectionsPresent">Home</a></li>
		<li><a href="initialize.php"class = "SectionsItem">Initialize</a></li>
		<li><a href="comment.php" class="SectionsItem">Blogs</a></li>
		<li><a href="createblog.php" class="SectionsItem">CreateBlogs</a></li>	
	</ul>
  </nav>
</header>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php  if (isset($_SESSION['username'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
	  <?php  if (isset($_SESSION['restriction'])) : ?>
      <div class="error restriction" >
      	<h3>
          <?php 
          	echo $_SESSION['restriction']; 
          	unset($_SESSION['restriction']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
	<!-- created database --->
	<?php  if (isset($_SESSION['initialize'])) : ?>
	<p> hey congratulations </p>
	<?php endif ?>
	<?php include('errors.php'); ?>
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" class = "btn">logout</a> </p>
		
    <?php endif ?>
</div>
		
</body>
</html>