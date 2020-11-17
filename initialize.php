<?php include('server.php') ?>
<!DOCTYPE html>
<html lang = "en-US">
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Create the database</h2>
  </div>
  <form method="post" action="initialize.php">
  <?php include('errors.php'); ?>
<<<<<<< HEAD
    <div class="input-group">
  		<button type="submit" class="btn" name="initialize">Create Database</button>
=======
  <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    <?php endif ?>
    <div class="input-group">
  		<button type="submit" class="btn" name="initialize">Initialize Database?</button>
>>>>>>> 150adcc81a4125b31f27c2e5771dc263bf279c75
  	</div>
    <p> <a href="index.php?logout='1'" class = "btn">logout</a> </p>
   </form>
</body>
</html>