<?php include('server.php') ?>
<!DOCTYPE html>
<html lang = "en-US">
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login Page</h2>
  </div>
  <style>
    .bigtext {
    color: white;
    font-size: 40px;
  }
</style>
<?php 
$user = $_SESSION['query1'];
$query= "SELECT DISTINCT B.blogid, B.subject, B.description, B.postuser, B.pdate 
  FROM Blogs as B, Comments as C 
  WHERE B.blogid = C.blogid AND B.postuser = '$user' AND B.blogid NOT IN
  ( SELECT Blogs.blogid FROM Blogs, Comments WHERE Blogs.blogid = Comments.blogid and Comments.sentiment = 'negative')";
  $result = mysqli_query($db, $query);
  echo "<p class = 'bigtext'>Displaying $user blogs that has positive comments...</p>";
  while($row = mysqli_fetch_assoc($result)){
    $subject = $row["subject"];
    $pdate = $row["pdate"];
    $description = $row["description"];
    echo "<p class = 'bigtext'>&nbsp&nbsp&nbsp&nbsp&nbsp $subject blog has positive comments</p>
      ";
  }

?>
<p> <a href="display.php" class = "btn">Display</a> </p>
</body>
</html>
