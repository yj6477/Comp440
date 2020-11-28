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
		<li><a href="createblog.php" class="SectionsPresent">CreateBlogs</a></li>	
	</ul>
  </nav>
</header>
  <div class="header">
	  <h2>Create Blog</h2>  
    <form method="post" action="createblog.php">
      <?php include('errors.php'); ?>
      
      
        <label>Subject</label>
        <input type="text" id="subject" name="subject" placeholder="What are you gonna talk about?">
      
     
        <label>Description</label>
        <textarea id="description" name ="description" placeholder="Write what you're describing..." style="height: 200px"></textarea>
        
        <label>Tags</label>
        <input type="text" id="tags" name="tags" placeholder="put tags seperated by comma">
      
     
        <button type="submit" class="btn" name="create_blog">Submit</button>
    </form>
  </div>
</body>
</html>