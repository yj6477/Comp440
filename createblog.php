<?php include('server.php') ?>
<!DOCTYPE html>
<html lang = "en-US">
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
	  <h2>Create Blog</h2>  
  </div>
  <form method="post" action="createblog.php">
    <?php include('errors.php'); ?>
    <div class = "container">
    <div class = "input-group">
      <label>Subject</label>
      <input type="text" id="subject" name="subject" placeholder="What are you gonna talk about?">
    </div>
    <div class = "input-group">
      <label>Description</label>
      <textarea id="description" name ="description" placeholder="Write what you're describing..." style="height: 200px"></textarea>
    </div>
    <div class = "input-group">  
      <label>Tags</label>
      <input type="text" id="tags" name="tags" placeholder="put tags">
    </div>
    <div class = "input-group">
      <button type="submit" class="btn" name="create_blog">Submit</button>
    </div>
    <p> <a href="index.php?logout='1'" class ="btn">logout</a> </p>
  </div>
  </form>
  </div>
</body>
</html>