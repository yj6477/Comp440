<?php include('server.php') ?>
<!DOCTYPE html>
<html lang = "en-US">
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header role = "banner">
  <nav role = "navigation" class = "Sections">
  	<ul>
  		<li><a href="index.php" class = "SectionsItem">Home</a></li>
		<li><a href="initialize.php"class = "SectionsPresent">Initialize</a></li>
		<li><a href="comment.php" class="SectionsItem">Blogs</a></li>
		<li><a href="createblog.php" class="SectionsItem">CreateBlogs</a></li>
    <li><a href="display.php" class ="SectionsItem">DisplayQuery</a></li>		
	</ul>
  </nav>
</header>
  <div class="header">
  	<h2>Create the database</h2>
  </div>
  <form method="post" action="initialize.php">
  <?php include('errors.php'); ?>
  <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    <?php endif ?>
    <div class="input-group">
  		<button type="submit" class="btn" name="initialize">Initialize Database?</button>
  	</div>
    <p> <a href="index.php?logout='1'" class = "btn">logout</a> </p>
   </form>
</body>
</html>