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
    <div class="input-group">
  		<button type="submit" class="btn" name="initialize">Create Database</button>
  	</div>
    <p> <a href="index.php?logout='1'" class = "btn">logout</a> </p>
   </form>
</body>
</html>