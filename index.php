<?php include('server.php') ?>
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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
</head>
<body>
<header role = "banner">
  <nav role = "navigation" class = "Sections">
  	<ul>
  		<li><a href="index.php" class = "SectionsPresent">Home</a></li>
		<li><a href="initialize.php"class = "SectionsItem">Initialize</a></li>
		<li><a href="comment.php" class="SectionsItem">Blogs</a></li>
		<li><a href="createblog.php" class="SectionsItem">CreateBlogs</a></li>	
	</ul>
  </nav>
</header>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php  if (isset($_SESSION['username'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
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
	<!-- created database --->
	<?php  if (isset($_SESSION['initialize'])) : ?>
	<p> hey congratulations </p>
	<?php endif ?>
	<?php include('errors.php'); ?>
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" class = "btn">logout</a> </p>
		<p><input type="text" id="username" name="username" placeholder="type the username that has positive comments">
		<button type="submit" class="btn" name="query1">Submit</button>
<?php $user = $_SESSION['username'];
			$query="SELECT DISTINCT B.blogid, B.subject, B.description, B.postuser, B.pdate 
				FROM Blogs as B, Comments as C 
				WHERE B.blogid = C.blogid AND B.postuser = '$user' AND B.blogid NOT IN
				( SELECT Blogs.blogid FROM Blogs, Comments WHERE Blogs.blogid = Comments.blogid and Comments.sentiment = 'negative')";
				$result = mysqli_query($db, $query);
				echo "<p>Displaying $user blogs that has positive comments...</p>";
				while($row = mysqli_fetch_assoc($result)){
					$subject = $row["subject"];
					$pdate = $row["pdate"];
					$description = $row["description"];
					echo "<div class='panel'>
						<p>&nbsp&nbsp&nbsp&nbsp&nbsp $subject blog has positive comments</p>
						</div>";
					
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
				echo "<p>&nbsp&nbsp&nbsp&nbsp&nbsp $subject1 blog has zero comments</p>";
			}

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
			$query3 = "SELECT T.leader FROM
			(SELECT *
			FROM Follows
			WHERE Follows.follower = 'irottery4') as T, 
			(SELECT * 
			FROM Follows
			WHERE Follows.follower = 'cheathorn9') as S
			WHERE T.leader = S.leader";
			$result3 = mysqli_query($db, $query3);

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
				
			?></p>
		
    <?php endif ?>
</div>
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
</body>
</html>