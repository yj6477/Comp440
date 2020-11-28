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
$user = $_SESSION['query1'];
$query= "SELECT DISTINCT B.blogid, B.subject, B.description, B.postuser, B.pdate 
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