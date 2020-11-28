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
$first = $_SESSION['query3-1'];
$second = $_SESSION['query3-2'];
$query3 = "SELECT T.leader FROM
(SELECT *
FROM Follows
WHERE Follows.follower = '$first') as T, 
(SELECT * 
FROM Follows
WHERE Follows.follower = '$second') as S
WHERE T.leader = S.leader";
$result3 = mysqli_query($db, $query3);
$rowcount = mysqli_num_rows($result3);
if($rowcount > 0)
{
while($row3 = mysqli_fetch_assoc($result3)){
    $users = $row3["leader"];
    echo "<p>&nbsp&nbsp&nbsp&nbsp&nbsp $users is followed by both $first and $second</p>";	
}
}
else
{echo "<p> No users are followed by both $first and $second";}
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