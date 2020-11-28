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
.accordion {
  background-color: #b104a2e5;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #df1cdf;
  color: white; 
}

.panel {
  padding: 0 18px;
  display: none;
  background-color: purple;
  overflow: hidden;
}

.descriptions{
  width: 100%;
  padding: 12px;
  background-color:#b104a2e5; 
  border: 2px solid black;
  border-radius: 4px;
  box-sizing: border-box;
  color: white;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}
.Sec{
  color: white;
}
</style>
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
  echo "List the users who posted the most number of blogs on 10/10/2020; if there is a tie, list all the users who have a tie.";
  while($row2 = mysqli_fetch_assoc($result2)){
    $users = $row2["postuser"];
    $NumBlogs=$row2["COUNT(postuser)"];
    echo "<p>&nbsp&nbsp&nbsp&nbsp&nbsp $users have the most blogs posted with the amount of $NumBlogs</p>";	
  }
}
elseif ($value == 4) {
  $query4 = "SELECT username 
			FROM Users
			WHERE username NOT IN (SELECT DISTINCT postuser
			FROM Blogs)";
			echo "<p>Display all the users who never posted a blog.</p>";
			$result4 = mysqli_query($db, $query4);
			while($row4 = mysqli_fetch_assoc($result4)){
				$users = $row4["username"];
				echo "<p>&nbsp&nbsp&nbsp&nbsp&nbsp $users</p>";
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
			echo"<p>Display all the users who posted some comments, but each of them is negative.</p>";
			$result5 = mysqli_query($db, $query5);
			while($row5 = mysqli_fetch_assoc($result5)){
				$users = $row5["username"];
				echo"<p>&nbsp&nbsp&nbsp&nbsp&nbsp $users</p>";
			}
}
else
{
  $query6 = "SELECT username 
  FROM Users as U 
  WHERE U.username IN (Select DISTINCT postuser FROM Blogs) 
  AND username NOT IN
  (SELECT DISTINCT B.blogid
  FROM Blogs as B, Comments as C
  WHERE B.blogid = C.blogid AND C.sentiment = 'negative')";
  echo "<p>Display those users such that all the blogs they posted so far never received any
  negative comments.</p>";
  $result6 = mysqli_query($db, $query6);
  while($row6 = mysqli_fetch_assoc($result6)){
    $users = $row6["username"];
    echo"<p>&nbsp&nbsp&nbsp&nbsp&nbsp $users</p>";
  }
}
?>
</body>
</html>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>