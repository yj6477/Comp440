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
		<li><a href="initialize.php"class = "SectionsItem">Initialize</a></li>
		<li><a href="comment.php" class="SectionsItem">Blogs</a></li>
		<li><a href="createblog.php" class="SectionsItem">CreateBlogs</a></li>
    <li><a href="display.php" class ="SectionsPresent">DisplayQuery</a></li>
	</ul>
  </nav>
</header>
  <div class="header">
  	<h2>Create the database</h2>
  </div>
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
<form method='post' action='display.php'>
  <?php include('errors.php'); ?>
    <p> Select the query to display</p>
    <p> Query 1 </p>
    <p><input type="text" id="user1-1" name="user1-1" placeholder="type the username that has positive comments"> </p>
	<button type="submit" class="btn" name="query1">Submit</button>
    <p> Query 2 </p>
    <button type="submit" class="btn" name="query" value=2>Go</button>
    <p> Query 3 </p>
    <p><input type="text" id="user1-2" name="user1-2" placeholder="type a username"> </p>
    <p><input type="text" id="user2-2" name="user2-2" placeholder="type a username"> </p>
    <button type="submit" class="btn" name="query3">Go</button>
    <p> Query 4 </p>
    <button type="submit" class="btn" name="query" value=4>Go</button>
    <p> Query 5 </p>
    <button type="submit" class="btn" name="query" value=5>Go</button>
    <p> Query 6 </p>
    <button type="submit" class="btn" name="query" value=6>Go</button>
</form>
</body>
