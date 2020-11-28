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
    echo "<p class = 'bigtext'>&nbsp&nbsp&nbsp&nbsp&nbsp $users is followed by both $first and $second</p>";	
}
}
else
{echo "<p class = 'bigtext'> No users are followed by both $first and $second";}
?>
</body>
</html>