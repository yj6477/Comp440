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
$value = $_SESSION['query'];
if($value == 2)
{
  $query2 = "SELECT COUNT(postuser), postuser
  FROM Blogs 
  GROUP BY postuser 
  HAVING COUNT(postuser) = (Select MAX(I.userCount) as maxCOUNT
  FROM (SELECT COUNT(postuser) as userCount, postuser
  FROM Blogs 
  GROUP BY postuser
  ORDER BY COUNT(postuser)) as I)";
  $result2 = mysqli_query($db, $query2);
  echo "<p class = 'bigtext'>List the users who posted the most number of blogs on 10/10/2020; if there is a tie, list all the users who have a tie.</p>";
  while($row2 = mysqli_fetch_assoc($result2)){
    $users = $row2["postuser"];
    $NumBlogs=$row2["COUNT(postuser)"];
    echo "<p class = 'bigtext'>&nbsp&nbsp&nbsp&nbsp&nbsp $users have the most blogs posted with the amount of $NumBlogs</p>";	
  }
}
elseif ($value == 4) {
  $query4 = "SELECT username 
			FROM Users
			WHERE username NOT IN (SELECT DISTINCT postuser
			FROM Blogs)";
			echo "<p class = 'bigtext'>Display all the users who never posted a blog.</p>";
			$result4 = mysqli_query($db, $query4);
			while($row4 = mysqli_fetch_assoc($result4)){
				$users = $row4["username"];
				echo "<p class = 'bigtext'>&nbsp&nbsp&nbsp&nbsp&nbsp $users</p>";
			}

}
elseif ($value == 5) {
  $query5 = "SELECT username 
			FROM Users as U 
			WHERE U.username IN (Select DISTINCT author FROM Comments) 
			AND U.username IN
			(SELECT T.author 
			FROM
			(SELECT author, count(sentiment) as totalComments FROM Comments GROUP BY author) as T, 
			(SELECT author, count(sentiment) as negativeComments FROM Comments WHERE sentiment = 'negative' GROUP BY author) as S
			WHERE T.author = S.author and T.totalComments = S.negativeComments)";
			echo"<p class = 'bigtext'>Display all the users who posted some comments, but each of them is negative.</p>";
			$result5 = mysqli_query($db, $query5);
			while($row5 = mysqli_fetch_assoc($result5)){
				$users = $row5["username"];
				echo"<p class = 'bigtext'>&nbsp&nbsp&nbsp&nbsp&nbsp $users</p>";
			}
}
else
{
  $query6 = "SELECT username 
  FROM Users as U 
  WHERE U.username NOT IN
  (SELECT DISTINCT B.postuser
  FROM Blogs as B, Comments as C
  WHERE B.blogid = C.blogid AND C.sentiment = 'negative')";
  echo "<p class = 'bigtext'>Display those users such that all the blogs they posted so far never received any
  negative comments.</p>";
  $result6 = mysqli_query($db, $query6);
  while($row6 = mysqli_fetch_assoc($result6)){
    $users = $row6["username"];
    echo"<p class = 'bigtext'>&nbsp&nbsp&nbsp&nbsp&nbsp $users</p>";
  }
}
?>
<p> <a href="display.php" class = "btn">Display</a> </p>
</body>
</html>

