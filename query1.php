<?php include('server.php') ?>
<!DOCTYPE html>
<html lang = "en-US">
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
  .bigtext {
    color: white;
    font-size: 40px;
    
  }
</style>
</head>
<body>
  <div class="header">
  	<h2>Query Page</h2>
  </div>
<?php 
$user = $_SESSION['query1'];
$query= "SELECT DISTINCT B.blogid, B.subject, B.description, B.postuser, B.pdate 
  FROM Blogs as B, Comments as C 
  WHERE B.blogid = C.blogid AND B.postuser = '$user' AND B.blogid NOT IN
  ( SELECT Blogs.blogid FROM Blogs, Comments WHERE Blogs.blogid = Comments.blogid and Comments.sentiment = 'negative')";
  $result = mysqli_query($db, $query);
  echo "<p class = 'bigtext'>Displaying <strong>$user</strong> blogs that has positive comments...</p>";
  while($row = mysqli_fetch_assoc($result)){
    $subject = $row["subject"];
    $pdate = $row["pdate"];
    $description = $row["description"];
    echo "
      <p class = 'bigtext'>&nbsp&nbsp&nbsp&nbsp&nbsp $subject blog has positive comments</p>";
      
    
  }
  

mysqli_free_result($result);
$query1="SELECT DISTINCT B.blogid, B.subject, B.description, B.postuser, B.pdate 
FROM Blogs as B
WHERE B.postuser = '$user' AND B.blogid NOT IN (SELECT DISTINCT C.blogid FROM Comments as C)";
$result1 = mysqli_query($db, $query1);
while($row1= mysqli_fetch_assoc($result1)){
  $subject1 = $row1["subject"];
  $pdate1 = $row1["pdate"];
  $description1 = $row1["description"];
  echo "<p class = 'bigtext'>&nbsp&nbsp&nbsp&nbsp&nbsp $subject1 blog has zero comments</p>";
}
?>
</body>
</html>