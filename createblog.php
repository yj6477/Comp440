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

  <div class = "container">
    <form >
      <label for="subject">Subject</label>
      <input type="text" id="subject" name="Subject" placeholder="What are you gonna talk about?">

      <label for="description">Description</label>
      <textarea id="description" name ="description" placeholder="Write what you're describing..." style="height: 200px"></textarea>

      <label for="Tags">Tags</label>
      <input type="text" id="tags" name="Tags" placeholder="put tags">

      <input type="submit" value="Submit">
    </form>
  </div>
</div>
</body>
</html>